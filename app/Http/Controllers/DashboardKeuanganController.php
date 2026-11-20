<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MosqueProfile;
use App\Models\DonationProgram;
use App\Models\Donation;
use App\Models\CashMutation;
use App\Models\TelegramSetting;
use App\Models\AuditLog;
use App\Services\TelegramBotService;
use Carbon\Carbon;

class DashboardKeuanganController extends Controller
{
    /**
     * Ringkasan Keuangan (Bendahara Dashboard Main View)
     */
    public function index()
    {
        $profile = MosqueProfile::first();

        // Financial KPIs
        $saldoKas = 48650000.00;
        $kasBsi = 36200000.00;
        $kasSulutgo = 8450000.00;
        $kasTunai = 4000000.00;

        $infaqBulanIni = CashMutation::where('type', 'masuk')->sum('amount');
        $pengeluaranBulanIni = CashMutation::where('type', 'keluar')->sum('amount');

        $pendingDonations = Donation::where('status', 'pending')->orderByDesc('created_at')->get();
        $pendingCount = $pendingDonations->count();

        $recentMutations = CashMutation::orderByDesc('transaction_date')->take(7)->get();
        $programs = DonationProgram::where('is_active', true)->orderBy('order_index')->get();

        return view('admin.keuangan.index', compact(
            'profile',
            'saldoKas',
            'kasBsi',
            'kasSulutgo',
            'kasTunai',
            'infaqBulanIni',
            'pengeluaranBulanIni',
            'pendingDonations',
            'pendingCount',
            'recentMutations',
            'programs'
        ));
    }

    /**
     * Antrean Verifikasi Donasi Masuk
     */
    public function verifikasi()
    {
        $profile = MosqueProfile::first();
        $pendingDonations = Donation::where('status', 'pending')->orderByDesc('created_at')->paginate(15);
        $verifiedHistory = Donation::where('status', '!=', 'pending')->orderByDesc('updated_at')->take(10)->get();

        return view('admin.keuangan.verifikasi', compact('profile', 'pendingDonations', 'verifiedHistory'));
    }

