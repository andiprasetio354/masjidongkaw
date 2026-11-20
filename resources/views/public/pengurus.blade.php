@extends('layouts.public')

@section('title', 'Pengurus & Profil Masjid')

@section('content')
<div class="flex flex-col w-full">
    <!-- SECTION 1: HEADER & SEJARAH PROFIL -->
    <section class="relative w-full overflow-hidden bg-gradient-to-b from-sky-dawn-from/40 via-surface to-surface pb-16 lg:pb-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 pt-10">
            <!-- Breadcrumb & Badge -->
            <div class="flex items-center gap-2 mb-6">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-amber-primary/10 text-primary text-xs font-semibold tracking-wide">
                    <span class="material-symbols-outlined text-amber-primary text-base">verified</span>
                    Profil Resmi & Organisasi BKM
                </span>
                <span class="text-secondary/40 text-xs">•</span>
                <span class="text-xs text-secondary font-medium">Periode Khidmat 2024–2029</span>
            </div>

            <!-- Hero Header & Vision Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                <div class="lg:col-span-7 space-y-6">
                    <h1 class="text-3xl lg:text-4xl text-navy-deep font-extrabold tracking-tight leading-tight">
                        Meneguhkan Syiar Dakwah & Keberkahan Jamaah di Tanah Ongkaw Tiga
                    </h1>
                    <p class="text-base text-secondary leading-relaxed">
                        {{ $profile->history ?? 'Berdiri sejak tahun 1989 di pesisir Sinonsayang, Minahasa Selatan, Masjid Al-Fattah terus berikhtiar menjadi episentrum ibadah yang khusyuk, persaudaraan ukhuwah islamiyah yang kokoh, serta penggerak peradaban dan kesejahteraan sosial masyarakat.' }}
                    </p>

                    <!-- Sejarah Singkat Card -->
                    <div class="bg-surface-container-lowest rounded-DEFAULT p-6 lg:p-8 shadow-sm space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-amber-glow flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-xl">history_edu</span>
                            </div>
                            <div>
                                <h3 class="text-lg text-navy-deep font-bold">Napak Tilas Pendirian</h3>
                                <span class="text-xs text-secondary">Dari Musholla Sederhana Menuju Masjid Makmur</span>
                            </div>
                        </div>
                        <p class="text-sm text-secondary leading-relaxed">
                            Masjid Al-Fattah berawal dari swadaya para perantau dan warga lokal Muslim di Desa Ongkaw 3 yang mengidamkan tempat sujud berjamaah. Dengan semangat gotong royong lintas generasi dan dukungan tokoh masyarakat Minahasa Selatan, bangunan kini telah berdiri kokoh di poros Trans Sulawesi, menampung lebih dari 650 jamaah, menyelenggarakan pendidikan Al-Qur'an anak-anak, serta aktif membina keharmonisan antarwarga.
                        </p>
                        <div class="grid grid-cols-3 gap-4 pt-2">
                            <div class="bg-surface-container-low p-3.5 rounded-DEFAULT text-center">
                                <span class="text-2xl font-bold text-navy-deep block">1989</span>
                                <span class="text-xs text-secondary">Tahun Rintisan</span>
                            </div>
                            <div class="bg-surface-container-low p-3.5 rounded-DEFAULT text-center">
                                <span class="text-2xl font-bold text-amber-primary block">{{ $profile->capacity ?? '650+' }}</span>
                                <span class="text-xs text-secondary">Kapasitas Jamaah</span>
                            </div>
                            <div class="bg-surface-container-low p-3.5 rounded-DEFAULT text-center">
                                <span class="text-2xl font-bold text-tertiary block">100%</span>
                                <span class="text-xs text-secondary">Swadaya Terbuka</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visi & Misi Card -->
                <div class="lg:col-span-5 bg-navy-deep text-pure-white rounded-lg p-8 shadow-xl space-y-6 relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-44 h-44 rounded-full bg-amber-primary/10 blur-2xl pointer-events-none"></div>
                    <div class="space-y-2">
                        <span class="text-xs text-amber-primary font-bold uppercase tracking-wider block">Pedoman Khidmat</span>
                        <h2 class="text-2xl font-bold text-pure-white">Visi & Misi Kepengurusan</h2>
                    </div>
                    <div class="bg-navy-card/80 p-5 rounded-DEFAULT space-y-2">
                        <div class="flex items-center gap-2 text-amber-primary">
                            <span class="material-symbols-outlined text-lg">flag</span>
                            <span class="text-sm font-bold">Visi Utama</span>
                        </div>
                        <p class="text-sm text-pure-white/90 leading-snug italic">
                            "{{ $profile->vision ?? 'Terwujudnya Masjid Al-Fattah sebagai pusat ibadah yang makmur, mandiri, berkeadaban, dan menebarkan rahmat bagi semesta alam di Minahasa Selatan.' }}"
                        </p>
                    </div>
                    <div class="space-y-3">
                        <span class="text-xs text-secondary-fixed-dim uppercase tracking-wider block font-semibold">Misi Strategis</span>
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-amber-primary/20 text-amber-primary flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">1</span>
                            <p class="text-xs text-pure-white/80">Menyelenggarakan ibadah salat fardhu berjamaah dan kajian dakwah Islamiyah yang sejuk, inklusif, dan mencerahkan.</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-amber-primary/20 text-amber-primary flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">2</span>
                            <p class="text-xs text-pure-white/80">Mengembangkan pembinaan generasi Qur'ani melalui TPA Al-Fattah dan wadah kreatifitas Remaja Islam Masjid (RISMA).</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-amber-primary/20 text-amber-primary flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">3</span>
                            <p class="text-xs text-pure-white/80">Mengelola infaq, sedekah, dan wakaf umat secara transparan, akuntabel, dan berbasis laporan digital terbuka.</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-amber-primary/20 text-amber-primary flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">4</span>
                            <p class="text-xs text-pure-white/80">Menjaga kebersihan, keasrian, serta kelengkapan sarana ibadah yang ramah bagi lansia, musafir, dan penyandang disabilitas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: SUSUNAN PENGURUS BKM -->
    <section class="w-full py-16 bg-surface-container-low/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 space-y-12">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="text-xs text-primary font-bold uppercase tracking-widest block">Amanah & Pelayan Jamaah</span>
                <h2 class="text-3xl text-navy-deep font-extrabold tracking-tight">
                    Susunan Pengurus BKM Al-Fattah Ongkaw 3
                </h2>
                <p class="text-sm text-secondary leading-relaxed">
                    Berdasarkan Surat Ketetapan Musyawarah Jamaah Periode 2024–2029 untuk mewujudkan tata kelola masjid yang profesional, amanah, dan melayani umat dengan ketulusan hati.
                </p>
            </div>

            <!-- Dewan Pembina / Penasihat -->
            @if($pembina->count() > 0)
                <div class="bg-surface-container-lowest rounded-lg p-6 lg:p-10 shadow-sm">
                    @foreach($pembina as $pem)
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                            <div class="lg:col-span-4 flex justify-center">
                                <div class="relative group">
                                    <div class="w-60 h-60 lg:w-72 lg:h-72 rounded-2xl overflow-hidden shadow-md ring-4 ring-amber-primary/20">
                                        <img src="{{ $pem->photo_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDDRYAoXqkdk0GzUMVm3YDfLdAwb6NJbj-EBVPZtyhX5aRZ88X8a8_6A-bxtXNIocp-46zRK9qw9ZNviLEcyFNf4YtHnRnVgswn5MlrkTvxI0mPfpDe_pwFGnOvn7nhddVSB3r2yiAcxV6gRrcl7vmtSTIY6TAZeSH9E7AoiRz8xGWo2KBET8mObGyYqeRvX7NT0EK396dhpmC4RjaxcM5T7ytigpSk_KxxPpkXSw' }}" alt="{{ $pem->name }}" class="w-full h-full object-cover"/>
                                    </div>
                                    <div class="absolute -bottom-3 -right-3 bg-amber-primary text-pure-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-md flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-sm">stars</span>
                                        Penasihat Utama
                                    </div>
                                </div>
                            </div>
                            <div class="lg:col-span-8 space-y-4">
                                <div class="space-y-1">
                                    <span class="text-xs text-amber-primary font-bold uppercase tracking-wider">Dewan Pembina & Penasihat Syariah</span>
                                    <h3 class="text-2xl text-navy-deep font-bold">{{ $pem->name }}</h3>
                                    <p class="text-xs text-secondary">{{ $pem->role_title }}</p>
                                </div>
                                <p class="text-sm text-secondary leading-relaxed italic bg-surface-container-low/60 p-4 rounded-DEFAULT">
                                    "{{ $pem->bio ?? 'Kekuatan masjid ini tidak semata-mata diukur dari kemegahan kubahnya, melainkan dari kehangatan saf-saf salatnya, kepedulian terhadap tetangga yang berkekurangan, dan keramahan jamaah dalam menyambut setiap musafir yang singgah di pesisir Ongkaw.' }}"
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-amber-glow flex items-center justify-center text-primary shrink-0">
                                            <span class="material-symbols-outlined text-lg">calendar_month</span>
                                        </div>
                                        <div>
                                            <span class="text-xs text-secondary block">Masa Khidmat</span>
                                            <span class="text-sm font-bold text-navy-deep">2024 - 2029</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary shrink-0">
                                            <span class="material-symbols-outlined text-lg">school</span>
                                        </div>
                                        <div>
                                            <span class="text-xs text-secondary block">Fokus Pembinaan</span>
                                            <span class="text-sm font-bold text-navy-deep">Fatwa & Kerukunan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Pengurus Harian Inti (Grid 3 Kolom) -->
            <div class="space-y-6">
                <h3 class="text-xl text-navy-deep font-bold text-center">Pengurus Harian BKM</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($harian as $har)
                        <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                            <div class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $har->photo_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDiTYKg6JA8H8wMPAw_6-zwm8TOQmO4RSWKAdgFajDKmzFOcO5Haas8OwB3SGsPvrzBCNOEPTH8qHEOkows7l6gUPphe7b4Hc49pkVe_IGTZDoKvv9HFshvV8yPpO-Jk9WKXEH7B9F-EkvrA7oTxFJcHeJpUSvZxSx__OiTWb3Xrqtk6m31-qYEaL_P2ksYNAGrGxTEf69wnCtZg2kMZmLRgOyoyfgN2CVOiAHaUw' }}" alt="{{ $har->name }}" class="w-16 h-16 rounded-full object-cover shrink-0 shadow-sm"/>
                                    <div>
                                        <span class="px-2.5 py-0.5 rounded-full bg-amber-primary/10 text-primary text-xs font-semibold">{{ $har->role_title }}</span>
                                        <h4 class="text-base font-bold text-navy-deep pt-1">{{ $har->name }}</h4>
                                        <span class="text-xs text-secondary">{{ $har->division }}</span>
                                    </div>
                                </div>
                                <p class="text-xs text-secondary leading-snug">
                                    {{ $har->bio }}
                                </p>
                            </div>
                            <div class="pt-4 mt-4 flex items-center justify-between text-secondary border-t border-surface-container-low text-xs">
                                <span>Amanah 2024-2029</span>
                                @if($har->phone)
                                    <a class="text-amber-primary hover:text-amber-hover flex items-center gap-1 font-semibold" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $har->phone) }}" target="_blank">
                                        <span class="material-symbols-outlined text-base">chat</span> WhatsApp
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Imam & Muadzin Row -->
            <div class="space-y-6">
                <h3 class="text-xl text-navy-deep font-bold text-center">Imam & Muadzin Rawatib</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($imamMuadzin as $im)
                        <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm flex items-center gap-4">
                            <img src="{{ $im->photo_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDDRYAoXqkdk0GzUMVm3YDfLdAwb6NJbj-EBVPZtyhX5aRZ88X8a8_6A-bxtXNIocp-46zRK9qw9ZNviLEcyFNf4YtHnRnVgswn5MlrkTvxI0mPfpDe_pwFGnOvn7nhddVSB3r2yiAcxV6gRrcl7vmtSTIY6TAZeSH9E7AoiRz8xGWo2KBET8mObGyYqeRvX7NT0EK396dhpmC4RjaxcM5T7ytigpSk_KxxPpkXSw' }}" alt="{{ $im->name }}" class="w-16 h-16 rounded-full object-cover shrink-0 shadow-sm"/>
                            <div class="flex-1">
                                <span class="px-2.5 py-0.5 rounded-full bg-tertiary-fixed text-tertiary text-xs font-semibold">{{ $im->role_title }}</span>
                                <h4 class="text-base font-bold text-navy-deep pt-1">{{ $im->name }}</h4>
                                <p class="text-xs text-secondary mt-1">{{ $im->bio }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Remaja Islam Masjid (RISMA) -->
            @if($risma->count() > 0)
                <div class="space-y-6">
                    <h3 class="text-xl text-navy-deep font-bold text-center">Remaja Islam Masjid (RISMA) Al-Fattah</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($risma as $r)
                            <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm text-center flex flex-col items-center">
                                <img src="{{ $r->photo_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDAeSDOiD2Yye0dMlYnAULRGvLB6a15TExz0px2NdL1jlA94kVjaQjdB3bSLevwECTeGxa3SMRAOJTfpcH1NRlUbWeBCcLReLrxribquYQAzibOxSzMv5EpymOL0-3u7YlPGct8784sP_yPgFmJxDuA5ONt2cOhZZMJAHeyVcww0dL3RQc8fGP_BDeEmGC3DZBCk3qrJPFWYraWvXAzshLTMdgC9w8Pbhmv8bR4QA' }}" alt="{{ $r->name }}" class="w-20 h-20 rounded-full object-cover shadow-sm mb-3"/>
                                <span class="px-2.5 py-0.5 rounded-full bg-surface-container text-secondary text-xs font-semibold">{{ $r->role_title }}</span>
                                <h4 class="text-base font-bold text-navy-deep pt-1">{{ $r->name }}</h4>
                                <p class="text-xs text-secondary mt-1">{{ $r->bio }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
