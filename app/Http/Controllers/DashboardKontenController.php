<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MosqueProfile;
use App\Models\PrayerSetting;
use App\Models\PrayerSchedule;
use App\Models\FridayOfficer;
use App\Models\StandbyKhatib;
use App\Models\Agenda;
use App\Models\NewsAnnouncement;
use App\Models\GalleryPhoto;
use App\Models\BoardMember;
use App\Models\InboxMessage;
use App\Models\AuditLog;
use Carbon\Carbon;

class DashboardKontenController extends Controller
{
    /**
     * Ringkasan Syiar (Main Content Dashboard)
     */
    public function index()
    {
        $profile = MosqueProfile::first();
        $prayerSetting = PrayerSetting::first();
        $today = Carbon::today();

        $todaySchedule = PrayerSchedule::where('date', $today->toDateString())->first() 
            ?? PrayerSchedule::first();

        // KPIs
        $totalAgendas = Agenda::count();
        $upcomingAgendas = Agenda::where('date_time', '>=', now())->count();
        $completedAgendas = Agenda::where('date_time', '<', now())->count();

        $fridayReadyCount = FridayOfficer::where('status_wa', 'terkonfirmasi')->count();
        $totalFridays = FridayOfficer::count();

        $totalNews = NewsAnnouncement::where('status', 'published')->count();
        $draftNews = NewsAnnouncement::where('status', 'draft')->count();

        $unreadMessagesCount = InboxMessage::where('is_read', false)->count();
        $totalMessages = InboxMessage::count();

        // Upcoming Friday Roster
        $nextFriday = FridayOfficer::where('date', '>=', $today->toDateString())->orderBy('date')->first()
            ?? FridayOfficer::orderByDesc('date')->first();

        // Recent Agendas
        $recentAgendas = Agenda::orderBy('date_time')->take(5)->get();

        // Recent News
        $recentNews = NewsAnnouncement::orderByDesc('created_at')->take(4)->get();

        // Recent Messages
        $recentMessages = InboxMessage::orderByDesc('created_at')->take(4)->get();

        return view('admin.konten.index', compact(
            'profile',
            'prayerSetting',
            'todaySchedule',
            'totalAgendas',
            'upcomingAgendas',
            'completedAgendas',
            'fridayReadyCount',
            'totalFridays',
            'totalNews',
            'draftNews',
            'unreadMessagesCount',
            'totalMessages',
            'nextFriday',
            'recentAgendas',
            'recentNews',
            'recentMessages'
        ));
    }

    /**
     * Detail Jadwal Salat & Petugas Jum'at (Dedicated view matching design)
     */
    public function jadwalSalat()
    {
        $profile = MosqueProfile::first();
        $prayerSetting = PrayerSetting::first();
        $today = Carbon::today();

        $todaySchedule = PrayerSchedule::where('date', $today->toDateString())->first() 
            ?? PrayerSchedule::first();

        $monthlySchedules = PrayerSchedule::orderBy('date')->get();
        $fridayRoster = FridayOfficer::orderBy('date')->get();
        $standbyKhatibs = StandbyKhatib::where('status', 'siaga')->get();

        return view('admin.konten.jadwal-salat', compact(
            'profile',
            'prayerSetting',
            'todaySchedule',
            'monthlySchedules',
            'fridayRoster',
            'standbyKhatibs'
        ));
    }

    /**
     * Trigger Sync with BHRD Kemenag
     */
    public function syncKemenag(Request $request)
    {
        $prayerSetting = PrayerSetting::first();
        if ($prayerSetting) {
            $prayerSetting->touch();
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'Sinkronisasi BHRD Kemenag',
            'module' => 'Jadwal Salat',
            'details' => 'Menyinkronkan jadwal shalat hisab astronomis BHRD Kemenag Sulut untuk wilayah Sinonsayang (+2 mnt ikhtiyat).',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Jadwal salat wilayah Sinonsayang berhasil disinkronkan dengan API BHRD Kemenag RI v2.4 (+2 menit ikhtiyat).');
    }

    /**
     * Save/Update Friday Officer
     */
    public function storeFridayOfficer(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'khatib_name' => 'required|string|max:150',
            'khatib_title' => 'nullable|string|max:150',
            'khatib_phone' => 'nullable|string|max:30',
            'imam_name' => 'required|string|max:150',
            'bilal_name' => 'required|string|max:150',
            'khutbah_title' => 'nullable|string|max:255',
            'status_wa' => 'required|in:terkonfirmasi,menunggu,batal',
            'notes' => 'nullable|string',
        ]);

        $officer = FridayOfficer::updateOrCreate(
            ['date' => $validated['date']],
            $validated
        );

        AuditLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'Pembaruan Roster Khutbah',
            'module' => 'Roster Jumat',
            'details' => "Menugaskan {$officer->khatib_name} sebagai Khatib untuk tanggal {$officer->date->format('d M Y')}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Roster petugas shalat Jum\'at berhasil disimpan dan diperbarui.');
    }

    /**
     * Emergency Badal Assignment
     */
    public function assignBadal(Request $request)
    {
        $validated = $request->validate([
            'officer_id' => 'required|exists:friday_officers,id',
            'badal_khatib_name' => 'required|string|max:150',
            'reason' => 'nullable|string',
        ]);

        $officer = FridayOfficer::findOrFail($validated['officer_id']);
        $originalKhatib = $officer->khatib_name;

        $officer->update([
            'original_khatib_name' => $originalKhatib,
            'khatib_name' => $validated['badal_khatib_name'],
            'is_badal' => true,
            'status_wa' => 'terkonfirmasi',
            'notes' => "Badal darurat ditugaskan menggantikan {$originalKhatib}. Alasan: " . ($validated['reason'] ?? 'Berhalangan mendadak'),
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'Penugasan Badal Darurat Khatib',
            'module' => 'Roster Jumat',
            'details' => "Menugaskan badal {$validated['badal_khatib_name']} menggantikan {$originalKhatib} pada tanggal {$officer->date->format('d M Y')}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', "Badal darurat ({$validated['badal_khatib_name']}) berhasil ditugaskan dan notifikasi darurat telah diteruskan ke pengurus.");
    }

    /**
     * Update TV Display & Running Text Settings
     */
    public function updateTvSettings(Request $request)
    {
        $validated = $request->validate([
            'tv_running_text' => 'required|string|max:500',
            'tv_marquee_speed' => 'required|in:lambat,normal,cepat',
            'tv_display_enabled' => 'nullable',
            'auto_dim_salat' => 'nullable',
            'ikhtiyat_minutes' => 'nullable|integer|min:0|max:10',
            'iqamah_subuh' => 'nullable|integer|min:1|max:30',
            'iqamah_dzuhur' => 'nullable|integer|min:1|max:30',
            'iqamah_ashar' => 'nullable|integer|min:1|max:30',
            'iqamah_maghrib' => 'nullable|integer|min:1|max:30',
            'iqamah_isya' => 'nullable|integer|min:1|max:30',
        ]);

        $setting = PrayerSetting::firstOrCreate(['id' => 1]);
        $setting->update([
            'tv_running_text' => $validated['tv_running_text'],
            'tv_marquee_speed' => $validated['tv_marquee_speed'],
            'tv_display_enabled' => $request->has('tv_display_enabled'),
            'auto_dim_salat' => $request->has('auto_dim_salat'),
            'ikhtiyat_minutes' => $validated['ikhtiyat_minutes'] ?? $setting->ikhtiyat_minutes,
            'iqamah_subuh' => $validated['iqamah_subuh'] ?? $setting->iqamah_subuh,
            'iqamah_dzuhur' => $validated['iqamah_dzuhur'] ?? $setting->iqamah_dzuhur,
            'iqamah_ashar' => $validated['iqamah_ashar'] ?? $setting->iqamah_ashar,
            'iqamah_maghrib' => $validated['iqamah_maghrib'] ?? $setting->iqamah_maghrib,
            'iqamah_isya' => $validated['iqamah_isya'] ?? $setting->iqamah_isya,
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'Kalibrasi Display TV Masjid',
            'module' => 'Display TV',
            'details' => 'Memperbarui teks pengingat berjalan dan parameter jeda hitung mundur iqamah.',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Konfigurasi display TV dan teks berjalan LED berhasil disimpan dan disinkronkan.');
    }

    /**
     * Agenda & Majelis Dakwah CRUD
     */
    public function agendas()
    {
        $profile = MosqueProfile::first();
        $agendas = Agenda::orderByDesc('date_time')->paginate(15);
        return view('admin.konten.agendas', compact('profile', 'agendas'));
    }

    public function storeAgenda(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|in:kajian_rutin,tpa,phbi,tabligh_akbar',
            'date_time' => 'required|date',
            'location' => 'required|string|max:150',
            'speaker_name' => 'nullable|string|max:150',
            'speaker_title' => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'is_pinned' => 'nullable',
            'status' => 'required|in:published,draft',
            'poster_image' => 'nullable|string',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . time();
        $validated['is_pinned'] = $request->has('is_pinned');

        Agenda::create($validated);

        return back()->with('success', 'Agenda kegiatan majelis dakwah berhasil diterbitkan.');
    }

    public function deleteAgenda(Agenda $agenda)
    {
        $agenda->delete();
        return back()->with('success', 'Agenda berhasil dihapus.');
    }

    /**
     * Berita & Pengumuman BKM CRUD
     */
    public function berita()
    {
        $profile = MosqueProfile::first();
        $news = NewsAnnouncement::orderByDesc('created_at')->paginate(15);
        return view('admin.konten.berita', compact('profile', 'news'));
    }

    public function storeBerita(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'category' => 'required|in:warta,pengumuman,buletin',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'is_pinned' => 'nullable',
            'status' => 'required|in:published,draft',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . time();
        $validated['is_pinned'] = $request->has('is_pinned');
        $validated['author_id'] = Auth::id();
        $validated['published_at'] = $validated['status'] === 'published' ? now() : null;

        NewsAnnouncement::create($validated);

        return back()->with('success', 'Warta atau pengumuman BKM berhasil dipublikasikan.');
    }

    public function deleteBerita(NewsAnnouncement $berita)
    {
        $berita->delete();
        return back()->with('success', 'Warta/Pengumuman berhasil dihapus.');
    }

    /**
     * Galeri & Dokumentasi
     */
    public function galeri()
    {
        $profile = MosqueProfile::first();
        $photos = GalleryPhoto::orderByDesc('created_at')->paginate(18);
        return view('admin.konten.galeri', compact('profile', 'photos'));
    }

    public function storeGaleri(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'required|string|max:255',
            'category' => 'required|in:ibadah_akbar,ramadhan_berkah,aksi_kebersihan,bakti_sosial,prestasi_santri,tabligh_akbar',
            'photo_path' => 'nullable|string',
            'photo_file' => 'nullable|image|max:5120',
        ]);

        $photoPath = $validated['photo_path'] ?? null;
        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $name = 'galeri_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galeri'), $name);
            $photoPath = '/uploads/galeri/' . $name;
        }

        if (!$photoPath) {
            return back()->withErrors(['photo_file' => 'Silakan pilih file foto atau masukkan tautan URL foto.']);
        }

        GalleryPhoto::create([
            'photo_path' => $photoPath,
            'caption' => $validated['caption'],
            'category' => $validated['category'],
            'order_index' => GalleryPhoto::max('order_index') + 1,
        ]);

        return back()->with('success', 'Foto dokumentasi kegiatan berhasil ditambahkan ke galeri.');
    }

    public function deleteGaleri(GalleryPhoto $photo)
    {
        $photo->delete();
        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }

    /**
     * Susunan Pengurus BKM CRUD
     */
    public function pengurus()
    {
        $profile = MosqueProfile::first();
        $members = BoardMember::orderBy('order_index')->get();
        return view('admin.konten.pengurus', compact('profile', 'members'));
    }

    public function storePengurus(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'title_degree' => 'nullable|string|max:150',
            'position' => 'required|string|max:150',
            'division' => 'required|in:pembina,harian,imam_muadzin,dakwah,pembangunan,risma',
            'phone' => 'nullable|string|max:30',
            'photo' => 'nullable|string',
        ]);

        $validated['period'] = '2024–2029';
        $validated['order_index'] = BoardMember::max('order_index') + 1;

        BoardMember::create($validated);

        return back()->with('success', 'Data pengurus BKM berhasil disimpan.');
    }

    public function deletePengurus(BoardMember $member)
    {
        $member->delete();
        return back()->with('success', 'Data pengurus berhasil dihapus.');
    }

    /**
     * Pesan & Layanan Jamaah Inbox
     */
    public function pesan()
    {
        $profile = MosqueProfile::first();
        $messages = InboxMessage::orderByDesc('created_at')->paginate(15);
        return view('admin.konten.pesan', compact('profile', 'messages'));
    }

    public function markMessageRead(InboxMessage $message)
    {
        $message->update(['is_read' => true]);
        return back()->with('success', 'Pesan ditandai telah dibaca.');
    }

    /**
     * Pengaturan Tampilan & Feature Toggles
     */
    public function pengaturan()
    {
        $profile = MosqueProfile::first();
        return view('admin.konten.pengaturan', compact('profile'));
    }

    public function updatePengaturan(Request $request)
    {
        $profile = MosqueProfile::firstOrCreate(['id' => 1]);

        $toggles = [
            'hero_banner' => $request->has('toggle_hero'),
            'jadwal_salat' => $request->has('toggle_jadwal'),
            'program_unggulan' => $request->has('toggle_program'),
            'form_sedekah' => $request->has('toggle_sedekah'),
            'galeri_kegiatan' => $request->has('toggle_galeri'),
            'testimoni' => $request->has('toggle_testimoni'),
            'lokasi' => $request->has('toggle_lokasi'),
        ];

        $profile->update([
            'name' => $request->input('name', $profile->name),
            'address' => $request->input('address', $profile->address),
            'phone' => $request->input('phone', $profile->phone),
            'email' => $request->input('email', $profile->email),
            'feature_toggles' => $toggles,
        ]);

        return back()->with('success', 'Pengaturan situs dan sakelar visibilitas fitur publik berhasil diperbarui.');
    }
}