    /**
     * Approve or Reject Donation
     */
    public function actionVerifikasi(Request $request, Donation $donation)
    {
        $action = $request->input('action'); // 'verify' or 'reject'
        $reason = $request->input('reason');

        if ($action === 'verify') {
            $donation->update([
                'status' => 'verified',
                'verified_at' => now(),
                'verified_by_user_id' => Auth::id(),
            ]);

            // Update program collected amount
            if ($donation->donation_program_id) {
                $program = DonationProgram::find($donation->donation_program_id);
                if ($program) {
                    $program->increment('collected_amount', $donation->amount);
                }
            }

            // Create corresponding cash mutation into Buku Kas
            $sourceAccount = 'bsi';
            if ($donation->payment_method === 'transfer_sulutgo') {
                $sourceAccount = 'sulutgo';
            } elseif ($donation->payment_method === 'tunai_kotak') {
                $sourceAccount = 'tunai_brankas';
            }

            CashMutation::create([
                'transaction_code' => 'KAS-IN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
                'type' => 'masuk',
                'source_account' => $sourceAccount,
                'category' => $donation->payment_method === 'qris' ? 'qris_online' : 'infaq_jamaah',
                'amount' => $donation->amount,
                'description' => "Sedekah dari {$donation->display_name} (Ref: {$donation->reference_code}) via " . strtoupper(str_replace('_', ' ', $donation->payment_method)),
                'proof_image_path' => $donation->proof_image_path,
                'donation_id' => $donation->id,
                'recorded_by_user_id' => Auth::id(),
                'transaction_date' => now()->toDateString(),
            ]);

            AuditLog::create([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'action' => 'Verifikasi Donasi Masuk',
                'module' => 'Keuangan',
                'details' => "Memvalidasi sedekah Rp" . number_format($donation->amount, 0, ',', '.') . " dari {$donation->display_name} (Ref: {$donation->reference_code})",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return back()->with('success', "Alhamdulillah, donasi {$donation->reference_code} (Rp" . number_format($donation->amount, 0, ',', '.') . ") berhasil diverifikasi dan masuk ke Buku Kas.");
        } elseif ($action === 'reject') {
            $donation->update([
                'status' => 'rejected',
                'rejection_reason' => $reason ?? 'Bukti transfer tidak valid atau dana tidak terdeteksi pada rekening mutasi bank.',
                'verified_at' => now(),
                'verified_by_user_id' => Auth::id(),
            ]);

            AuditLog::create([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'action' => 'Penolakan Verifikasi Donasi',
                'module' => 'Keuangan',
                'details' => "Menolak transaksi donasi Ref: {$donation->reference_code}. Alasan: " . ($reason ?? 'Mutasi tidak sesuai'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return back()->with('info', "Transaksi {$donation->reference_code} telah ditolak.");
        }

        return back();
    }

    /**
     * Buku Kas Umum Digital
     */
    public function bukuKas(Request $request)
    {
        $profile = MosqueProfile::first();
        $type = $request->get('type', 'all');

        $query = CashMutation::orderByDesc('transaction_date');
        if ($type === 'masuk' || $type === 'keluar') {
            $query->where('type', $type);
        }

        $mutations = $query->paginate(20);

        $totalMasuk = CashMutation::where('type', 'masuk')->sum('amount');
        $totalKeluar = CashMutation::where('type', 'keluar')->sum('amount');
        $saldoKas = 48650000.00;

        return view('admin.keuangan.buku-kas', compact(
            'profile',
            'mutations',
            'type',
            'totalMasuk',
            'totalKeluar',
            'saldoKas'
        ));
    }

    /**
     * Store Manual Cash Mutation (e.g. Kotak Jum'at or Operasional Expense)
     */
    public function storeCashMutation(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:masuk,keluar',
            'source_account' => 'required|in:bsi,sulutgo,tunai_brankas',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:500',
            'transaction_date' => 'required|date',
            'proof_slip' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        $proofPath = null;
        if ($request->hasFile('proof_slip')) {
            $file = $request->file('proof_slip');
            $filename = 'kas_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kas'), $filename);
            $proofPath = '/uploads/kas/' . $filename;
        }

        $codePrefix = $validated['type'] === 'masuk' ? 'KAS-IN-' : 'KAS-OUT-';
        $transactionCode = $codePrefix . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        CashMutation::create([
            'transaction_code' => $transactionCode,
            'type' => $validated['type'],
            'source_account' => $validated['source_account'],
            'category' => $validated['category'],
            'amount' => $validated['amount'],
            'description' => $validated['description'],
            'proof_image_path' => $proofPath,
            'recorded_by_user_id' => Auth::id(),
            'transaction_date' => $validated['transaction_date'],
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => $validated['type'] === 'masuk' ? 'Pencatatan Pemasukan Kas' : 'Pencatatan Pengeluaran Kas',
            'module' => 'Buku Kas',
            'details' => "Mencatat transaksi {$transactionCode} nominal Rp" . number_format($validated['amount'], 0, ',', '.') . " pos {$validated['category']}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $msg = $validated['type'] === 'masuk' ? 'Pemasukan kas berhasil dicatat.' : 'Penyaluran/Pengeluaran kas berhasil dibukukan.';
        return back()->with('success', $msg);
    }

    /**
     * Program Sedekah & Infaq Management
     */
    public function programSedekah()
    {
        $profile = MosqueProfile::first();
        $programs = DonationProgram::orderBy('order_index')->get();
        return view('admin.keuangan.programs', compact('profile', 'programs'));
    }

    public function storeProgram(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|in:pendidikan,operasional,sosial,darurat',
            'target_amount' => 'required|numeric|min:0',
            'collected_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'is_active' => 'nullable',
            'is_featured' => 'nullable',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . time();
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['collected_amount'] = $validated['collected_amount'] ?? 0;
        $validated['order_index'] = DonationProgram::max('order_index') + 1;

        DonationProgram::create($validated);

        return back()->with('success', 'Program sedekah & infaq berhasil dibuat.');
    }

    /**
     * Rekening Bank & QRIS
     */
    public function rekeningQris()
    {
        $profile = MosqueProfile::first();
        return view('admin.keuangan.rekening', compact('profile'));
    }

    public function updateRekening(Request $request)
    {
        $profile = MosqueProfile::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'rekening_bsi' => 'required|string|max:50',
            'rekening_bsi_an' => 'required|string|max:100',
            'rekening_sulutgo' => 'required|string|max:50',
            'rekening_sulutgo_an' => 'required|string|max:100',
            'qris_image_path' => 'nullable|string',
            'qris_file' => 'nullable|image|max:5120',
        ]);

        $qrisPath = $profile->qris_image_path;
        if ($request->hasFile('qris_file')) {
            $file = $request->file('qris_file');
            $filename = 'qris_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/qris'), $filename);
            $qrisPath = '/uploads/qris/' . $filename;
        } elseif (!empty($validated['qris_image_path'])) {
            $qrisPath = $validated['qris_image_path'];
        }

        $profile->update([
            'rekening_bsi' => $validated['rekening_bsi'],
            'rekening_bsi_an' => $validated['rekening_bsi_an'],
            'rekening_sulutgo' => $validated['rekening_sulutgo'],
            'rekening_sulutgo_an' => $validated['rekening_sulutgo_an'],
            'qris_image_path' => $qrisPath,
        ]);

        return back()->with('success', 'Nomor rekening bank dan sertifikat QRIS nasional berhasil diperbarui.');
    }

    /**
     * Integrasi Telegram Bot (Dedicated screen matching design)
     */
    public function telegram()
    {
        $profile = MosqueProfile::first();
        $telegram = TelegramSetting::firstOrCreate(['id' => 1], [
            'bot_token' => '7928374928:AAHq_bXYZ9812_sample_alfattah',
            'bot_username' => '@AlFattahOngkawBot',
            'webhook_url' => 'http://ongkaw.test/api/telegram/webhook',
            'is_active' => true,
            'notify_on_donation' => true,
            'notify_daily_recap' => true,
            'daily_recap_time' => '21:00',
            'admin_chat_ids' => [
                ['name' => 'Zulkifli Mamonto (Bendahara)', 'chat_id' => '682910291', 'role' => 'Bendahara'],
                ['name' => 'H. Ismail Paputungan (Ketua)', 'chat_id' => '102938475', 'role' => 'Ketua BKM'],
                ['name' => 'Grup Forum Inti BKM Al-Fattah', 'chat_id' => '-100192837465', 'role' => 'Kanal Broadcast'],
            ],
            'last_ping_status' => '200 OK (Latensi 128ms)',
        ]);

        return view('admin.keuangan.telegram', compact('profile', 'telegram'));
    }

    public function updateTelegram(Request $request)
    {
        $telegram = TelegramSetting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'bot_token' => 'required|string',
            'bot_username' => 'required|string',
            'webhook_url' => 'required|url',
            'is_active' => 'nullable',
            'notify_on_donation' => 'nullable',
            'notify_daily_recap' => 'nullable',
            'daily_recap_time' => 'required|string',
        ]);

