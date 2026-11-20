@extends('layouts.admin')

@section('title', 'Dashboard Admin Konten & Syiar Dakwah')

@section('content')
<div class="space-y-6">
    <!-- Top Action Bar & Greeting -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Ringkasan Syiar & Konten Dakwah</h1>
            <p class="text-xs text-secondary mt-0.5">
                Kelola jadwal salat, agenda kegiatan, pengumuman BKM, dan display TV Masjid Al-Fattah Ongkaw 3.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.konten.agendas') }}" class="px-4 py-2 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold transition-all shadow-sm flex items-center gap-1.5">
                <span class="material-symbols-outlined text-base">add</span> Buat Agenda Baru
            </a>
            <a href="{{ route('admin.konten.berita') }}" class="px-4 py-2 rounded-full bg-navy-card hover:bg-navy-accent text-pure-white text-xs font-semibold transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-base">post_add</span> Tulis Pengumuman
            </a>
            <form action="{{ route('admin.konten.jadwal.sync-kemenag') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3.5 py-2 rounded-full bg-surface-container hover:bg-surface-container-high text-navy-deep text-xs font-semibold transition-all flex items-center gap-1.5" title="Sinkronkan Jadwal Salat">
                    <span class="material-symbols-outlined text-base text-success">sync</span> Sinkron Kemenag
                </button>
            </form>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Metric Counter Cards (4 Columns) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1 -->
        <div class="bg-surface-container-lowest rounded-DEFAULT p-5 shadow-sm border border-surface-container flex items-center justify-between">
            <div>
                <span class="text-xs text-secondary uppercase font-semibold">Total Agenda</span>
                <div class="text-2xl font-bold text-navy-deep mt-1">{{ $totalAgendas }} Kegiatan</div>
                <span class="text-[11px] text-success font-medium">{{ $upcomingAgendas }} akan datang</span>
            </div>
            <div class="w-12 h-12 rounded-full bg-amber-glow flex items-center justify-center text-amber-hover">
                <span class="material-symbols-outlined text-2xl">event</span>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-surface-container-lowest rounded-DEFAULT p-5 shadow-sm border border-surface-container flex items-center justify-between">
            <div>
                <span class="text-xs text-secondary uppercase font-semibold">Petugas Jum'at</span>
                <div class="text-2xl font-bold text-navy-deep mt-1">{{ $fridayReadyCount }}/{{ $totalFridays }} Siap</div>
                <span class="text-[11px] text-tertiary font-medium">Bulan berjalan</span>
            </div>
            <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined text-2xl">record_voice_over</span>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-surface-container-lowest rounded-DEFAULT p-5 shadow-sm border border-surface-container flex items-center justify-between">
            <div>
                <span class="text-xs text-secondary uppercase font-semibold">Berita & Syiar</span>
                <div class="text-2xl font-bold text-navy-deep mt-1">{{ $totalNews }} Terbit</div>
                <span class="text-[11px] text-secondary">{{ $draftNews }} draft</span>
            </div>
            <div class="w-12 h-12 rounded-full bg-surface-container-high flex items-center justify-center text-navy-accent">
                <span class="material-symbols-outlined text-2xl">campaign</span>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-surface-container-lowest rounded-DEFAULT p-5 shadow-sm border border-surface-container flex items-center justify-between">
            <div>
                <span class="text-xs text-secondary uppercase font-semibold">Pesan Jamaah</span>
                <div class="text-2xl font-bold text-navy-deep mt-1">{{ $unreadMessagesCount }} Baru</div>
                <span class="text-[11px] text-error font-medium">Perlu tindak lanjut</span>
            </div>
            <div class="w-12 h-12 rounded-full bg-error-container/60 flex items-center justify-center text-error">
                <span class="material-symbols-outlined text-2xl">inbox</span>
            </div>
        </div>
    </div>

    <!-- Main Content Layout: Left 8 cols, Right 4 cols -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- LEFT COLUMN (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            <!-- SECTION A: Jadwal Salat & Petugas Jum'at Preview -->
            <div class="bg-surface-container-lowest rounded-lg p-6 shadow-sm space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-surface-container-low pb-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-primary text-xl">access_time</span>
                            <h2 class="text-base font-bold text-navy-deep">Jadwal Salat & Kesiapan Petugas Jum'at</h2>
                        </div>
                        <p class="text-xs text-secondary mt-0.5">
                            Wilayah Ongkaw 3 & Sinonsayang, Minahasa Selatan (BHRD Kemenag +2m Ikhtiyat)
                        </p>
                    </div>
                    <a href="{{ route('admin.konten.jadwal') }}" class="text-xs font-semibold text-primary hover:text-amber-hover flex items-center gap-1">
                        Detail Lengkap <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <!-- Highlight Box: Jum'at Terdekat -->
                @if($nextFriday)
                    <div class="relative overflow-hidden rounded-DEFAULT bg-navy-card text-pure-white p-5">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded bg-amber-primary text-navy-deep text-xs font-bold uppercase tracking-wider">
                                    Jum'at Terdekat
                                </span>
                                <span class="text-sm font-semibold text-amber-glow">
                                    {{ \Carbon\Carbon::parse($nextFriday->date)->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <span class="text-xs text-secondary-fixed-dim flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm text-amber-primary">alarm</span>
                                Awal Khutbah: <strong class="text-pure-white">11.55 WITA</strong>
                            </span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 py-2 text-xs">
                            <div class="p-3 rounded bg-navy-accent/50">
                                <span class="text-secondary-fixed-dim block text-[11px]">Khatib:</span>
                                <p class="font-bold text-pure-white mt-0.5 truncate">{{ $nextFriday->khatib_name }}</p>
                                <p class="text-amber-glow/80 italic mt-0.5 truncate text-[11px]">Tema: "{{ $nextFriday->khutbah_title ?? 'Kemaslahatan Ummat' }}"</p>
                            </div>
                            <div class="p-3 rounded bg-navy-accent/50">
                                <span class="text-secondary-fixed-dim block text-[11px]">Imam Rawatib:</span>
                                <p class="font-bold text-pure-white mt-0.5 truncate">{{ $nextFriday->imam_name }}</p>
                                <p class="text-secondary-fixed-dim mt-0.5 text-[11px]">Ust. Rawatib Al-Fattah</p>
                            </div>
                            <div class="p-3 rounded bg-navy-accent/50">
                                <span class="text-secondary-fixed-dim block text-[11px]">Muadzin & Bilal:</span>
                                <p class="font-bold text-pure-white mt-0.5 truncate">{{ $nextFriday->bilal_name }}</p>
                                <p class="text-secondary-fixed-dim mt-0.5 text-[11px]">Remaja Masjid Al-Fattah</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Quick Prayer Matrix Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2 pt-2">
                    <div class="rounded p-2.5 bg-surface-container-low text-center">
                        <span class="text-[11px] font-bold text-secondary uppercase">Subuh</span>
                        <div class="text-base font-bold text-navy-deep mt-0.5">{{ $todaySchedule->subuh ?? '04:22' }}</div>
                        <span class="text-[10px] text-on-surface-variant block mt-1">Jeda: 10m</span>
                    </div>
                    <div class="rounded p-2.5 bg-surface-container-low text-center opacity-80">
                        <span class="text-[11px] font-bold text-secondary uppercase">Syuruq</span>
                        <div class="text-base font-semibold text-navy-deep mt-0.5">{{ $todaySchedule->syuruq ?? '05:38' }}</div>
                        <span class="text-[10px] text-secondary block mt-1">Terbit</span>
                    </div>
                    <div class="rounded p-2.5 bg-amber-glow text-center border border-amber-primary/30">
                        <span class="text-[11px] font-bold text-amber-hover uppercase">Dzuhur</span>
                        <div class="text-base font-bold text-navy-deep mt-0.5">{{ $todaySchedule->dzuhur ?? '11:46' }}</div>
                        <span class="text-[10px] text-primary font-bold block mt-1">Jeda: 7m</span>
                    </div>
                    <div class="rounded p-2.5 bg-surface-container-low text-center">
                        <span class="text-[11px] font-bold text-secondary uppercase">Ashar</span>
                        <div class="text-base font-bold text-navy-deep mt-0.5">{{ $todaySchedule->ashar ?? '15:08' }}</div>
                        <span class="text-[10px] text-on-surface-variant block mt-1">Jeda: 7m</span>
                    </div>
                    <div class="rounded p-2.5 bg-surface-container-low text-center">
                        <span class="text-[11px] font-bold text-secondary uppercase">Maghrib</span>
                        <div class="text-base font-bold text-navy-deep mt-0.5">{{ $todaySchedule->maghrib ?? '17:48' }}</div>
                        <span class="text-[10px] text-on-surface-variant block mt-1">Jeda: 5m</span>
                    </div>
                    <div class="rounded p-2.5 bg-surface-container-low text-center">
                        <span class="text-[11px] font-bold text-secondary uppercase">Isya</span>
                        <div class="text-base font-bold text-navy-deep mt-0.5">{{ $todaySchedule->isya ?? '19:00' }}</div>
                        <span class="text-[10px] text-on-surface-variant block mt-1">Jeda: 10m</span>
                    </div>
                </div>
            </div>

            <!-- SECTION B: Agenda Dakwah & Majelis Overview -->
            <div class="bg-surface-container-lowest rounded-lg p-6 shadow-sm space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-surface-container-low pb-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-primary text-xl">event_available</span>
                            <h2 class="text-base font-bold text-navy-deep">Agenda Dakwah & Majelis</h2>
                        </div>
                        <p class="text-xs text-secondary mt-0.5">Daftar kegiatan dakwah dan majelis ilmu terbaru</p>
                    </div>
                    <a href="{{ route('admin.konten.agendas') }}" class="text-xs font-semibold text-primary hover:text-amber-hover flex items-center gap-1">
                        Kelola Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentAgendas as $ag)
                        <div class="rounded-DEFAULT p-4 bg-surface-container-low hover:bg-surface-container transition-colors flex flex-col md:flex-row md:items-center justify-between gap-3">
                            <div class="space-y-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold {{ $ag->status === 'published' ? 'bg-success/15 text-success' : 'bg-surface-container-high text-secondary' }}">
                                        {{ $ag->status === 'published' ? 'Terbit' : 'Draft' }}
                                    </span>
                                    <span class="text-xs text-secondary flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        {{ \Carbon\Carbon::parse($ag->date_time)->translatedFormat('d M Y, H:i') }} WITA
                                    </span>
                                </div>
                                <h3 class="text-sm font-bold text-navy-deep truncate">{{ $ag->title }}</h3>
                                <p class="text-xs text-secondary truncate">Pemateri: {{ $ag->speaker ?? 'Sekretariat BKM' }} • Lokasi: {{ $ag->location ?? 'Masjid Al-Fattah' }}</p>
                            </div>
                            <div class="flex items-center gap-1 shrink-0">
                                <a href="https://wa.me/?text={{ urlencode('Bismillah, mari hadiri ' . $ag->title . ' pada ' . \Carbon\Carbon::parse($ag->date_time)->translatedFormat('l, d M Y H:i') . ' WITA.') }}" target="_blank" class="p-1.5 rounded-full hover:bg-surface-container-highest text-success" title="Bagikan ke WA">
                                    <span class="material-symbols-outlined text-base">share</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-secondary text-xs">Belum ada agenda yang tersimpan.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- WIDGET 1: Pesan Masuk dari Jamaah -->
            <div class="bg-surface-container-lowest rounded-lg p-5 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-surface-container-low pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-primary text-xl">inbox</span>
                        <h3 class="text-sm font-bold text-navy-deep">Pesan Masuk Jamaah</h3>
                    </div>
                    @if($unreadMessagesCount > 0)
                        <span class="px-2 py-0.5 rounded-full bg-error-container text-error text-[11px] font-bold">
                            {{ $unreadMessagesCount }} Baru
                        </span>
                    @endif
                </div>

                <div class="space-y-3">
                    @forelse($recentMessages as $msg)
                        <div class="p-3 rounded-DEFAULT bg-surface-container-low space-y-1.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-navy-deep">{{ $msg->name }}</span>
                                <span class="text-[10px] text-secondary">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-on-surface-variant line-clamp-2 leading-snug">
                                "{{ $msg->message }}"
                            </p>
                            @if($msg->phone)
                                <div class="pt-1 flex justify-end">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="text-[11px] text-success font-semibold flex items-center gap-1 hover:underline">
                                        <span class="material-symbols-outlined text-xs">chat</span> Balas WA
                                    </a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="p-4 text-center text-xs text-secondary">Kotak masuk pesan kosong.</div>
                    @endforelse
                </div>

                <div class="pt-2 text-center">
                    <a href="{{ route('admin.konten.pesan') }}" class="text-xs text-primary font-bold hover:underline flex items-center justify-center gap-1">
                        Lihat Semua Pesan <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </a>
                </div>
            </div>

            <!-- WIDGET 2: Running Text TV Simulator Card -->
            <div class="bg-navy-card text-pure-white rounded-lg p-5 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-primary text-xl">tv</span>
                        <h3 class="text-sm font-bold text-pure-white">Running Text Display TV</h3>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-success animate-pulse"></span>
                </div>

                <div class="bg-black/60 p-3 rounded border border-amber-primary/30 overflow-hidden">
                    <p class="text-xs font-mono text-amber-glow truncate animate-marquee">
                        {{ $prayerSetting->tv_running_text ?? 'Luruskan & rapatkan saf. Matikan nada dering HP. Selamat beribadah di Masjid Al-Fattah.' }}
                    </p>
                </div>

                <form action="{{ route('admin.konten.jadwal.update-tv') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-[11px] text-secondary-fixed-dim uppercase mb-1">Perbarui Teks Berjalan</label>
                        <textarea name="tv_running_text" rows="2" class="w-full px-3 py-2 bg-navy-accent/60 text-white rounded text-xs focus:outline-none focus:ring-1 focus:ring-amber-primary">{{ $prayerSetting->tv_running_text ?? '' }}</textarea>
                    </div>
                    <input type="hidden" name="tv_marquee_speed" value="{{ $prayerSetting->tv_marquee_speed ?? 'normal' }}"/>
                    <button type="submit" class="w-full py-2 rounded-full bg-amber-primary hover:bg-amber-hover text-navy-deep font-bold text-xs transition-colors">
                        Simpan ke TV Masjid
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
