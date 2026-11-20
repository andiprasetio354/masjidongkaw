@extends('layouts.public')

@section('title', 'Beranda - Masjid Al-Fattah Ongkaw 3')

@section('content')
<div class="flex flex-col w-full">
    <!-- 1. HERO SECTION (Atmospheric Morning Sky to Warm Peach with Silhouettes) -->
    <section class="relative w-full overflow-hidden bg-gradient-to-b from-sky-dawn-from via-sky-dawn-to/70 to-surface pt-12 pb-24 lg:pt-20 lg:pb-36">
        <!-- Subtle Architectural Background Watermark -->
        <div class="absolute inset-0 pointer-events-none opacity-20 flex justify-end items-baseline">
            <svg class="w-full h-full max-h-[700px] text-primary/10" fill="none" preserveAspectRatio="none" viewBox="0 0 1440 600">
                <path d="M0,600 L0,380 Q200,340 380,420 T760,390 Q920,280 1100,320 T1440,260 L1440,600 Z" fill="currentColor"></path>
                <path d="M850,290 C850,210 930,170 980,100 C1030,170 1110,210 1110,290 Z" fill="currentColor" opacity="0.4"></path>
                <path d="M1240,360 L1260,110 L1275,80 L1290,110 L1310,360 Z" fill="currentColor" opacity="0.3"></path>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 flex flex-col space-y-6">
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-amber-primary/15 w-fit">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-primary animate-pulse"></span>
                    <span class="font-label-md text-label-md text-amber-hover font-bold tracking-wide uppercase">Pusat Dakwah & Ibadah Minahasa Selatan</span>
                </div>

                <h1 class="font-display-hero text-headline-lg lg:text-display-hero text-navy-deep font-extrabold leading-tight tracking-tight">
                    Menjalin Ukhuwah, Merawat Berkah: <br class="hidden sm:inline"/>
                    <span class="text-amber-primary">Selamat Datang di Masjid Al-Fattah</span> Ongkaw 3
                </h1>

                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
                    Pusat ibadah, dakwah Islamiyah, dan pemberdayaan masyarakat di Desa Ongkaw 3, Kec. Sinonsayang, Minahasa Selatan. Terbuka, ramah, dan transparan dalam melayani umat di bumi Sulawesi Utara.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-3">
                    <a class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white font-label-lg text-label-lg shadow-[0_8px_20px_-4px_rgba(245,158,11,0.4)] transition-all transform hover:-translate-y-0.5 active:scale-95 gap-2" href="{{ route('pengurus') }}">
                        <span>Pelajari Profil Masjid</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </a>
                    <a class="inline-flex items-center justify-center px-7 py-4 rounded-full bg-surface-container-lowest text-navy-deep hover:bg-surface-container font-label-lg text-label-lg shadow-sm transition-all transform hover:-translate-y-0.5" href="{{ route('jadwal-salat') }}">
                        <span class="material-symbols-outlined text-amber-primary mr-2 text-xl">schedule</span>
                        Jadwal Ibadah Hari Ini
                    </a>
                </div>

                <!-- Quick Live Metrics -->
                <div class="pt-6 grid grid-cols-3 gap-4 max-w-lg">
                    <div class="bg-surface-container-lowest/80 backdrop-blur p-3.5 rounded-DEFAULT shadow-sm">
                        <div class="font-headline-sm text-headline-sm font-bold text-navy-deep">{{ $profile->capacity_jamaah ?? 400 }}+</div>
                        <div class="font-body-sm text-body-sm text-on-surface-variant">Kapasitas Jamaah</div>
                    </div>
                    <div class="bg-surface-container-lowest/80 backdrop-blur p-3.5 rounded-DEFAULT shadow-sm">
                        <div class="font-headline-sm text-headline-sm font-bold text-navy-deep">{{ $profile->santri_count ?? 65 }} Santri</div>
                        <div class="font-body-sm text-body-sm text-on-surface-variant">Binaan TPA Al-Fattah</div>
                    </div>
                    <div class="bg-surface-container-lowest/80 backdrop-blur p-3.5 rounded-DEFAULT shadow-sm">
                        <div class="font-headline-sm text-headline-sm font-bold text-navy-deep">100%</div>
                        <div class="font-body-sm text-body-sm text-on-surface-variant">Kas Infaq Terbuka</div>
                    </div>
                </div>
            </div>

            <!-- Hero Visual Composition with layered serene aesthetics -->
            <div class="lg:col-span-5 relative flex justify-center items-center">
                <div class="relative w-full max-w-md aspect-[4/5] rounded-lg overflow-hidden shadow-2xl bg-gradient-to-tr from-navy-deep to-navy-accent p-2">
                    <img class="w-full h-full object-cover rounded-DEFAULT" alt="Masjid Al-Fattah Ongkaw 3" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBFx70OuSWM3yB-9_TeNu0to6sgXxR7_VzIG14kzV-OdoTWGO2zomOunEKfQK0zd2FsCZLIQqiZEzj5BvSjflug326gh5XNEGArBIpnQctoFcBtfPddHiHJhs7jgKQz6tInvQ1OmLe6oN_W_fvf4aeZ1h4SnVtfPGO93s83l43L7ae1bxbd6-4uqVNm3yyG1KsVCq25c0WUOsynOUZe9Qg1asF083S6rHtA-QpkqA"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-deep/80 via-transparent to-transparent rounded-DEFAULT"></div>
                    <div class="absolute bottom-6 left-6 right-6 p-4 rounded-DEFAULT bg-navy-card/90 backdrop-blur-md text-pure-white shadow-lg">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="font-label-md text-label-md text-amber-primary font-bold uppercase tracking-wider">Mutiara Ayat</span>
                            <span class="material-symbols-outlined text-amber-primary text-sm">auto_awesome</span>
                        </div>
                        <p class="font-body-sm text-body-sm italic text-secondary-fixed">
                            "Hanya yang memakmurkan masjid-masjid Allah ialah orang-orang yang beriman kepada Allah dan hari kemudian..."
                        </p>
                        <span class="font-label-md text-label-md text-secondary-fixed-dim block text-right mt-1 font-semibold">QS. At-Taubah: 18</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. PRAYER TIMES DASHBOARD (Midnight Navy Elevation Level 3 Card) -->
    <section class="relative max-w-7xl mx-auto px-6 lg:px-12 -mt-14 z-20 w-full" id="jadwal-salat-section">
        <div class="w-full bg-navy-card text-pure-white rounded-lg p-6 lg:p-10 shadow-2xl relative overflow-hidden">
            <!-- Watermark Dome Vector -->
            <div class="absolute right-0 bottom-0 pointer-events-none opacity-5 translate-x-12 translate-y-12">
                <svg class="w-96 h-96 text-pure-white" fill="currentColor" viewBox="0 0 200 200">
                    <path d="M100 0 C60 50 20 80 20 140 C20 180 55 200 100 200 C145 200 180 180 180 140 C180 80 140 50 100 0 Z"></path>
                </svg>
            </div>

            <!-- Top Bar: Location & Digital Clock -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-8 border-b-0">
                <div class="text-center md:text-left space-y-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pure-white/10 text-amber-primary font-label-md text-label-md">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span>Wilayah Ongkaw 3, Sinonsayang & Sekitarnya (WITA)</span>
                    </div>
                    <h2 class="font-headline-md text-headline-md font-bold tracking-tight text-pure-white">Waktu Salat & Ibadah Hari Ini</h2>
                    <p class="font-body-md text-body-md text-secondary-fixed-dim">
                        {{ $todaySchedule->day_name ?? 'Kamis' }}, {{ $todaySchedule->hijri_date ?? "19 Sya'ban 1447 H" }} • {{ now()->format('d F Y') }}
                    </p>
                </div>

                <!-- Master Clock Card -->
                <div class="flex flex-col items-center bg-navy-deep/80 px-8 py-4 rounded-DEFAULT shadow-inner text-center">
                    <div class="font-label-md text-label-md text-secondary-fixed-dim uppercase tracking-widest mb-1">Waktu Indonesia Tengah</div>
                    <div class="font-digital-clock text-digital-clock font-extrabold text-amber-primary tracking-wider tabular-nums leading-none live-clock-display" id="live-clock">
                        12:15:20
                    </div>
                    <div class="mt-2 inline-flex items-center gap-1.5 text-xs text-secondary-fixed">
                        <span class="inline-block w-2 h-2 rounded-full bg-success"></span>
                        <span>Menuju {{ $prayerInfo['next_prayer'] }}: <strong>{{ $prayerInfo['countdown'] }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- Prayer Times Grid (Subuh, Syuruq, Dzuhur, Ashar, Maghrib, Isya) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3.5 pt-8">
                <!-- Subuh -->
                <div class="{{ $prayerInfo['active_slot'] === 'subuh' ? 'bg-surface-container-lowest text-navy-deep transform -translate-y-1 shadow-xl' : 'bg-pure-white/5 hover:bg-pure-white/10' }} transition-colors p-4 rounded-DEFAULT text-center flex flex-col items-center justify-between space-y-2">
                    <span class="font-label-md text-label-md uppercase tracking-wider font-semibold {{ $prayerInfo['active_slot'] === 'subuh' ? 'text-amber-hover font-bold' : 'text-secondary-fixed-dim' }}">Subuh</span>
                    <span class="material-symbols-outlined text-2xl {{ $prayerInfo['active_slot'] === 'subuh' ? 'text-amber-primary' : 'text-secondary-fixed' }}">nights_stay</span>
                    <span class="font-headline-sm text-headline-sm font-bold {{ $prayerInfo['active_slot'] === 'subuh' ? 'text-navy-deep' : 'text-pure-white' }}">{{ $todaySchedule->subuh ?? '04:18' }}</span>
                    <span class="font-body-sm text-body-sm text-secondary-fixed-dim">Iqamah {{ $todaySchedule->subuh ? date('H:i', strtotime($todaySchedule->subuh . ' + ' . ($prayerSetting->iqamah_subuh ?? 10) . ' minutes')) : '04:30' }}</span>
                </div>

                <!-- Syuruq -->
                <div class="{{ $prayerInfo['active_slot'] === 'syuruq' ? 'bg-surface-container-lowest text-navy-deep transform -translate-y-1 shadow-xl' : 'bg-pure-white/5 hover:bg-pure-white/10' }} transition-colors p-4 rounded-DEFAULT text-center flex flex-col items-center justify-between space-y-2 opacity-90">
                    <span class="font-label-md text-label-md uppercase tracking-wider font-semibold {{ $prayerInfo['active_slot'] === 'syuruq' ? 'text-amber-hover font-bold' : 'text-secondary-fixed-dim' }}">Syuruq</span>
                    <span class="material-symbols-outlined text-2xl {{ $prayerInfo['active_slot'] === 'syuruq' ? 'text-amber-primary' : 'text-secondary-fixed' }}">wb_twilight</span>
                    <span class="font-headline-sm text-headline-sm font-bold {{ $prayerInfo['active_slot'] === 'syuruq' ? 'text-navy-deep' : 'text-pure-white' }}">{{ $todaySchedule->syuruq ?? '05:34' }}</span>
                    <span class="font-body-sm text-body-sm text-secondary-fixed-dim">Terbit Fajar</span>
                </div>

                <!-- Dzuhur (ACTIVE HIGHLIGHT) -->
                <div class="{{ $prayerInfo['active_slot'] === 'dzuhur' ? 'bg-surface-container-lowest text-navy-deep transform -translate-y-1 shadow-xl relative' : 'bg-pure-white/5 hover:bg-pure-white/10' }} p-4 rounded-DEFAULT text-center flex flex-col items-center justify-between space-y-2">
                    @if($prayerInfo['active_slot'] === 'dzuhur')
                        <span class="absolute -top-3 px-3 py-0.5 rounded-full bg-amber-primary text-pure-white font-label-md text-xs font-bold uppercase shadow-sm">
                            Salat Sekarang
                        </span>
                    @endif
                    <span class="font-label-md text-label-md uppercase tracking-wider font-bold pt-1 {{ $prayerInfo['active_slot'] === 'dzuhur' ? 'text-amber-hover' : 'text-secondary-fixed-dim' }}">Dzuhur</span>
                    <span class="material-symbols-outlined text-2xl {{ $prayerInfo['active_slot'] === 'dzuhur' ? 'text-amber-primary' : 'text-secondary-fixed' }}" style="font-variation-settings: 'FILL' 1;">wb_sunny</span>
                    <span class="font-headline-md text-headline-md font-extrabold {{ $prayerInfo['active_slot'] === 'dzuhur' ? 'text-navy-deep' : 'text-pure-white' }}">{{ $todaySchedule->dzuhur ?? '11:46' }}</span>
                    <span class="font-body-sm text-body-sm {{ $prayerInfo['active_slot'] === 'dzuhur' ? 'text-navy-accent font-semibold' : 'text-secondary-fixed-dim' }}">Iqamah {{ $todaySchedule->dzuhur ? date('H:i', strtotime($todaySchedule->dzuhur . ' + ' . ($prayerSetting->iqamah_dzuhur ?? 7) . ' minutes')) : '11:53' }}</span>
                </div>

                <!-- Ashar -->
                <div class="{{ $prayerInfo['active_slot'] === 'ashar' ? 'bg-surface-container-lowest text-navy-deep transform -translate-y-1 shadow-xl' : 'bg-pure-white/5 hover:bg-pure-white/10' }} transition-colors p-4 rounded-DEFAULT text-center flex flex-col items-center justify-between space-y-2">
                    <span class="font-label-md text-label-md uppercase tracking-wider font-semibold {{ $prayerInfo['active_slot'] === 'ashar' ? 'text-amber-hover font-bold' : 'text-secondary-fixed-dim' }}">Ashar</span>
                    <span class="material-symbols-outlined text-2xl {{ $prayerInfo['active_slot'] === 'ashar' ? 'text-amber-primary' : 'text-secondary-fixed' }}">wb_cloudy</span>
                    <span class="font-headline-sm text-headline-sm font-bold {{ $prayerInfo['active_slot'] === 'ashar' ? 'text-navy-deep' : 'text-pure-white' }}">{{ $todaySchedule->ashar ?? '15:08' }}</span>
                    <span class="font-body-sm text-body-sm text-secondary-fixed-dim">Iqamah {{ $todaySchedule->ashar ? date('H:i', strtotime($todaySchedule->ashar . ' + ' . ($prayerSetting->iqamah_ashar ?? 7) . ' minutes')) : '15:15' }}</span>
                </div>

                <!-- Maghrib -->
                <div class="{{ $prayerInfo['active_slot'] === 'maghrib' ? 'bg-surface-container-lowest text-navy-deep transform -translate-y-1 shadow-xl' : 'bg-pure-white/5 hover:bg-pure-white/10' }} transition-colors p-4 rounded-DEFAULT text-center flex flex-col items-center justify-between space-y-2">
                    <span class="font-label-md text-label-md uppercase tracking-wider font-semibold {{ $prayerInfo['active_slot'] === 'maghrib' ? 'text-amber-hover font-bold' : 'text-secondary-fixed-dim' }}">Maghrib</span>
                    <span class="material-symbols-outlined text-2xl {{ $prayerInfo['active_slot'] === 'maghrib' ? 'text-amber-primary' : 'text-secondary-fixed' }}">wb_twilight</span>
                    <span class="font-headline-sm text-headline-sm font-bold {{ $prayerInfo['active_slot'] === 'maghrib' ? 'text-navy-deep' : 'text-pure-white' }}">{{ $todaySchedule->maghrib ?? '17:48' }}</span>
                    <span class="font-body-sm text-body-sm text-secondary-fixed-dim">Iqamah {{ $todaySchedule->maghrib ? date('H:i', strtotime($todaySchedule->maghrib . ' + ' . ($prayerSetting->iqamah_maghrib ?? 5) . ' minutes')) : '17:53' }}</span>
                </div>

                <!-- Isya -->
                <div class="{{ $prayerInfo['active_slot'] === 'isya' ? 'bg-surface-container-lowest text-navy-deep transform -translate-y-1 shadow-xl' : 'bg-pure-white/5 hover:bg-pure-white/10' }} transition-colors p-4 rounded-DEFAULT text-center flex flex-col items-center justify-between space-y-2">
                    <span class="font-label-md text-label-md uppercase tracking-wider font-semibold {{ $prayerInfo['active_slot'] === 'isya' ? 'text-amber-hover font-bold' : 'text-secondary-fixed-dim' }}">Isya</span>
                    <span class="material-symbols-outlined text-2xl {{ $prayerInfo['active_slot'] === 'isya' ? 'text-amber-primary' : 'text-secondary-fixed' }}">bedtime</span>
                    <span class="font-headline-sm text-headline-sm font-bold {{ $prayerInfo['active_slot'] === 'isya' ? 'text-navy-deep' : 'text-pure-white' }}">{{ $todaySchedule->isya ?? '19:00' }}</span>
                    <span class="font-body-sm text-body-sm text-secondary-fixed-dim">Iqamah {{ $todaySchedule->isya ? date('H:i', strtotime($todaySchedule->isya . ' + ' . ($prayerSetting->iqamah_isya ?? 10) . ' minutes')) : '19:10' }}</span>
                </div>
            </div>

            <!-- Friday / Info Footer inside widget -->
            @if($nextFriday)
                <div class="mt-6 pt-5 bg-pure-white/5 rounded-DEFAULT px-5 py-3.5 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-amber-primary/20 flex items-center justify-center text-amber-primary shrink-0">
                            <span class="material-symbols-outlined text-base">campaign</span>
                        </div>
                        <span class="font-body-sm text-body-sm text-secondary-fixed">
                            Jadwal Jumat Pekan Ini ({{ $nextFriday->date->format('d M Y') }}): <strong>Khatib: {{ $nextFriday->khatib_name }}</strong> • <strong>Imam: {{ $nextFriday->imam_name }}</strong> • Adzan I: 11:45 WITA
                        </span>
                    </div>
                    <a class="font-label-md text-label-md text-amber-primary hover:text-amber-glow font-bold inline-flex items-center gap-1 shrink-0" href="{{ route('jadwal-salat') }}">
                        Lihat Roster Sebulan
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- 3. SERVICES & ROUTINE PROGRAMS (Apa yang Kami Lakukan / What We Do) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 w-full">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <span class="font-label-md text-label-md text-amber-primary font-bold uppercase tracking-widest">Khidmah & Aktivitas</span>
            <h2 class="font-headline-lg text-headline-lg text-navy-deep font-bold">Apa yang Kami Lakukan</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">
                Menghidupkan sunnah dan memperkokoh silaturahmi melalui program keumatan yang berkesinambungan di Desa Ongkaw 3.
            </p>
        </div>

        <!-- 4 Cards Carousel / Row matching the reference layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($routines as $item)
                <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-full aspect-[4/3] rounded-DEFAULT overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" 
                                 alt="{{ $item->title }}" src="{{ $item->image ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDVubQYxXTnQQIdNvrlWyeo4JvYOOmvgSeSFYL9C40DC1j_FUUSb2UHY-dIyQjCiSwyKJCQhGf9XDzF31kq51CL0j_7yUuUdL53g7CG57WxovqB6ouM_d2ih4Bf9Po7HHh-AsksHHicrqaXA7weX9hgterpy2aLGvlaovMcRpkHLld1dk3rb4s_fzoevAfgpLenFNjhX09Lw34wq393zEGHWepQimWqU5YYPV_4Tw' }}"/>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm font-bold text-navy-deep">{{ $item->title }}</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3 leading-relaxed">
                            {{ $item->short_description }}
                        </p>
                    </div>
                    <div class="pt-6">
                        <a href="{{ route('layanan-program') }}" class="block w-full py-2.5 rounded-full bg-amber-primary/10 hover:bg-amber-primary text-amber-hover hover:text-pure-white font-label-md text-label-md font-bold transition-all text-center">
                            Pelajari Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 4. PROGRAM UNGGULAN MASJID (Two Columns with 3 Gold Round Icon Badges - Exact Reference Pattern) -->
    <section class="w-full bg-surface-container-low py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Harmonious 2-Photo Duo matching reference -->
            <div class="lg:col-span-6 grid grid-cols-2 gap-4">
                <div class="aspect-[3/4] rounded-DEFAULT overflow-hidden shadow-lg transform -rotate-1">
                    <img class="w-full h-full object-cover" alt="Ornamen Masjid Al-Fattah" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBBxdmJS_zb-9dnX1WM2xIAM8srd7SRH41JycG-wqkcITYT34FColWeq_nKbgItRgMZy0QKvsh1UpuIQK98qxei1a3CDqqVCVnD2Re6-GuUWz07PlW17MnSzTNb4jgi5LEsHW4D7qwkz9cXWT7YNr2PRTSl4dYUe8-COwfyroCp3kd1JhQWhCdyw2kMxrPdY8zXU_-Xxj6LoFwWSRJ6N-sv7qW2OUPSTdKWZIBJcA"/>
                </div>
                <div class="aspect-[3/4] rounded-DEFAULT overflow-hidden shadow-lg mt-8 transform rotate-1">
                    <img class="w-full h-full object-cover" alt="Kekhusyukan Ibadah" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDh9OfljOFKVxesKMISGamJJR20clt0aWa90UH3xCWOlqeOSmAgK0O2h7TIQkOKmXcbyMCW5Lx-RxTgu_7mEe0lBG2CEkEvm4qFNAhIoHh1q6G3LQKYaMjRMPvBkoFkMotnQBam19yDrLkyJaEZoCxEqfAotbt_z6hBmKfXpYYadg-Cu6dcRbXOsuzwmCQfCEFi49MGuxeQod8_HKcjl-9EZmNk254wG09px5n8gA"/>
                </div>
            </div>

            <!-- Right: Three Gold Icon Feature Points -->
            <div class="lg:col-span-6 flex flex-col space-y-8">
                <div>
                    <span class="font-label-md text-label-md text-amber-primary font-bold uppercase tracking-widest">Keunggulan & Nilai Layanan</span>
                    <h2 class="font-headline-lg text-headline-lg text-navy-deep font-bold mt-2">
                        Membangun Peradaban dari Serambi Masjid
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-3 leading-relaxed">
                        BKM Al-Fattah Ongkaw 3 berkomitmen mewujudkan tata kelola rumah ibadah yang modern, amanah, dan berdampak nyata bagi kesejahteraan lingkungan sekitar.
                    </p>
                </div>

                <div class="space-y-6">
                    <!-- Point 1 -->
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-full bg-amber-primary text-pure-white flex items-center justify-center shrink-0 shadow-md">
                            <span class="material-symbols-outlined text-2xl">menu_book</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-headline-sm text-headline-sm font-bold text-navy-deep">Pengajian & Literasi Al-Qur'an Berkala</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Menyediakan bimbingan tahsin Al-Qur'an dari nol hingga mahir untuk anak-anak, remaja karang taruna, hingga bapak/ibu jamaah sepuh.
                            </p>
                        </div>
                    </div>

                    <!-- Point 2 -->
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-full bg-amber-primary text-pure-white flex items-center justify-center shrink-0 shadow-md">
                            <span class="material-symbols-outlined text-2xl">account_balance_wallet</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-headline-sm text-headline-sm font-bold text-navy-deep">Transparansi Dana Infaq & Kas Terbuka Real-time</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Setiap rupiah amanah jamaah dilaporkan secara digital mingguan, ditempel di papan fisik masjid, dan disinkronkan langsung pada situs ini.
                            </p>
                        </div>
                    </div>

                    <!-- Point 3 -->
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-full bg-amber-primary text-pure-white flex items-center justify-center shrink-0 shadow-md">
                            <span class="material-symbols-outlined text-2xl">emergency</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="font-headline-sm text-headline-sm font-bold text-navy-deep">Layanan Sosial Jenazah & Ambulans Siaga 24 Jam</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                Fasilitas pemulasaraan jenazah tuntas, kain kafan gratis bagi warga membutuhkan, serta koordinasi tanggap darurat rujukan medis desa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. MAKE YOUR DONATION (Interactive Donation & Shodaqoh Form - Layout strictly matching reference) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 w-full" id="donasi-section">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <span class="font-label-md text-label-md text-amber-primary font-bold uppercase tracking-widest">Infaq & Amal Jariyah</span>
            <h2 class="font-headline-lg text-headline-lg text-navy-deep font-bold">Tunaikan Shodaqoh Anda</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">
                "Perumpamaan orang yang menafkahkan hartanya di jalan Allah adalah serupa dengan sebutir benih yang menumbuhkan tujuh bulir..." (QS. Al-Baqarah: 261)
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-stretch bg-surface-container-lowest rounded-lg p-6 lg:p-10 shadow-lg">
            <!-- Left Photo: Donation Box & Congregants -->
            <div class="lg:col-span-5 relative rounded-DEFAULT overflow-hidden min-h-[380px] lg:min-h-full">
                <img class="w-full h-full object-cover" alt="Kotak Infaq Masjid" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCKaW5ksffmuV4CgWAEL3b7s_JlSE7AuwouIjDpPGjI4rzhnG6HCIDIsh2n4moKu6FaHBCw_qGCW2duPt4MNjrKZAq9q5czZoT4Gxb7HLBqxTwUnGNhW2zWSr3BW8F_yKJXTl6pEu9IzHcgwEf3wDIM419xK0BkMKuvCS9x-Cr7NoLaboMBb5m8kf1s06MJMbpCrJVzKHXVOzKb9dq6nQNK8tUKB6l9hvU2yfaMow"/>
                <div class="absolute inset-0 bg-gradient-to-t from-navy-deep/90 via-navy-deep/30 to-transparent flex flex-col justify-end p-8 text-pure-white">
                    <span class="font-label-md text-label-md text-amber-primary font-bold uppercase tracking-widest mb-1">Amanah Umat</span>
                    <h4 class="font-headline-md text-headline-md font-bold mb-2">{{ $featuredProgram->title ?? 'Pembangunan Ruang Belajar Santri TPA' }}</h4>
                    <p class="font-body-sm text-body-sm text-secondary-fixed-dim leading-relaxed">
                        {{ $featuredProgram->description ?? 'Membantu pengadaan 2 ruang kelas baru santri tahfidz dan perlengkapan sarana belajar mengajar di Ongkaw 3.' }}
                    </p>
                    <div class="mt-4 pt-4 border-t border-pure-white/10 flex items-center justify-between text-xs text-secondary-fixed">
                        <span>Metode: QRIS, BSI & Bank SulutGo</span>
                        <span class="font-semibold text-amber-primary">Terverifikasi BKM</span>
                    </div>
                </div>
            </div>

            <!-- Right Form: Interactive Amount Chips, Frequency, Inputs, and Progress Bar -->
            <div class="lg:col-span-7 flex flex-col justify-between space-y-6">
                <form action="{{ route('sedekah.submit') }}" method="POST" enctype="multipart/form-data" id="homeDonationForm" class="space-y-6">
                    @csrf
                    <input type="hidden" name="program_id" value="{{ $featuredProgram->id ?? '' }}"/>

                    <div>
                        <!-- Choose Amount Chips -->
                        <label class="block font-label-lg text-label-lg font-bold text-navy-deep mb-3">Pilih Nominal Donasi:</label>
                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2.5" id="donation-chips">
                            <button class="donation-chip py-2.5 px-3 rounded-full text-center font-label-md text-label-md font-semibold bg-surface-container-low text-navy-deep hover:bg-amber-primary hover:text-pure-white transition-all shadow-sm" onclick="selectNominal(50000, this)" type="button">
                                50 Ribu
                            </button>
                            <button class="donation-chip py-2.5 px-3 rounded-full text-center font-label-md text-label-md font-semibold bg-amber-primary text-pure-white transition-all shadow-sm" onclick="selectNominal(100000, this)" type="button">
                                100 Ribu
                            </button>
                            <button class="donation-chip py-2.5 px-3 rounded-full text-center font-label-md text-label-md font-semibold bg-surface-container-low text-navy-deep hover:bg-amber-primary hover:text-pure-white transition-all shadow-sm" onclick="selectNominal(250000, this)" type="button">
                                250 Ribu
                            </button>
                            <button class="donation-chip py-2.5 px-3 rounded-full text-center font-label-md text-label-md font-semibold bg-surface-container-low text-navy-deep hover:bg-amber-primary hover:text-pure-white transition-all shadow-sm" onclick="selectNominal(500000, this)" type="button">
                                500 Ribu
                            </button>
                            <button class="donation-chip py-2.5 px-3 rounded-full text-center font-label-md text-label-md font-semibold bg-surface-container-low text-navy-deep hover:bg-amber-primary hover:text-pure-white transition-all shadow-sm col-span-3 sm:col-span-1" onclick="selectNominal(1000000, this)" type="button">
                                1 Juta
                            </button>
                        </div>

                        <!-- Custom Amount & Currency Input -->
                        <div class="mt-4 flex items-center gap-2">
                            <div class="relative flex-1">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-body-md text-body-md text-on-surface-variant font-bold">Rp</span>
                                <input class="w-full pl-12 pr-4 py-3 rounded-DEFAULT bg-surface-container-low text-navy-deep font-headline-sm text-headline-sm font-bold focus:outline-none focus:ring-2 focus:ring-amber-primary" 
                                       id="custom-amount" name="amount" placeholder="Nominal lainnya" type="number" value="100000" required min="10000"/>
                            </div>
                            <div class="px-5 py-3 rounded-DEFAULT bg-surface-container font-label-md text-label-md text-navy-deep font-bold shrink-0">
                                IDR (Rupiah)
                            </div>
                        </div>
                    </div>

                    <!-- Frequency Segmented Switch (Sekali / Harian / Bulanan) -->
                    <div>
                        <label class="block font-label-md text-label-md font-semibold text-on-surface-variant mb-2">Frekuensi Donasi:</label>
                        <div class="inline-flex p-1 rounded-full bg-surface-container-low w-full sm:w-auto">
                            <label class="flex-1 sm:flex-initial px-5 py-2 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-navy-deep transition-all cursor-pointer">
                                <input type="radio" name="frequency" value="sekali" class="sr-only" onchange="updateFreqTab(this)"/>
                                <span>Sekali</span>
                            </label>
                            <label class="flex-1 sm:flex-initial px-5 py-2 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-navy-deep transition-all cursor-pointer">
                                <input type="radio" name="frequency" value="harian" class="sr-only" onchange="updateFreqTab(this)"/>
                                <span>Harian</span>
                            </label>
                            <label class="flex-1 sm:flex-initial px-6 py-2 rounded-full font-label-md text-label-md bg-amber-primary text-pure-white font-bold shadow-sm transition-all cursor-pointer">
                                <input type="radio" name="frequency" value="bulanan" class="sr-only" checked onchange="updateFreqTab(this)"/>
                                <span>Bulanan (Rutin)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Payment Method Radio Grid -->
                    <div>
                        <label class="block font-label-md text-label-md font-semibold text-on-surface-variant mb-2">Pilihan Pembayaran:</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                            <label class="p-3 rounded-DEFAULT bg-surface-container-low text-center cursor-pointer hover:bg-amber-primary/10 border-2 border-transparent peer-checked:border-amber-primary text-xs font-semibold">
                                <input type="radio" name="payment_method" value="qris" class="peer sr-only" checked/>
                                <div class="peer-checked:text-amber-primary">
                                    <span class="material-symbols-outlined text-xl block mb-1">qr_code_2</span>
                                    <span>QRIS Nasional</span>
                                </div>
                            </label>
                            <label class="p-3 rounded-DEFAULT bg-surface-container-low text-center cursor-pointer hover:bg-amber-primary/10 border-2 border-transparent peer-checked:border-amber-primary text-xs font-semibold">
                                <input type="radio" name="payment_method" value="transfer_bsi" class="peer sr-only"/>
                                <div class="peer-checked:text-amber-primary">
                                    <span class="material-symbols-outlined text-xl block mb-1">account_balance</span>
                                    <span>BSI 7182938192</span>
                                </div>
                            </label>
                            <label class="p-3 rounded-DEFAULT bg-surface-container-low text-center cursor-pointer hover:bg-amber-primary/10 border-2 border-transparent peer-checked:border-amber-primary text-xs font-semibold">
                                <input type="radio" name="payment_method" value="transfer_sulutgo" class="peer sr-only"/>
                                <div class="peer-checked:text-amber-primary">
                                    <span class="material-symbols-outlined text-xl block mb-1">payments</span>
                                    <span>Bank SulutGo</span>
                                </div>
                            </label>
                            <label class="p-3 rounded-DEFAULT bg-surface-container-low text-center cursor-pointer hover:bg-amber-primary/10 border-2 border-transparent peer-checked:border-amber-primary text-xs font-semibold">
                                <input type="radio" name="payment_method" value="tunai_kotak" class="peer sr-only"/>
                                <div class="peer-checked:text-amber-primary">
                                    <span class="material-symbols-outlined text-xl block mb-1">savings</span>
                                    <span>Kotak Amal</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Donor Information Fields -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <input class="w-full px-4 py-3 rounded-DEFAULT bg-surface-container-low text-navy-deep text-sm placeholder:text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-amber-primary" 
                               name="donor_name" placeholder="Nama Donatur (mis. Hamba Allah)" type="text"/>
                        <input class="w-full px-4 py-3 rounded-DEFAULT bg-surface-container-low text-navy-deep text-sm placeholder:text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-amber-primary" 
                               name="phone_wa" placeholder="Nomor WhatsApp (Konfirmasi)" type="text"/>
                    </div>

                    <div>
                        <textarea class="w-full px-4 py-3 rounded-DEFAULT bg-surface-container-low text-navy-deep text-sm placeholder:text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-amber-primary resize-none" 
                                  name="donor_prayer" placeholder="Tuliskan doa atau pesan kebaikan (opsional)" rows="2"></textarea>
                    </div>

                    <!-- Fund Progress Bar -->
                    @if($featuredProgram)
                        <div class="bg-surface-container-low p-4 rounded-DEFAULT space-y-2">
                            <div class="flex items-center justify-between text-xs font-semibold">
                                <span class="text-navy-deep font-bold">Progres {{ $featuredProgram->title }}</span>
                                <span class="text-amber-hover font-extrabold">{{ $featuredProgram->percentage }}% Terkumpul</span>
                            </div>
                            <div class="w-full h-3 bg-surface-container rounded-full overflow-hidden">
                                <div class="h-full bg-amber-primary rounded-full transition-all duration-500" style="width: {{ $featuredProgram->percentage }}%;"></div>
                            </div>
                            <div class="flex items-center justify-between text-xs text-on-surface-variant">
                                <span>Terkumpul: <strong class="text-navy-deep">Rp {{ number_format($featuredProgram->collected_amount, 0, ',', '.') }}</strong></span>
                                <span>Target: <strong class="text-navy-deep">Rp {{ number_format($featuredProgram->target_amount, 0, ',', '.') }}</strong></span>
                            </div>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button class="w-full py-4 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white font-label-lg text-label-lg font-bold shadow-[0_8px_24px_-4px_rgba(245,158,11,0.4)] transition-all transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2" type="submit">
                        <span class="material-symbols-outlined text-xl">favorite</span>
                        <span>Sedekah Sekarang via QRIS / Transfer</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- 6. ACTIVITIES OF THE MOSQUE (Aktivitas Jamaah - 3x2 Grid with Scrim Text Overlays) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-20 w-full">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div class="space-y-2">
                <span class="font-label-md text-label-md text-amber-primary font-bold uppercase tracking-widest">Dokumentasi & Syiar</span>
                <h2 class="font-headline-lg text-headline-lg text-navy-deep font-bold">Aktivitas & Galeri Jamaah</h2>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-xl">
                    Merekam jejak kebersamaan, ukhuwah islamiyah, dan kegiatan sosial kemasyarakatan di Masjid Al-Fattah.
                </p>
            </div>
            <a class="inline-flex items-center gap-2 text-amber-hover font-label-lg text-label-lg font-bold hover:underline shrink-0" href="{{ route('galeri') }}">
                <span>Lihat Semua Album Galeri</span>
                <span class="material-symbols-outlined text-lg">chevron_right</span>
            </a>
        </div>

        <!-- 3x2 Grid matching the inspiration pattern -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($galleryPhotos as $photo)
                <div class="relative group rounded-DEFAULT overflow-hidden aspect-[4/3] shadow-md bg-navy-deep">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                         alt="{{ $photo->caption }}" src="{{ $photo->photo_path }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-deep/90 via-navy-deep/30 to-transparent flex flex-col justify-end p-5 text-pure-white">
                        <span class="font-label-md text-xs text-amber-primary font-bold uppercase">{{ str_replace('_', ' ', $photo->category) }}</span>
                        <h4 class="font-headline-sm text-headline-sm font-bold mt-1 leading-snug">{{ $photo->caption }}</h4>
                        <span class="font-body-sm text-body-sm text-secondary-fixed-dim">Masjid Al-Fattah Ongkaw 3</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 7. OUR TESTIMONIALS (Kartu Tengah Aktif Gelap Navy Sesuai Inspirasi Layout) -->
    <section class="w-full bg-surface-container-low py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="font-label-md text-label-md text-amber-primary font-bold uppercase tracking-widest">Kesan & Pengalaman</span>
                <h2 class="font-headline-lg text-headline-lg text-navy-deep font-bold">Apa Kata Jamaah & Warga</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Apresiasi jamaah tetap, tokoh masyarakat, dan donatur terhadap kenyamanan ibadah di Masjid Al-Fattah Ongkaw 3.
                </p>
            </div>

            <!-- 3 Testimonial Cards Layout (Center card highlighted in navy) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
                @foreach($testimonials as $t)
                    @if($t->is_featured)
                        <!-- Active Center Navy Card -->
                        <div class="bg-navy-card text-pure-white p-8 lg:p-10 rounded-DEFAULT shadow-2xl flex flex-col justify-between space-y-6 transform lg:-translate-y-2 relative">
                            <span class="absolute top-6 right-6 material-symbols-outlined text-amber-primary/30 text-5xl">format_quote</span>
                            <div class="space-y-4">
                                <div class="flex text-amber-primary">
                                    @for($i = 0; $i < ($t->rating ?? 5); $i++)
                                        <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">star</span>
                                    @endfor
                                </div>
                                <p class="font-body-lg text-body-lg text-pure-white leading-relaxed font-medium">
                                    "{{ $t->content }}"
                                </p>
                            </div>
                            <div class="flex items-center gap-3 pt-3 border-t-0">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-navy-accent shrink-0">
                                    <img class="w-full h-full object-cover" alt="{{ $t->name }}" src="{{ $t->avatar }}"/>
                                </div>
                                <div>
                                    <div class="font-label-lg text-label-lg font-bold text-pure-white">{{ $t->name }}</div>
                                    <div class="font-body-sm text-body-sm text-amber-primary font-semibold">{{ $t->role_title }}</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Light Card -->
                        <div class="bg-surface-container-lowest p-8 rounded-DEFAULT shadow-sm flex flex-col justify-between space-y-6">
                            <div class="space-y-3">
                                <div class="flex text-amber-primary">
                                    @for($i = 0; $i < ($t->rating ?? 5); $i++)
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                    @endfor
                                </div>
                                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                    "{{ $t->content }}"
                                </p>
                            </div>
                            <div class="flex items-center gap-3 pt-2">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-surface-container">
                                    <img class="w-full h-full object-cover" alt="{{ $t->name }}" src="{{ $t->avatar }}"/>
                                </div>
                                <div>
                                    <div class="font-label-lg text-label-lg font-bold text-navy-deep">{{ $t->name }}</div>
                                    <div class="font-body-sm text-body-sm text-on-surface-variant">{{ $t->role_title }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- 8. LOKASI, PETA & FASILITAS MASJID (PRD 6.6 & 9) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-24 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <!-- Left: Interactive Map Container -->
            <div class="lg:col-span-7 bg-surface-container rounded-DEFAULT overflow-hidden shadow-lg min-h-[380px] relative">
                <div class="w-full h-full min-h-[380px] bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDIzyUrsbZ-e7qSw53nwzfXDDg1uPne-1TTyInprSaQenEmxuCcYOQ3_uydftabj6p6_aj-4Fw_FKUzjIe0sUEpFby9kFzCljaln4Z74nVE7eK2g9wGclh08XbP8Bl0TEvvPZ7YAIbR5LNCYnB6FvdduzCS5rAZ4g-XyBn_Nfq2e3K4hAVpPwYisBftVzB92Q-kiy3U87GLLdmVmeSEtyh76XfMp21vDKEmDi1gyw')"></div>
                <div class="absolute top-4 left-4 bg-navy-card/90 backdrop-blur px-4 py-2 rounded-full text-pure-white text-xs font-semibold flex items-center gap-2 shadow-md">
                    <span class="w-2 h-2 rounded-full bg-success"></span>
                    <span>Jl. Trans Sulawesi (Akses Mudah Kendaraan Lintas Daerah)</span>
                </div>
            </div>

            <!-- Right: Address & Mosque Specifications Card -->
            <div class="lg:col-span-5 bg-surface-container-lowest p-8 lg:p-10 rounded-DEFAULT shadow-md flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-primary/10 text-amber-hover font-label-md text-label-md font-bold">
                        <span class="material-symbols-outlined text-sm">place</span>
                        <span>Lokasi Strategis</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md font-bold text-navy-deep">Kunjungi Masjid Al-Fattah Ongkaw 3</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Berada tepat di jalur utama Trans Sulawesi Desa Ongkaw 3, Kecamatan Sinonsayang, Kabupaten Minahasa Selatan, Sulawesi Utara. Sangat cocok sebagai titik peristirahatan dan sholat para musafir lintas daerah.
                    </p>

                    <!-- Specifications List -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
                            <span class="font-body-sm text-body-sm text-navy-deep font-medium">Kapasitas ruang sholat utama 400 jamaah pria & wanita</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
                            <span class="font-body-sm text-body-sm text-navy-deep font-medium">Area parkir luas aman untuk mobil, motor, dan bus</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
                            <span class="font-body-sm text-body-sm text-navy-deep font-medium">Tempat wudhu higienis ramah lansia/disabilitas</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
                            <span class="font-body-sm text-body-sm text-navy-deep font-medium">Air minum bersih gratis dan rest area musafir</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex flex-col sm:flex-row gap-3">
                    <a class="flex-1 inline-flex items-center justify-center px-6 py-3.5 rounded-full bg-navy-deep hover:bg-navy-accent text-pure-white font-label-md text-label-md font-bold transition-all text-center gap-2" 
                       href="https://maps.google.com/?q=0.912,124.365" target="_blank" rel="noopener noreferrer">
                        <span class="material-symbols-outlined text-lg">near_me</span>
                        <span>Buka di Google Maps</span>
                    </a>
                    <a class="px-5 py-3.5 rounded-full bg-surface-container-low hover:bg-surface-container text-navy-deep font-label-md text-label-md font-bold transition-all text-center" href="{{ route('kontak') }}">
                        Hubungi Pengurus
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    function selectNominal(amount, btnElement) {
        const input = document.getElementById('custom-amount');
        if (input) {
            input.value = amount;
        }
        const chips = document.querySelectorAll('.donation-chip');
        chips.forEach(chip => {
            chip.classList.remove('bg-amber-primary', 'text-pure-white');
            chip.classList.add('bg-surface-container-low', 'text-navy-deep');
        });
        btnElement.classList.remove('bg-surface-container-low', 'text-navy-deep');
        btnElement.classList.add('bg-amber-primary', 'text-pure-white');
    }

    function updateFreqTab(radio) {
        const labels = radio.closest('.inline-flex').querySelectorAll('label');
        labels.forEach(l => {
            l.className = 'flex-1 sm:flex-initial px-5 py-2 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-navy-deep transition-all cursor-pointer';
        });
        const currentLabel = radio.closest('label');
        currentLabel.className = 'flex-1 sm:flex-initial px-6 py-2 rounded-full font-label-md text-label-md bg-amber-primary text-pure-white font-bold shadow-sm transition-all cursor-pointer';
    }
</script>
@endpush
