@extends('layouts.admin')

@section('title', 'Detail Jadwal Salat & Petugas Jum\'at')

@section('content')
<div class="space-y-6">
    <!-- Header with Sync Button & Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Detail Jadwal Salat & Petugas Jum'at</h1>
            <p class="text-xs text-secondary mt-0.5">
                Wilayah Sinonsayang, Minahasa Selatan (0.912° LU, 124.365° BT) • Ikhtiyat +2 Menit
            </p>
        </div>
        <div class="flex items-center gap-2">
            <form action="{{ route('admin.konten.jadwal.sync-kemenag') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-full bg-surface-container hover:bg-surface-container-high text-navy-deep text-xs font-semibold flex items-center gap-1.5 transition-all">
                    <span class="material-symbols-outlined text-base text-success">sync</span> Sinkron Kemenag RI
                </button>
            </form>
            <button onclick="document.getElementById('modal-tambah-petugas').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all">
                <span class="material-symbols-outlined text-base">person_add</span> + Atur Petugas Jum'at
            </button>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- 6 Prayer Cards Row with Delays & Calibrations -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        <!-- Subuh -->
        <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-secondary uppercase">Subuh</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-surface-container text-secondary">Fajar</span>
            </div>
            <div class="my-2">
                <div class="text-2xl font-bold text-navy-deep">{{ $todaySchedule->subuh ?? '04:22' }}</div>
                <div class="text-[11px] text-primary font-semibold">Ikhtiyat +2m</div>
            </div>
            <div class="bg-surface-container-low p-2 rounded text-[11px] text-secondary flex justify-between">
                <span>Jeda Iqamah:</span>
                <strong class="text-navy-deep">{{ $prayerSetting->iqamah_subuh_delay ?? 10 }} mnt</strong>
            </div>
        </div>

        <!-- Syuruq -->
        <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col justify-between opacity-80">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-secondary uppercase">Syuruq</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-surface-container text-secondary">Pagi</span>
            </div>
            <div class="my-2">
                <div class="text-2xl font-bold text-navy-deep">{{ $todaySchedule->syuruq ?? '05:38' }}</div>
                <div class="text-[11px] text-secondary">Terbit Terang</div>
            </div>
            <div class="bg-surface-container-low p-2 rounded text-[11px] text-secondary text-center">
                Waktu Syuruq
            </div>
        </div>

        <!-- Dzuhur (Active Card) -->
        <div class="bg-amber-glow/60 p-4 rounded-DEFAULT shadow-md flex flex-col justify-between border border-amber-primary/40 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-amber-hover uppercase">Dzuhur</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-primary text-pure-white font-bold">Siang</span>
            </div>
            <div class="my-2">
                <div class="text-2xl font-bold text-navy-deep">{{ $todaySchedule->dzuhur ?? '11:46' }}</div>
                <div class="text-[11px] text-primary font-bold">Ikhtiyat +2m</div>
            </div>
            <div class="bg-surface-container-lowest/80 p-2 rounded text-[11px] text-secondary flex justify-between">
                <span>Jeda Iqamah:</span>
                <strong class="text-navy-deep">{{ $prayerSetting->iqamah_dzuhur_delay ?? 7 }} mnt</strong>
            </div>
        </div>

        <!-- Ashar -->
        <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-secondary uppercase">Ashar</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-surface-container text-secondary">Sore</span>
            </div>
            <div class="my-2">
                <div class="text-2xl font-bold text-navy-deep">{{ $todaySchedule->ashar ?? '15:08' }}</div>
                <div class="text-[11px] text-primary font-semibold">Ikhtiyat +2m</div>
            </div>
            <div class="bg-surface-container-low p-2 rounded text-[11px] text-secondary flex justify-between">
                <span>Jeda Iqamah:</span>
                <strong class="text-navy-deep">{{ $prayerSetting->iqamah_ashar_delay ?? 7 }} mnt</strong>
            </div>
        </div>

        <!-- Maghrib -->
        <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-secondary uppercase">Maghrib</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-surface-container text-secondary">Senja</span>
            </div>
            <div class="my-2">
                <div class="text-2xl font-bold text-navy-deep">{{ $todaySchedule->maghrib ?? '17:48' }}</div>
                <div class="text-[11px] text-primary font-semibold">Ikhtiyat +2m</div>
            </div>
            <div class="bg-surface-container-low p-2 rounded text-[11px] text-secondary flex justify-between">
                <span>Jeda Iqamah:</span>
                <strong class="text-navy-deep">{{ $prayerSetting->iqamah_maghrib_delay ?? 5 }} mnt</strong>
            </div>
        </div>

        <!-- Isya -->
        <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-secondary uppercase">Isya</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-surface-container text-secondary">Malam</span>
            </div>
            <div class="my-2">
                <div class="text-2xl font-bold text-navy-deep">{{ $todaySchedule->isya ?? '19:00' }}</div>
                <div class="text-[11px] text-primary font-semibold">Ikhtiyat +2m</div>
            </div>
            <div class="bg-surface-container-low p-2 rounded text-[11px] text-secondary flex justify-between">
                <span>Jeda Iqamah:</span>
                <strong class="text-navy-deep">{{ $prayerSetting->iqamah_isya_delay ?? 10 }} mnt</strong>
            </div>
        </div>
    </div>

    <!-- Main Grid: Left 8-cols (Jum'at Roster) & Right 4-cols (Controls) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- LEFT PANEL: Roster Petugas Jum'at (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Section Title & Roster Cards -->
            <div class="bg-surface-container-lowest p-6 rounded-DEFAULT shadow-sm space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-surface-container-low pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-primary text-xl">calendar_month</span>
                        <h3 class="text-base font-bold text-navy-deep">Roster Petugas Shalat Jum'at Bulan Ini</h3>
                    </div>
                    <span class="text-xs text-secondary">Waktu Khutbah: 11.55 WITA</span>
                </div>

                <div class="space-y-4">
                    @forelse($fridayRoster as $roster)
                        @php
                            $rDate = \Carbon\Carbon::parse($roster->date);
                            $isPast = $rDate->isPast() && !$rDate->isToday();
                        @endphp
                        <div class="p-4 rounded-DEFAULT border {{ $roster->is_badal ? 'border-error/40 bg-error/5' : 'border-surface-container bg-surface-container-low/40' }} flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="space-y-1.5 md:max-w-xs">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-navy-deep">{{ $rDate->translatedFormat('d F Y') }}</span>
                                    @if($roster->is_badal)
                                        <span class="px-2 py-0.5 rounded-full bg-error text-pure-white text-[10px] font-bold">Badal Darurat</span>
                                    @elseif($isPast)
                                        <span class="px-2 py-0.5 rounded-full bg-surface-container text-secondary text-[10px]">Selesai</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full bg-success/20 text-success text-[10px] font-bold">Siap</span>
                                    @endif
                                </div>
                                <h4 class="text-sm font-bold text-navy-deep">{{ $roster->khutbah_theme ?? 'Kemaslahatan Ummat' }}</h4>
                                <p class="text-xs text-secondary">Status WA: <span class="capitalize font-semibold text-navy-deep">{{ $roster->status_wa ?? 'terkonfirmasi' }}</span></p>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                                <div>
                                    <span class="text-[11px] text-secondary block">Khatib:</span>
                                    <span class="font-bold text-navy-deep">{{ $roster->khatib_name ?? $roster->khatib }}</span>
                                </div>
                                <div>
                                    <span class="text-[11px] text-secondary block">Imam:</span>
                                    <span class="font-bold text-navy-deep">{{ $roster->imam_name ?? $roster->imam }}</span>
                                </div>
                                <div>
                                    <span class="text-[11px] text-secondary block">Muadzin/Bilal:</span>
                                    <span class="font-bold text-navy-deep">{{ $roster->bilal_name ?? $roster->muadzin }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 self-end md:self-center shrink-0">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $roster->khatib_phone ?? '081234567890') }}?text={{ urlencode('Assalamu\'alaikum, mengingatkan penugasan Khatib Shalat Jum\'at di Masjid Al-Fattah pada ' . $rDate->translatedFormat('d F Y') . '.') }}" target="_blank" class="p-2 rounded-full hover:bg-surface-container-highest text-success" title="Kirim WA Pengingat">
                                    <span class="material-symbols-outlined text-lg">chat</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-xs text-secondary">Belum ada roster petugas Jum'at yang dijadwalkan.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL: 4 cols (Badal Darurat & Running Text TV) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Card: Form Cepat Badal Darurat -->
            <div class="bg-surface-container-lowest p-5 rounded-DEFAULT shadow-sm space-y-3 border-t-4 border-error">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-error text-xl">swap_horiz</span>
                    <div>
                        <h4 class="text-sm font-bold text-navy-deep">Badal Khutbah Darurat</h4>
                        <p class="text-[11px] text-secondary">Jika khatib berhalangan mendadak</p>
                    </div>
                </div>
                <form action="{{ route('admin.konten.jadwal.assign-badal') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Pilih Roster Jum'at</label>
                        <select name="officer_id" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            @foreach($fridayRoster as $r)
                                <option value="{{ $r->id }}">Jum'at, {{ \Carbon\Carbon::parse($r->date)->translatedFormat('d M Y') }} ({{ $r->khatib_name ?? $r->khatib }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Khatib Pengganti (Standby)</label>
                        <input type="text" name="badal_khatib_name" required placeholder="Nama Ustadz Pengganti" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Alasan Penugasan</label>
                        <input type="text" name="reason" placeholder="Contoh: Berhalangan sakit / perjalanan" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-full bg-error hover:bg-error/90 text-pure-white text-xs font-bold flex items-center justify-center gap-1 shadow-sm transition-colors">
                        <span class="material-symbols-outlined text-base">notifications_active</span>
                        <span>Tugaskan Badal Darurat</span>
                    </button>
                </form>
            </div>

            <!-- Card: Kontrol Running Text & TV Display -->
            <div class="bg-surface-container-lowest p-5 rounded-DEFAULT shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-surface-container-low pb-2">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-primary text-xl">tv</span>
                        <h4 class="text-sm font-bold text-navy-deep">TV Display & Teks Berjalan</h4>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-success animate-pulse"></span>
                </div>

                <!-- TV Preview Simulator -->
                <div class="bg-navy-deep text-pure-white p-3 rounded space-y-2">
                    <div class="flex items-center justify-between text-[10px] text-secondary-fixed-dim uppercase">
                        <span>Layar TV Utama Masjid</span>
                        <span class="text-amber-primary font-bold">LIVE PREVIEW</span>
                    </div>
                    <div class="overflow-hidden bg-black/80 rounded p-2 text-xs font-mono text-amber-glow truncate">
                        {{ $prayerSetting->tv_running_text ?? 'Luruskan & rapatkan shaf shalat. Matikan HP.' }}
                    </div>
                </div>

                <form action="{{ route('admin.konten.jadwal.update-tv') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Pesan Berjalan (Running Text)</label>
                        <textarea name="tv_running_text" rows="3" class="w-full p-2.5 rounded bg-surface-container-low text-navy-deep text-xs focus:outline-none">{{ $prayerSetting->tv_running_text ?? '' }}</textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] text-navy-deep font-semibold mb-1">Kecepatan</label>
                            <select name="tv_marquee_speed" class="w-full p-2 rounded bg-surface-container-low text-navy-deep text-xs">
                                <option value="normal" {{ ($prayerSetting->tv_marquee_speed ?? '') === 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="lambat" {{ ($prayerSetting->tv_marquee_speed ?? '') === 'lambat' ? 'selected' : '' }}>Lambat</option>
                                <option value="cepat" {{ ($prayerSetting->tv_marquee_speed ?? '') === 'cepat' ? 'selected' : '' }}>Cepat</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] text-navy-deep font-semibold mb-1">Padam saat Shalat</label>
                            <label class="flex items-center gap-2 mt-2 cursor-pointer">
                                <input type="checkbox" name="auto_dim_salat" value="1" {{ ($prayerSetting->auto_dim_salat ?? true) ? 'checked' : '' }} class="accent-amber-primary"/>
                                <span class="text-xs text-secondary">Otomatis padam</span>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-full bg-navy-card hover:bg-navy-accent text-pure-white text-xs font-bold transition-colors">
                        Simpan & Terapkan ke TV
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Atur Petugas Jum'at -->
    <div id="modal-tambah-petugas" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-tambah-petugas').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-lg font-bold text-navy-deep mb-4">Atur Petugas Shalat Jum'at</h3>
            <form action="{{ route('admin.konten.jadwal.store-officer') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Tanggal Jum'at *</label>
                    <input type="date" name="date" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Nama Khatib *</label>
                    <input type="text" name="khatib_name" required placeholder="Contoh: Drs. KH. Mansyur Thalib, M.Ag" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Nama Imam *</label>
                        <input type="text" name="imam_name" required placeholder="Contoh: Ust. M. Ilham Rumengan" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Nama Muadzin / Bilal *</label>
                        <input type="text" name="bilal_name" required placeholder="Contoh: Irfan R. Pakaya" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Tema Khutbah</label>
                    <input type="text" name="khutbah_title" placeholder="Contoh: Memperkokoh Ukhuwah di Tanah Minahasa" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">No. WhatsApp Khatib</label>
                        <input type="text" name="khatib_phone" placeholder="081234567890" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Status Konfirmasi</label>
                        <select name="status_wa" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="terkonfirmasi">Terkonfirmasi</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="batal">Batal</option>
                        </select>
                    </div>
                </div>
                <div class="pt-3">
                    <button type="submit" class="w-full py-3 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold shadow-md transition-colors">
                        Simpan Roster Petugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
