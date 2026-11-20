<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MosqueProfile;
use App\Models\PrayerSetting;
use App\Models\PrayerSchedule;
use App\Models\FridayOfficer;
use App\Models\RoutineProgram;
use App\Models\DonationProgram;
use App\Models\Donation;
use App\Models\CashMutation;
use App\Models\Agenda;
use App\Models\NewsAnnouncement;
use App\Models\BoardMember;
use App\Models\GalleryPhoto;
use App\Models\Testimonial;
use App\Models\InboxMessage;
use App\Services\TelegramBotService;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Beranda (Landing Page)
     */
    public function index()
    {
        $profile = MosqueProfile::first();
        $prayerSetting = PrayerSetting::first();
        
        $today = Carbon::today();
        $todaySchedule = PrayerSchedule::where('date', $today->toDateString())->first() 
            ?? PrayerSchedule::first();

        $routines = RoutineProgram::where('is_active', true)->orderBy('order_index')->take(4)->get();
        $featuredProgram = DonationProgram::where('is_active', true)->where('is_featured', true)->first()
            ?? DonationProgram::where('is_active', true)->first();

        $donationPrograms = DonationProgram::where('is_active', true)->orderBy('order_index')->get();

        $galleryPhotos = GalleryPhoto::orderBy('order_index')->take(6)->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order_index')->take(3)->get();
        
        $nextFriday = FridayOfficer::where('date', '>=', $today->toDateString())->orderBy('date')->first()
            ?? FridayOfficer::orderByDesc('date')->first();

        // Calculate Next Prayer
        $prayerInfo = $this->calculateNextPrayer($todaySchedule, $prayerSetting);

        return view('public.beranda', compact(
            'profile',
            'prayerSetting',
            'todaySchedule',
            'routines',
            'featuredProgram',
            'donationPrograms',
            'galleryPhotos',
            'testimonials',
            'nextFriday',
            'prayerInfo'
        ));
    }

    /**
     * Jadwal Salat & Kegiatan Dakwah
     */
    public function jadwalSalat(Request $request)
    {
        $profile = MosqueProfile::first();
        $prayerSetting = PrayerSetting::first();
        $today = Carbon::today();

        $todaySchedule = PrayerSchedule::where('date', $today->toDateString())->first() 
            ?? PrayerSchedule::first();

        $prayerInfo = $this->calculateNextPrayer($todaySchedule, $prayerSetting);

        // Monthly schedule
        $schedules = PrayerSchedule::orderBy('date')->get();

        // Friday officers
        $fridayRoster = FridayOfficer::orderBy('date')->get();

        // Agendas with category filter
        $category = $request->get('kategori', 'semua');
        $query = Agenda::where('status', 'published');
        if ($category && $category !== 'semua') {
            $query->where('category', $category);
        }
        $agendas = $query->orderBy('date_time')->get();

        return view('public.jadwal-salat', compact(
            'profile',
            'prayerSetting',
            'todaySchedule',
            'prayerInfo',
            'schedules',
            'fridayRoster',
            'agendas',
            'category'
        ));
    }

    /**
     * Sedekah & Transparansi Keuangan
     */
    public function sedekah()
    {
        $profile = MosqueProfile::first();
        $programs = DonationProgram::where('is_active', true)->orderBy('order_index')->get();

        // Financial metrics
        $infaqMonth = CashMutation::where('type', 'masuk')->sum('amount');
        $pengeluaranMonth = CashMutation::where('type', 'keluar')->sum('amount');
        $saldoKas = 48650000.00; // Verified baseline or dynamic from cash mutations

        // Recent public cash mutations for transparency
        $mutations = CashMutation::orderByDesc('transaction_date')->take(10)->get();

        // Recent donors list
        $recentDonors = Donation::where('status', 'verified')->orderByDesc('created_at')->take(10)->get();

        return view('public.sedekah', compact(
            'profile',
            'programs',
            'infaqMonth',
            'pengeluaranMonth',
            'saldoKas',
            'mutations',
            'recentDonors'
        ));
    }

    /**
     * Process Public Donation Form Submission
     */
    public function submitDonasi(Request $request, TelegramBotService $telegramBot)
    {
        $validated = $request->validate([
            'program_id' => 'nullable|exists:donation_programs,id',
            'amount' => 'required|numeric|min:10000',
            'frequency' => 'required|in:sekali,harian,bulanan',
            'donor_name' => 'nullable|string|max:255',
            'is_anonymous' => 'nullable',
            'phone_wa' => 'nullable|string|max:30',
            'payment_method' => 'required|in:qris,transfer_bsi,transfer_sulutgo,tunai_kotak',
            'donor_prayer' => 'nullable|string|max:1000',
            'proof_slip' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        $isAnon = $request->has('is_anonymous') || empty($validated['donor_name']);
        $donorName = $isAnon ? 'Hamba Allah' : ($validated['donor_name'] ?: 'Hamba Allah');

        // Reference Code Generator: ALF-YYYYMMDD-XXXX
        $refCode = 'ALF-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        // Handle slip file upload
        $proofPath = null;
        if ($request->hasFile('proof_slip')) {
            $file = $request->file('proof_slip');
            $filename = 'slip_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/slips'), $filename);
            $proofPath = '/uploads/slips/' . $filename;
        }

        $donation = Donation::create([
            'reference_code' => $refCode,
            'donation_program_id' => $validated['program_id'] ?? null,
            'donor_name' => $donorName,
            'is_anonymous' => $isAnon,
            'phone_wa' => $validated['phone_wa'] ?? null,
            'amount' => $validated['amount'],
            'frequency' => $validated['frequency'],
            'payment_method' => $validated['payment_method'],
            'proof_image_path' => $proofPath,
            'donor_prayer' => $validated['donor_prayer'] ?? null,
            'status' => 'pending',
        ]);

        // Dispatch Instant Telegram Alert
        try {
            $telegramBot->sendDonationAlert($donation);
        } catch (\Exception $e) {
            // Non-blocking
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'reference_code' => $refCode,
                'message' => 'Alhamdulillah, data sedekah Anda berhasil dicatat dan menunggu verifikasi bendahara.',
                'amount' => $donation->amount,
                'program' => $donation->program ? $donation->program->title : 'Sedekah Umum',
            ]);
        }

        return redirect()->route('sedekah')->with([
            'donation_success' => true,
            'reference_code' => $refCode,
            'amount' => $donation->amount,
            'payment_method' => $donation->payment_method,
        ]);
    }

    /**
     * Pengurus & Profil Masjid
     */
    public function pengurus()
    {
        $profile = MosqueProfile::first();
        
        $pembina = BoardMember::where('division', 'pembina')->orderBy('order_index')->get();
        $harian = BoardMember::where('division', 'harian')->orderBy('order_index')->get();
        $imamMuadzin = BoardMember::where('division', 'imam_muadzin')->orderBy('order_index')->get();
        $risma = BoardMember::where('division', 'risma')->orderBy('order_index')->get();

        return view('public.pengurus', compact(
            'profile',
            'pembina',
            'harian',
            'imamMuadzin',
            'risma'
        ));
    }

    /**
     * Layanan & Program Unggulan
     */
    public function layananProgram()
    {
        $profile = MosqueProfile::first();
        $routines = RoutineProgram::where('is_active', true)->orderBy('order_index')->get();
        $donationPrograms = DonationProgram::where('is_active', true)->orderBy('order_index')->get();

        return view('public.layanan-program', compact('profile', 'routines', 'donationPrograms'));
    }

    /**
     * Galeri & Dokumentasi Kegiatan
     */
    public function galeri(Request $request)
    {
        $profile = MosqueProfile::first();
        $category = $request->get('kategori', 'semua');

        $query = GalleryPhoto::orderBy('order_index');
        if ($category && $category !== 'semua') {
            $query->where('category', $category);
        }
        $photos = $query->get();

        return view('public.galeri', compact('profile', 'photos', 'category'));
    }

    /**
     * Kontak & Pengaduan Jamaah
     */
    public function kontak()
    {
        $profile = MosqueProfile::first();
        return view('public.kontak', compact('profile'));
    }

    public function submitPesan(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:30',
            'category' => 'required|in:pertanyaan,doa,pinjam_aula,pendaftaran_tpa,pengaduan',
            'message' => 'required|string|max:2000',
        ]);

        InboxMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'category' => $validated['category'],
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        return back()->with('success', 'Jazakallahu khair. Pesan permohonan / aspirasi Anda telah diterima oleh Sekretariat BKM Al-Fattah.');
    }

    /**
     * Helper to compute next prayer time and countdown in WITA
     */
    protected function calculateNextPrayer($schedule, $settings)
    {
        if (!$schedule) {
            return [
                'current_prayer' => 'Dzuhur',
                'next_prayer' => 'Ashar',
                'next_time' => '15:18',
                'countdown' => '3 Jam 02 Menit',
                'active_slot' => 'dzuhur',
            ];
        }

        $now = Carbon::now('Asia/Makassar');
        $currentTimeStr = $now->format('H:i');

        $prayers = [
            'Subuh' => $schedule->subuh,
            'Syuruq' => $schedule->syuruq,
            'Dzuhur' => $schedule->dzuhur,
            'Ashar' => $schedule->ashar,
            'Maghrib' => $schedule->maghrib,
            'Isya' => $schedule->isya,
        ];

        $currentPrayer = 'Isya';
        $nextPrayer = 'Subuh';
        $nextTime = $schedule->subuh;
        $activeSlot = 'isya';

        if ($currentTimeStr < $schedule->subuh) {
            $currentPrayer = 'Tahajud';
            $nextPrayer = 'Subuh';
            $nextTime = $schedule->subuh;
            $activeSlot = 'subuh';
        } elseif ($currentTimeStr < $schedule->syuruq) {
            $currentPrayer = 'Subuh';
            $nextPrayer = 'Syuruq';
            $nextTime = $schedule->syuruq;
            $activeSlot = 'subuh';
        } elseif ($currentTimeStr < $schedule->dzuhur) {
            $currentPrayer = 'Syuruq';
            $nextPrayer = 'Dzuhur';
            $nextTime = $schedule->dzuhur;
            $activeSlot = 'syuruq';
        } elseif ($currentTimeStr < $schedule->ashar) {
            $currentPrayer = 'Dzuhur';
            $nextPrayer = 'Ashar';
            $nextTime = $schedule->ashar;
            $activeSlot = 'dzuhur';
        } elseif ($currentTimeStr < $schedule->maghrib) {
            $currentPrayer = 'Ashar';
            $nextPrayer = 'Maghrib';
            $nextTime = $schedule->maghrib;
            $activeSlot = 'ashar';
        } elseif ($currentTimeStr < $schedule->isya) {
            $currentPrayer = 'Maghrib';
            $nextPrayer = 'Isya';
            $nextTime = $schedule->isya;
            $activeSlot = 'maghrib';
        }

        // Calculate countdown minutes
        $targetTime = Carbon::createFromTimeString($nextTime, 'Asia/Makassar');
        if ($targetTime->lessThan($now)) {
            $targetTime->addDay();
        }
        $diffMinutes = $now->diffInMinutes($targetTime);
        $hours = floor($diffMinutes / 60);
        $mins = $diffMinutes % 60;
        $countdown = ($hours > 0 ? "{$hours} Jam " : "") . "{$mins} Menit";

        return [
            'current_prayer' => $currentPrayer,
            'next_prayer' => $nextPrayer,
            'next_time' => $nextTime,
            'countdown' => $countdown,
            'active_slot' => $activeSlot,
        ];
    }
}