        // Process chat IDs from inputs
        $chatIds = [];
        $names = $request->input('chat_names', []);
        $ids = $request->input('chat_ids', []);
        $roles = $request->input('chat_roles', []);

        foreach ($ids as $index => $id) {
            if (!empty($id)) {
                $chatIds[] = [
                    'name' => $names[$index] ?? 'Pengurus BKM',
                    'chat_id' => trim($id),
                    'role' => $roles[$index] ?? 'Admin',
                ];
            }
        }

        if (empty($chatIds)) {
            $chatIds = $telegram->admin_chat_ids;
        }

        $telegram->update([
            'bot_token' => $validated['bot_token'],
            'bot_username' => $validated['bot_username'],
            'webhook_url' => $validated['webhook_url'],
            'is_active' => $request->has('is_active'),
            'notify_on_donation' => $request->has('notify_on_donation'),
            'notify_daily_recap' => $request->has('notify_daily_recap'),
            'daily_recap_time' => $validated['daily_recap_time'],
            'admin_chat_ids' => $chatIds,
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'Pembaruan Konfigurasi Bot Telegram',
            'module' => 'Integrasi API',
            'details' => 'Memperbarui token bot, target chat ID penerima notifikasi sedekah dan webhook.',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Konfigurasi integrasi Telegram Bot berhasil disimpan.');
    }

    public function testTelegramPing(TelegramBotService $telegramBot)
    {
        $result = $telegramBot->sendTestPing();

        return response()->json([
            'success' => $result['success'],
            'message' => $result['message'],
            'time' => $result['time'] ?? now()->format('H:i:s'),
        ]);
    }

    /**
     * Laporan & Audit Publik
     */
    public function laporanKas()
    {
        $profile = MosqueProfile::first();
        $mutations = CashMutation::orderBy('transaction_date')->get();
        $totalMasuk = CashMutation::where('type', 'masuk')->sum('amount');
        $totalKeluar = CashMutation::where('type', 'keluar')->sum('amount');
        $saldoKas = 48650000.00;

        return view('admin.keuangan.laporan', compact(
            'profile',
            'mutations',
            'totalMasuk',
            'totalKeluar',
            'saldoKas'
        ));
    }

    /**
     * Log Audit Transaksi
     */
    public function auditLog()
    {
        $profile = MosqueProfile::first();
        $logs = AuditLog::orderByDesc('created_at')->paginate(25);
        return view('admin.keuangan.audit-log', compact('profile', 'logs'));
    }
}
