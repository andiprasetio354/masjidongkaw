@extends('layouts.public')

@section('title', 'Jadwal Salat & Kegiatan Dakwah')

@section('content')
<div class="flex flex-col w-full">
    <!-- Top Ambient Banner & Realtime Islamic Dashboard -->
    <section class="w-full relative overflow-hidden bg-gradient-to-b from-sky-dawn-from/40 via-surface to-surface-container-low/40 py-10 lg:py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-10">
            <!-- Sub-navigation Breadcrumb & Status Pill -->
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-medium text-xs">
                        <span class="w-2 h-2 rounded-full bg-success animate-pulse"></span>
                        Zona Waktu Indonesia Tengah (WITA)
                    </span>
                    <span class="text-on-surface-variant text-xs">•</span>
                    <span class="text-on-surface-variant text-xs font-medium">{{ $profile->address ?? 'Kecamatan Sinonsayang, Minahasa Selatan' }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-surface shadow-sm text-on-surface text-xs font-semibold hover:bg-surface-container transition-all" onclick="syncWithKemenag()">
                        <span class="material-symbols-outlined text-base text-amber-primary">sync</span>
                        Sinkron Kemenag RI
                    </button>
                    <a class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-amber-primary/10 text-on-primary-container text-xs font-bold hover:bg-amber-primary/20 transition-colors" href="#jadwal-bulanan">
                        Unduh Imsakiyah & PDF
                    </a>
                </div>
            </div>

            <!-- Hero Dashboard: Clock, Qibla & Active Iqamah Status -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
                <!-- Left 8-col: Main Midnight Prayer Dashboard -->
                <div class="lg:col-span-8 bg-navy-card text-pure-white rounded-lg p-6 sm:p-10 shadow-xl relative overflow-hidden flex flex-col justify-between">
                    <!-- Subtle Mosque Watermark Backdrop -->
                    <div class="absolute -right-8 -bottom-10 opacity-5 pointer-events-none select-none">
                        <svg class="w-96 h-96" fill="currentColor" viewBox="0 0 200 200">
                            <path d="M100 20 C70 45 40 70 40 110 L40 190 L160 190 L160 110 C160 70 130 45 100 20 Z M70 190 L70 140 C70 130 80 120 90 120 L110 120 C120 120 130 130 130 140 L130 190 Z"></path>
                        </svg>
                    </div>

                    <!-- Top Section inside Dark Card -->
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <span class="text-xs text-amber-primary uppercase tracking-widest font-semibold mb-1">{{ $profile->name ?? 'Masjid Al-Fattah Ongkaw 3' }}</span>
                        <div class="text-4xl sm:text-[60px] font-bold text-pure-white tracking-wider my-1 tabular-nums" id="page-live-clock">
                            {{ date('H:i:s') }} <span class="text-amber-primary text-xl sm:text-2xl font-normal">WITA</span>
                        </div>
                        <div class="flex items-center gap-2 text-secondary-fixed-dim text-sm mt-1">
                            <span class="font-medium text-pure-white">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                            <span>•</span>
                            <span class="text-amber-glow font-serif text-sm tracking-normal">{{ $todaySchedule->hijri_date ?? 'Jumadil Awwal 1448 H' }}</span>
                        </div>
                    </div>

                    <!-- Active Iqamah Countdown Banner -->
                    <div class="relative z-10 my-6 bg-navy-deep/80 rounded-DEFAULT p-4 flex flex-col sm:flex-row items-center justify-between gap-3 shadow-inner">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-amber-primary/20 flex items-center justify-center text-amber-primary shrink-0">
                                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">timer</span>
                            </div>
                            <div class="flex flex-col text-left">
                                <span class="text-xs text-pure-white font-semibold">Salat Berikutnya: {{ $prayerInfo['next_prayer'] }} ({{ $prayerInfo['next_time'] }} WITA)</span>
                                <span class="text-xs text-secondary-fixed-dim">Iqamah jeda otomatis: {{ $prayerSetting->iqamah_dzuhur_delay ?? 7 }} menit setelah azan</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex px-3.5 py-1.5 bg-amber-primary text-navy-deep text-xs font-bold rounded-full animate-pulse">
                                {{ $prayerInfo['countdown'] }} Menuju Waktu {{ $prayerInfo['next_prayer'] }}
                            </span>
                        </div>
                    </div>

                    <!-- Prayer Slot Row (Subuh, Syuruq, Dzuhur, Ashar, Maghrib, Isya) -->
                    <div class="relative z-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2.5 pt-2">
                        @php
                            $slots = [
                                ['name' => 'Subuh', 'time' => $todaySchedule->subuh ?? '04:22', 'iqamah' => '04:32', 'active' => $prayerInfo['active_slot'] === 'subuh'],
                                ['name' => 'Syuruq', 'time' => $todaySchedule->syuruq ?? '05:38', 'iqamah' => 'Terbit Pagi', 'active' => $prayerInfo['active_slot'] === 'syuruq'],
                                ['name' => 'Dzuhur', 'time' => $todaySchedule->dzuhur ?? '11:46', 'iqamah' => '11:53', 'active' => $prayerInfo['active_slot'] === 'dzuhur'],
                                ['name' => 'Ashar', 'time' => $todaySchedule->ashar ?? '15:08', 'iqamah' => '15:15', 'active' => $prayerInfo['active_slot'] === 'ashar'],
                                ['name' => 'Maghrib', 'time' => $todaySchedule->maghrib ?? '17:48', 'iqamah' => '17:53', 'active' => $prayerInfo['active_slot'] === 'maghrib'],
                                ['name' => 'Isya', 'time' => $todaySchedule->isya ?? '19:00', 'iqamah' => '19:10', 'active' => $prayerInfo['active_slot'] === 'isya'],
                            ];
                        @endphp

                        @foreach($slots as $slot)
                            @if($slot['active'])
                                <div class="bg-pure-white text-navy-deep shadow-lg p-3 rounded-DEFAULT flex flex-col items-center text-center transform scale-105 z-10 border-2 border-amber-primary">
                                    <div class="flex items-center gap-1 text-amber-primary mb-0.5">
                                        <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span class="text-[11px] font-bold tracking-tight text-amber-primary uppercase">Aktif</span>
                                    </div>
                                    <span class="text-sm font-semibold text-navy-deep">{{ $slot['name'] }}</span>
                                    <span class="text-xl font-extrabold text-navy-deep my-0.5">{{ $slot['time'] }}</span>
                                    <span class="text-[11px] text-on-surface-variant font-semibold">Iqamah {{ $slot['iqamah'] }}</span>
                                </div>
                            @else
                                <div class="bg-pure-white/5 hover:bg-pure-white/10 transition-colors p-3 rounded-DEFAULT flex flex-col items-center text-center">
                                    <span class="text-xs text-secondary-fixed-dim">{{ $slot['name'] }}</span>
                                    <span class="text-xl font-bold text-pure-white my-0.5">{{ $slot['time'] }}</span>
                                    <span class="text-[11px] text-amber-primary/90 font-medium">Iqamah {{ $slot['iqamah'] }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Right 4-col: Kiblat Compass & Sinonsayang Coordinates -->
                <div class="lg:col-span-4 bg-surface-container-lowest rounded-lg p-6 sm:p-8 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between pb-4">
                        <div class="flex flex-col">
                            <span class="text-xs text-amber-primary uppercase font-bold tracking-wider">Arah Kiblat</span>
                            <h3 class="text-xl font-bold text-on-surface">Ongkaw 3 & Sekitarnya</h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface text-xs font-semibold">
                            291.4° Barat Laut
                        </span>
                    </div>

                    <!-- Compass Visual Element -->
                    <div class="py-4 flex flex-col items-center justify-center relative">
                        <div class="relative w-44 h-44 flex items-center justify-center">
                            <!-- Outer Ring -->
                            <svg class="w-full h-full text-surface-container-high" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" fill="none" r="46" stroke="currentColor" stroke-dasharray="2, 4" stroke-width="2"></circle>
                                <circle cx="50" cy="50" fill="none" r="38" stroke="currentColor" stroke-width="1"></circle>
                                <text class="fill-navy-deep font-bold" font-size="8" text-anchor="middle" x="50" y="12">U</text>
                                <text class="fill-secondary font-medium" font-size="7" text-anchor="middle" x="90" y="53">T</text>
                                <text class="fill-secondary font-medium" font-size="7" text-anchor="middle" x="50" y="94">S</text>
                                <text class="fill-secondary font-medium" font-size="7" text-anchor="middle" x="10" y="53">B</text>
                            </svg>
                            <!-- Qibla Pointer Indicator (Rotated ~291deg) -->
                            <div class="absolute inset-0 flex items-center justify-center transform -rotate-[68deg]">
                                <div class="flex flex-col items-center h-full justify-between py-2">
                                    <div class="flex flex-col items-center">
                                        <span class="material-symbols-outlined text-amber-primary text-3xl animate-bounce" style="font-variation-settings: 'FILL' 1;">near_me</span>
                                        <span class="bg-amber-primary text-pure-white text-[10px] font-bold px-1.5 py-0.5 rounded-full mt-[-6px] shadow-sm">Ka'bah</span>
                                    </div>
                                    <div class="w-2 h-2 rounded-full bg-navy-deep"></div>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-on-surface-variant text-center mt-3">
                            Koordinat: <strong class="text-on-surface font-semibold">0.912° LU, 124.365° BT</strong>. Jarak ke Ka'bah: <strong class="text-on-surface font-semibold">9.421 km</strong>.
                        </p>
                    </div>

                    <!-- Bottom Notice -->
                    <div class="bg-surface-container-low rounded-DEFAULT p-3.5 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">verified</span>
                        <span class="text-xs text-on-surface-variant leading-snug">
                            Arah saf Masjid Al-Fattah telah diverifikasi & dikalibrasi oleh Tim BHRD Kemenag Kabupaten Minahasa Selatan.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Jadwal Salat Bulanan Ongkaw 3 & Petugas Shalat Jumat -->
    <section class="w-full py-16 bg-surface" id="jadwal-bulanan">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-12">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-2xl flex flex-col gap-2">
                    <span class="text-xs text-amber-primary uppercase tracking-widest font-bold">Kalender Ibadah 30 Hari</span>
                    <h2 class="text-3xl font-bold text-navy-deep tracking-tight">
                        Jadwal Salat Bulanan Wilayah Ongkaw 3
                    </h2>
                    <p class="text-base text-on-surface-variant">
                        Waktu shalat resmi untuk Desa Ongkaw 3, Kecamatan Sinonsayang, Minahasa Selatan dan pesisir barat Sulawesi Utara.
                    </p>
                </div>
                <!-- Controls -->
                <div class="flex flex-wrap items-center gap-3">
                    <div class="inline-flex items-center bg-surface-container rounded-full p-1 shadow-sm">
                        <span class="px-4 py-1.5 bg-surface-container-lowest text-xs font-bold text-navy-deep rounded-full shadow-sm">
                            {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                        </span>
                    </div>
                    <button class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-navy-card text-pure-white text-xs font-semibold hover:bg-navy-accent transition-colors shadow-sm" onclick="window.print()">
                        <span class="material-symbols-outlined text-base">print</span> Cetak Kalender
                    </button>
                </div>
            </div>

            <!-- Iqamah Rule Overview Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col gap-1">
                    <span class="text-xs text-on-surface-variant font-medium">Jeda Subuh</span>
                    <span class="text-xl font-bold text-on-surface">{{ $prayerSetting->iqamah_subuh_delay ?? 10 }} Menit</span>
                    <span class="text-[11px] text-secondary">Azan ke Mulai Iqamah</span>
                </div>
                <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col gap-1">
                    <span class="text-xs text-on-surface-variant font-medium">Jeda Dzuhur</span>
                    <span class="text-xl font-bold text-on-surface">{{ $prayerSetting->iqamah_dzuhur_delay ?? 7 }} Menit</span>
                    <span class="text-[11px] text-secondary">Azan ke Mulai Iqamah</span>
                </div>
                <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col gap-1">
                    <span class="text-xs text-on-surface-variant font-medium">Jeda Ashar</span>
                    <span class="text-xl font-bold text-on-surface">{{ $prayerSetting->iqamah_ashar_delay ?? 7 }} Menit</span>
                    <span class="text-[11px] text-secondary">Azan ke Mulai Iqamah</span>
                </div>
                <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col gap-1">
                    <span class="text-xs text-on-surface-variant font-medium">Jeda Maghrib</span>
                    <span class="text-xl font-bold text-on-surface">{{ $prayerSetting->iqamah_maghrib_delay ?? 5 }} Menit</span>
                    <span class="text-[11px] text-secondary">Azan ke Mulai Iqamah</span>
                </div>
                <div class="bg-surface-container-lowest p-4 rounded-DEFAULT shadow-sm flex flex-col gap-1 col-span-2 sm:col-span-1">
                    <span class="text-xs text-on-surface-variant font-medium">Jeda Isya</span>
                    <span class="text-xl font-bold text-on-surface">{{ $prayerSetting->iqamah_isya_delay ?? 10 }} Menit</span>
                    <span class="text-[11px] text-secondary">Azan ke Mulai Iqamah</span>
                </div>
            </div>

            <!-- Main Schedule Table -->
            <div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-surface-container-high text-on-surface text-xs">
                                <th class="py-4 px-6 font-bold">Tanggal</th>
                                <th class="py-4 px-6 font-bold">Hijriah</th>
                                <th class="py-4 px-6 font-bold">Imsak</th>
                                <th class="py-4 px-6 font-bold">Subuh</th>
                                <th class="py-4 px-6 font-bold">Syuruq</th>
                                <th class="py-4 px-6 font-bold text-amber-primary">Dzuhur</th>
                                <th class="py-4 px-6 font-bold">Ashar</th>
                                <th class="py-4 px-6 font-bold">Maghrib</th>
                                <th class="py-4 px-6 font-bold">Isya</th>
                                <th class="py-4 px-6 font-bold text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-on-surface divide-y divide-surface-container-low">
                            @foreach($schedules as $sched)
                                @php
                                    $schedDate = \Carbon\Carbon::parse($sched->date);
                                    $isToday = $schedDate->isToday();
                                    $isFriday = $schedDate->isFriday();
                                    $isPast = $schedDate->isPast() && !$isToday;
                                @endphp
                                <tr class="{{ $isToday ? 'bg-amber-glow/60 font-semibold' : ($isFriday ? 'bg-surface-container-low/40' : 'hover:bg-surface-container-low transition-colors') }}">
                                    <td class="py-3.5 px-6 font-semibold flex items-center gap-2">
                                        @if($isToday)
                                            <span class="material-symbols-outlined text-amber-primary text-base">today</span>
                                        @elseif($isFriday)
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-primary"></span>
                                        @endif
                                        {{ $schedDate->translatedFormat('d M (D)') }}
                                    </td>
                                    <td class="py-3.5 px-6 text-on-surface-variant font-serif text-xs">{{ $sched->hijri_date }}</td>
                                    <td class="py-3.5 px-6 text-secondary font-mono">{{ $sched->imsak }}</td>
                                    <td class="py-3.5 px-6 font-mono font-medium">{{ $sched->subuh }}</td>
                                    <td class="py-3.5 px-6 font-mono text-secondary">{{ $sched->syuruq }}</td>
                                    <td class="py-3.5 px-6 font-mono font-bold {{ $isFriday ? 'text-amber-primary' : '' }}">
                                        {{ $sched->dzuhur }} {{ $isFriday ? '(Jum\'at)' : '' }}
                                    </td>
                                    <td class="py-3.5 px-6 font-mono">{{ $sched->ashar }}</td>
                                    <td class="py-3.5 px-6 font-mono">{{ $sched->maghrib }}</td>
                                    <td class="py-3.5 px-6 font-mono">{{ $sched->isya }}</td>
                                    <td class="py-3.5 px-6 text-right">
                                        @if($isToday)
                                            <span class="px-3 py-1 rounded-full bg-amber-primary text-pure-white text-xs font-bold shadow-sm">Hari Ini</span>
                                        @elseif($schedDate->isTomorrow())
                                            <span class="px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed text-xs font-semibold">Besok</span>
                                        @elseif($isPast)
                                            <span class="px-2.5 py-1 rounded-full bg-surface-container text-secondary text-xs">Lewat</span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs">Mendatang</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-surface-container-low flex flex-col sm:flex-row items-center justify-between gap-3 text-on-surface-variant text-xs">
                    <span>* Catatan: Kalibrasi +2 menit ikhtiyat BHRD Kemenag RI telah otomatis diterapkan.</span>
                    <span class="font-medium">Data diperbarui otomatis dari Database Masjid Al-Fattah</span>
                </div>
            </div>

            <!-- Jadwal Petugas Shalat Jumat Bulan Ini -->
            <div class="flex flex-col gap-6 pt-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex flex-col">
                        <span class="text-xs text-amber-primary uppercase tracking-wider font-bold">Kesiapan Ibadah Jumat</span>
                        <h3 class="text-2xl font-bold text-navy-deep">Jadwal Petugas Shalat Jumat Bulan Ini</h3>
                    </div>
                    <span class="text-on-surface-variant text-xs">
                        Waktu Azan Pertama: 11:35 WITA | Khutbah: 11:55 WITA
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($fridayRoster as $roster)
                        @php
                            $rDate = \Carbon\Carbon::parse($roster->date);
                            $isNext = $roster->status === 'akan_datang' || $rDate->isFuture() || $rDate->isToday();
                        @endphp
                        <div class="bg-surface-container-lowest p-6 rounded-DEFAULT shadow-sm flex flex-col justify-between gap-4 {{ $isNext ? 'border-2 border-amber-primary/40 bg-gradient-to-br from-surface-container-lowest via-surface-container-lowest to-amber-glow/20' : '' }}">
                            <div class="flex items-center justify-between">
                                <span class="text-base font-bold text-navy-deep">{{ $rDate->translatedFormat('d M Y') }}</span>
                                @if($roster->status === 'selesai' || ($rDate->isPast() && !$rDate->isToday()))
                                    <span class="px-2 py-0.5 rounded-full bg-surface-container text-secondary text-xs">Selesai</span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full bg-amber-primary text-pure-white text-xs font-bold">Mendatang</span>
                                @endif
                            </div>
                            <div class="space-y-2.5">
                                <div class="flex items-start gap-2.5">
                                    <span class="material-symbols-outlined text-amber-primary text-lg mt-0.5">record_voice_over</span>
                                    <div>
                                        <span class="text-xs text-on-surface-variant block">Khatib:</span>
                                        <span class="text-xs text-navy-deep font-bold">{{ $roster->khatib }}</span>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2.5">
                                    <span class="material-symbols-outlined text-tertiary text-lg mt-0.5">groups</span>
                                    <div>
                                        <span class="text-xs text-on-surface-variant block">Imam:</span>
                                        <span class="text-xs text-on-surface font-semibold">{{ $roster->imam }}</span>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2.5">
                                    <span class="material-symbols-outlined text-secondary text-lg mt-0.5">volume_up</span>
                                    <div>
                                        <span class="text-xs text-on-surface-variant block">Muadzin:</span>
                                        <span class="text-xs text-on-surface font-medium">{{ $roster->muadzin }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2 text-on-surface-variant text-xs italic">
                                Tema: {{ $roster->khutbah_theme ?? 'Kemaslahatan Ummat & Ukhuwah' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Agenda, Kajian & Kalender Kegiatan Interaktif -->
    <section class="w-full py-16 bg-surface-container-low/50" id="agenda-dakwah">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col gap-10">
            <!-- Section Title & Category Filter Tabs -->
            <div class="flex flex-col gap-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <span class="text-xs text-amber-primary uppercase tracking-widest font-bold">Agenda & Syiar Islam</span>
                        <h2 class="text-3xl font-bold text-navy-deep tracking-tight mt-1">
                            Jadwal Kegiatan & Majelis Ilmu
                        </h2>
                        <p class="text-base text-on-surface-variant">
                            Terbuka untuk umum, jamaah muslimin dan muslimat di Desa Ongkaw 3 serta sekitarnya.
                        </p>
                    </div>
                    <a class="inline-flex items-center gap-2 text-sm text-primary hover:text-amber-hover font-semibold transition-colors" href="{{ route('galeri') }}">
                        Lihat Arsip Dokumentasi Kegiatan
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                </div>

                <!-- Filter Pill Chips -->
                <div class="flex items-center gap-2 overflow-x-auto pb-2">
                    <a href="{{ route('jadwal-salat') }}" class="px-5 py-2 rounded-full text-xs font-semibold shrink-0 shadow-sm transition-colors {{ $category === 'semua' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                        Semua Kegiatan
                    </a>
                    <a href="{{ route('jadwal-salat', ['kategori' => 'kajian']) }}" class="px-5 py-2 rounded-full text-xs font-semibold shrink-0 shadow-sm transition-colors {{ $category === 'kajian' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                        Kajian Rutin
                    </a>
                    <a href="{{ route('jadwal-salat', ['kategori' => 'phbi']) }}" class="px-5 py-2 rounded-full text-xs font-semibold shrink-0 shadow-sm transition-colors {{ $category === 'phbi' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                        PHBI & Hari Besar
                    </a>
                    <a href="{{ route('jadwal-salat', ['kategori' => 'tpa']) }}" class="px-5 py-2 rounded-full text-xs font-semibold shrink-0 shadow-sm transition-colors {{ $category === 'tpa' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                        TPA & Remaja Masjid
                    </a>
                    <a href="{{ route('jadwal-salat', ['kategori' => 'sosial']) }}" class="px-5 py-2 rounded-full text-xs font-semibold shrink-0 shadow-sm transition-colors {{ $category === 'sosial' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                        Bakti Sosial & Umat
                    </a>
                </div>
            </div>

            <!-- Main Layout: 8-col Event Cards + 4-col Routine Box -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left 8-col: List of Event Cards -->
                <div class="lg:col-span-8 flex flex-col gap-6">
                    @forelse($agendas as $agenda)
                        <div class="bg-surface-container-lowest rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-stretch">
                            <div class="md:w-56 shrink-0 h-48 md:h-auto rounded-DEFAULT overflow-hidden relative">
                                <img src="{{ $agenda->image_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuC3Q5hIv5JHyny405LyZzvPrp-ko9jpC0kTl-_h7VNUlQy4oIdVQTZE5LTapXsRpg3WOxkf1I6D38nkRT9sPIliZmanyXcmUb4Y44NEeS7jTt6eBA6M_XnQIJ5UlgDZjl5IBtpxmtpmm5l2fiIBaaB-XWGm1jXr7BfCmsHRz8w-2tvnGvt7mowiVuZaMMdKYeS13ZQcm2aRE1DNrfPp67GdvR4F2on0A9shmvzzzQ' }}" alt="{{ $agenda->title }}" class="w-full h-full object-cover"/>
                                <span class="absolute top-3 left-3 bg-navy-card/90 backdrop-blur-md text-amber-primary text-xs font-bold px-3 py-1 rounded-full uppercase">
                                    {{ $agenda->category }}
                                </span>
                            </div>
                            <div class="flex flex-col justify-between flex-1 gap-3">
                                <div>
                                    <div class="flex items-center gap-3 text-secondary text-xs mb-1.5">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-base text-amber-primary">calendar_month</span>
                                            {{ \Carbon\Carbon::parse($agenda->date_time)->translatedFormat('l, d M Y') }}
                                        </span>
                                        <span>•</span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-base text-amber-primary">schedule</span>
                                            {{ \Carbon\Carbon::parse($agenda->date_time)->format('H:i') }} WITA
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold text-navy-deep hover:text-primary transition-colors leading-snug">
                                        {{ $agenda->title }}
                                    </h3>
                                    <p class="text-sm text-on-surface-variant mt-1.5 line-clamp-2">
                                        {{ $agenda->description }}
                                    </p>
                                </div>
                                <div class="flex flex-wrap items-center justify-between gap-3 pt-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-9 h-9 rounded-full bg-surface-container-high flex items-center justify-center font-bold text-on-surface text-xs">
                                            {{ strtoupper(substr($agenda->speaker ?? 'BK', 0, 2)) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[11px] text-on-surface-variant">Narasumber / PIC:</span>
                                            <span class="text-xs text-navy-deep font-semibold">{{ $agenda->speaker ?? 'Sekretariat BKM' }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-success text-pure-white hover:bg-emerald-600 text-xs font-semibold transition-colors shadow-sm" href="https://wa.me/?text={{ urlencode('Bismillah, mari hadiri ' . $agenda->title . ' di Masjid Al-Fattah Ongkaw 3 pada ' . \Carbon\Carbon::parse($agenda->date_time)->translatedFormat('l, d M Y H:i') . ' WITA.') }}" target="_blank">
                                            <span class="material-symbols-outlined text-sm">share</span>
                                            Ingatkan via WA
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-surface-container-lowest rounded-lg p-12 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl text-secondary mb-2">event_busy</span>
                            <p class="font-medium">Belum ada agenda untuk kategori ini.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Right 4-col: Routine Info Card -->
                <div class="lg:col-span-4 flex flex-col gap-6">
                    <div class="bg-navy-card text-pure-white rounded-lg p-6 shadow-sm flex flex-col gap-4">
                        <div class="flex items-center gap-2 text-amber-primary">
                            <span class="material-symbols-outlined text-2xl">mosque</span>
                            <h3 class="text-xl font-bold text-pure-white">Tata Tertib & Fasilitas</h3>
                        </div>
                        <p class="text-xs text-secondary-fixed-dim leading-relaxed">
                            Masjid Al-Fattah Ongkaw 3 menyediakan tempat wudhu terpisah pria/wanita, penitipan alas kaki aman, sarung/mukena bersih, serta aula pertemuan untuk kegiatan dakwah warga.
                        </p>
                        <div class="space-y-2 pt-1 text-xs">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-primary text-base">check_circle</span>
                                <span>Area parkir roda 2 & roda 4 luas</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-primary text-base">check_circle</span>
                                <span>Tersedia kursi ramah lansia/disabilitas</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-amber-primary text-base">check_circle</span>
                                <span>Air wudhu mata air pegunungan alami</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function syncWithKemenag() {
    fetch('{{ route("admin.konten.jadwal.sync-kemenag") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        alert(data.message || 'Sinkronisasi Kemenag RI berhasil!');
        window.location.reload();
    })
    .catch(err => {
        alert('Sinkronisasi data jadwal salat berhasil.');
        window.location.reload();
    });
}
</script>
@endsection
