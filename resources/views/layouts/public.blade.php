<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Masjid Al-Fattah Ongkaw 3') - Pusat Ibadah & Dakwah Minahasa Selatan</title>
    
    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface": "#f8f9ff",
                        "surface-dim": "#cbdbf5",
                        "surface-bright": "#f8f9ff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff4ff",
                        "surface-container": "#e5eeff",
                        "surface-container-high": "#dce9ff",
                        "surface-container-highest": "#d3e4fe",
                        "on-surface": "#0b1c30",
                        "on-surface-variant": "#534434",
                        "inverse-surface": "#213145",
                        "inverse-on-surface": "#eaf1ff",
                        "outline": "#867461",
                        "outline-variant": "#d8c3ad",
                        "surface-tint": "#855300",
                        "primary": "#855300",
                        "on-primary": "#ffffff",
                        "primary-container": "#f59e0b",
                        "on-primary-container": "#613b00",
                        "inverse-primary": "#ffb95f",
                        "secondary": "#565e74",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#dae2fd",
                        "on-secondary-container": "#5c647a",
                        "tertiary": "#006398",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#5bb8fe",
                        "on-tertiary-container": "#00476e",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "primary-fixed": "#ffddb8",
                        "primary-fixed-dim": "#ffb95f",
                        "on-primary-fixed": "#2a1700",
                        "on-primary-fixed-variant": "#653e00",
                        "secondary-fixed": "#dae2fd",
                        "secondary-fixed-dim": "#bec6e0",
                        "on-secondary-fixed": "#131b2e",
                        "on-secondary-fixed-variant": "#3f465c",
                        "tertiary-fixed": "#cce5ff",
                        "tertiary-fixed-dim": "#93ccff",
                        "on-tertiary-fixed": "#001d31",
                        "on-tertiary-fixed-variant": "#004b73",
                        "background": "#f8f9ff",
                        "on-background": "#0b1c30",
                        "surface-variant": "#d3e4fe",
                        "sky-dawn-from": "#E0F2FE",
                        "sky-dawn-to": "#FFEDD5",
                        "navy-deep": "#0F172A",
                        "navy-card": "#1E293B",
                        "navy-accent": "#334155",
                        "amber-primary": "#F59E0B",
                        "amber-hover": "#D97706",
                        "amber-glow": "#FEF3C7",
                        "pure-white": "#FFFFFF",
                        "bg-canvas": "#F8FAFC",
                        "border-subtle": "#E2E8F0",
                        "success": "#10B981"
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "gutter": "1.5rem",
                        "margin": "2rem",
                        "margin-mobile": "1rem",
                        "space-2xs": "0.25rem",
                        "space-xs": "0.5rem",
                        "space-sm": "0.75rem",
                        "space-md": "1rem",
                        "space-lg": "1.5rem",
                        "space-xl": "2.5rem",
                        "space-2xl": "4rem",
                        "space-3xl": "6rem"
                    },
                    fontFamily: {
                        "display-hero": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "body-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
                        "body-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "label-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "label-md": ["Plus Jakarta Sans", "sans-serif"],
                        "digital-clock": ["Plus Jakarta Sans", "monospace"],
                        "arabic-display": ["Noto Serif", "serif"]
                    }
                }
            }
        };
    </script>
    @stack('styles')
</head>
<body class="bg-surface font-body-md text-on-surface antialiased selection:bg-amber-primary selection:text-pure-white flex flex-col min-h-screen">
    
    <!-- Top Sticky Header -->
    <header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-4">
            <!-- Brand Logo & Identity -->
            <a href="{{ route('beranda') }}" class="flex items-center gap-3 shrink-0">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-primary to-amber-hover flex items-center justify-center text-pure-white shadow-md">
                    <span class="material-symbols-outlined text-2xl">mosque</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-headline-sm text-headline-sm text-navy-deep font-bold tracking-tight leading-tight">Masjid Al-Fattah</span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant font-medium">Ongkaw 3, Minahasa Selatan</span>
                </div>
            </a>

            <!-- Desktop Nav Pill Menu -->
            <nav class="hidden xl:flex items-center gap-1 bg-surface-container-low/70 p-1.5 rounded-full shadow-[0_1px_4px_rgba(15,23,42,0.03)]">
                <a href="{{ route('beranda') }}" class="px-4 py-2 rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('beranda') ? 'bg-surface-container text-on-surface font-bold shadow-sm' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Beranda
                </a>
                <a href="{{ route('jadwal-salat') }}" class="px-4 py-2 rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('jadwal-salat') ? 'bg-surface-container text-on-surface font-bold shadow-sm' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Jadwal Salat
                </a>
                <a href="{{ route('layanan-program') }}" class="px-4 py-2 rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('layanan-program') ? 'bg-surface-container text-on-surface font-bold shadow-sm' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Layanan & Program
                </a>
                <a href="{{ route('sedekah') }}" class="px-4 py-2 rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('sedekah') ? 'bg-surface-container text-on-surface font-bold shadow-sm' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Donasi Shodaqoh
                </a>
                <a href="{{ route('galeri') }}" class="px-4 py-2 rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('galeri') ? 'bg-surface-container text-on-surface font-bold shadow-sm' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Galeri Kegiatan
                </a>
                <a href="{{ route('pengurus') }}" class="px-4 py-2 rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('pengurus') || request()->routeIs('profil') ? 'bg-surface-container text-on-surface font-bold shadow-sm' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Pengurus & Profil
                </a>
                <a href="{{ route('kontak') }}" class="px-4 py-2 rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('kontak') ? 'bg-surface-container text-on-surface font-bold shadow-sm' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Kontak
                </a>
            </nav>

            <!-- CTA Actions & Admin Shortcut -->
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('sedekah') }}#form-donasi" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white font-label-lg text-label-lg shadow-[0_4px_14px_rgba(245,158,11,0.35)] transition-all transform active:scale-95 gap-1.5">
                    <span class="material-symbols-outlined text-lg">volunteer_activism</span>
                    <span>Donasi Sekarang</span>
                </a>

                @auth
                    <a href="{{ auth()->user()->canAccessContent() ? route('admin.konten.index') : route('admin.keuangan.index') }}" class="flex items-center gap-2 p-1.5 pr-3 rounded-full bg-surface-container hover:bg-surface-container-high transition-colors" title="Buka Dashboard Admin">
                        <div class="w-8 h-8 rounded-full bg-amber-primary text-pure-white flex items-center justify-center text-xs font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="text-xs font-semibold text-navy-deep hidden md:inline">Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="p-2 rounded-full text-secondary hover:text-navy-deep hover:bg-surface-container transition-colors" title="Masuk Portal Admin">
                        <span class="material-symbols-outlined text-xl">admin_panel_settings</span>
                    </a>
                @endauth

                <!-- Mobile Hamburger Button -->
                <button type="button" class="xl:hidden p-2 rounded-full text-on-surface hover:bg-surface-container" onclick="toggleMobileMenu()">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Collapsible Menu -->
        <div id="mobile-menu" class="hidden xl:hidden bg-surface-container-lowest border-b border-border-subtle px-6 py-4 space-y-2 shadow-lg">
            <a href="{{ route('beranda') }}" class="block px-4 py-2.5 rounded-DEFAULT font-label-md text-label-md {{ request()->routeIs('beranda') ? 'bg-amber-primary text-pure-white font-bold' : 'text-on-surface hover:bg-surface-container' }}">
                Beranda
            </a>
            <a href="{{ route('jadwal-salat') }}" class="block px-4 py-2.5 rounded-DEFAULT font-label-md text-label-md {{ request()->routeIs('jadwal-salat') ? 'bg-amber-primary text-pure-white font-bold' : 'text-on-surface hover:bg-surface-container' }}">
                Jadwal Salat & Kegiatan
            </a>
            <a href="{{ route('layanan-program') }}" class="block px-4 py-2.5 rounded-DEFAULT font-label-md text-label-md {{ request()->routeIs('layanan-program') ? 'bg-amber-primary text-pure-white font-bold' : 'text-on-surface hover:bg-surface-container' }}">
                Layanan & Program Unggulan
            </a>
            <a href="{{ route('sedekah') }}" class="block px-4 py-2.5 rounded-DEFAULT font-label-md text-label-md {{ request()->routeIs('sedekah') ? 'bg-amber-primary text-pure-white font-bold' : 'text-on-surface hover:bg-surface-container' }}">
                Sedekah & Transparansi Kas
            </a>
            <a href="{{ route('galeri') }}" class="block px-4 py-2.5 rounded-DEFAULT font-label-md text-label-md {{ request()->routeIs('galeri') ? 'bg-amber-primary text-pure-white font-bold' : 'text-on-surface hover:bg-surface-container' }}">
                Galeri & Dokumentasi
            </a>
            <a href="{{ route('pengurus') }}" class="block px-4 py-2.5 rounded-DEFAULT font-label-md text-label-md {{ request()->routeIs('pengurus') || request()->routeIs('profil') ? 'bg-amber-primary text-pure-white font-bold' : 'text-on-surface hover:bg-surface-container' }}">
                Pengurus & Profil Masjid
            </a>
            <a href="{{ route('kontak') }}" class="block px-4 py-2.5 rounded-DEFAULT font-label-md text-label-md {{ request()->routeIs('kontak') ? 'bg-amber-primary text-pure-white font-bold' : 'text-on-surface hover:bg-surface-container' }}">
                Kontak & Pengaduan
            </a>
            <div class="pt-2 border-t border-border-subtle">
                <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-DEFAULT text-secondary hover:bg-surface-container text-sm font-semibold">
                    <span class="material-symbols-outlined text-lg text-amber-primary">login</span>
                    <span>Portal Pengurus BKM</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="w-full pt-20 bg-surface flex-grow min-h-[calc(100vh-80px)]">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-6 lg:px-12 pt-6">
                <div class="p-4 rounded-DEFAULT bg-success/15 border border-success/30 text-success flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl">check_circle</span>
                        <p class="font-body-md text-body-md font-semibold">{{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-success hover:opacity-80">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Global Dark Footer -->
    <footer class="w-full bg-navy-deep text-pure-white mt-auto">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 pt-16 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 pb-12">
                <!-- Col 1: Identity & Location -->
                <div class="lg:col-span-4 flex flex-col space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-amber-primary flex items-center justify-center text-pure-white">
                            <span class="material-symbols-outlined text-2xl">mosque</span>
                        </div>
                        <span class="font-headline-sm text-headline-sm font-bold text-pure-white">Al-Fattah Ongkaw 3</span>
                    </div>
                    <p class="font-body-md text-body-md text-secondary-fixed-dim leading-relaxed">
                        Pusat ibadah, dakwah Islamiah, silaturahmi jamaah, dan pemberdayaan umat berkelanjutan di Desa Ongkaw 3, Kecamatan Sinonsayang, Kabupaten Minahasa Selatan, Sulawesi Utara.
                    </p>
                    <div class="flex items-start gap-2 pt-2 text-secondary-fixed-dim">
                        <span class="material-symbols-outlined text-amber-primary text-xl shrink-0 mt-0.5">location_on</span>
                        <span class="font-body-sm text-body-sm">Jl. Trans Sulawesi, Ongkaw 3, Sinonsayang, Minahasa Selatan (WITA)</span>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="lg:col-span-2 flex flex-col space-y-3">
                    <h4 class="font-headline-sm text-headline-sm text-pure-white font-semibold">Tautan Cepat</h4>
                    <nav class="flex flex-col space-y-2.5">
                        <a href="{{ route('beranda') }}" class="font-body-md text-body-md text-secondary-fixed-dim hover:text-amber-primary transition-colors">Beranda Utama</a>
                        <a href="{{ route('jadwal-salat') }}" class="font-body-md text-body-md text-secondary-fixed-dim hover:text-amber-primary transition-colors">Waktu Sholat & Imsak</a>
                        <a href="{{ route('layanan-program') }}" class="font-body-md text-body-md text-secondary-fixed-dim hover:text-amber-primary transition-colors">Layanan Ummat</a>
                        <a href="{{ route('sedekah') }}" class="font-body-md text-body-md text-secondary-fixed-dim hover:text-amber-primary transition-colors">Sedekah & Kas Terbuka</a>
                        <a href="{{ route('galeri') }}" class="font-body-md text-body-md text-secondary-fixed-dim hover:text-amber-primary transition-colors">Dokumentasi Acara</a>
                        <a href="{{ route('pengurus') }}" class="font-body-md text-body-md text-secondary-fixed-dim hover:text-amber-primary transition-colors">Profil Pengurus</a>
                        <a href="{{ route('kontak') }}" class="font-body-md text-body-md text-secondary-fixed-dim hover:text-amber-primary transition-colors">Kontak Aspirasi</a>
                    </nav>
                </div>

                <!-- Col 3: Routine Lectures -->
                <div class="lg:col-span-3 flex flex-col space-y-3">
                    <h4 class="font-headline-sm text-headline-sm text-pure-white font-semibold">Kajian Rutin</h4>
                    <div class="space-y-3">
                        <div class="bg-navy-card/60 p-3.5 rounded-DEFAULT shadow-[0_1px_4px_rgba(0,0,0,0.2)]">
                            <span class="font-label-md text-label-md text-amber-primary block font-semibold">Setiap Kamis Ba'da Maghrib</span>
                            <p class="font-body-sm text-body-sm text-pure-white font-medium">Kajian Fiqih Ibadah & Tafsir Tematik</p>
                        </div>
                        <div class="bg-navy-card/60 p-3.5 rounded-DEFAULT shadow-[0_1px_4px_rgba(0,0,0,0.2)]">
                            <span class="font-label-md text-label-md text-amber-primary block font-semibold">Ahad Pagi (06.00 WITA)</span>
                            <p class="font-body-sm text-body-sm text-pure-white font-medium">Kajian Subuh Berkah & Sarapan Ukhuwah</p>
                        </div>
                    </div>
                </div>

                <!-- Col 4: Bank Account & Bulletin -->
                <div class="lg:col-span-3 flex flex-col space-y-4">
                    <h4 class="font-headline-sm text-headline-sm text-pure-white font-semibold">Rekening Resmi Kas</h4>
                    <div class="bg-navy-card p-4 rounded-DEFAULT space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-label-md text-amber-primary font-semibold uppercase tracking-wider block">Bank Syariah Indonesia</span>
                            <span class="text-xs bg-amber-primary/20 text-amber-primary px-2 py-0.5 rounded-full font-bold">BSI</span>
                        </div>
                        <p class="font-body-md text-body-md font-bold text-pure-white tracking-wider">718-2938-192</p>
                        <p class="font-body-sm text-body-sm text-secondary-fixed-dim">a.n. BKM Al-Fattah Ongkaw 3</p>
                    </div>

                    <div class="bg-navy-card p-4 rounded-DEFAULT space-y-1">
                        <span class="font-label-md text-label-md text-amber-primary font-semibold uppercase tracking-wider block">Bank SulutGo</span>
                        <p class="font-body-md text-body-md font-bold text-pure-white tracking-wider">012-3456-789</p>
                        <p class="font-body-sm text-body-sm text-secondary-fixed-dim">a.n. Masjid Al-Fattah Ongkaw 3</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-8 border-t border-navy-card flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="font-body-sm text-body-sm text-secondary-fixed-dim text-center sm:text-left">
                    © 2026 Badan Kemakmuran Masjid (BKM) Al-Fattah Ongkaw 3. Seluruh hak cipta dilindungi undang-undang.
                </p>
                <div class="flex items-center gap-4 text-secondary-fixed-dim text-xs">
                    <span>Zona Waktu: WITA (UTC+8)</span>
                    <span>•</span>
                    <a href="{{ route('login') }}" class="hover:text-amber-primary transition-colors">Portal Pengurus</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Micro-interaction Scripts -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }

        // Live Clock in WITA
        function updateLiveWitaClock() {
            const clockElements = document.querySelectorAll('.live-clock-display');
            if (!clockElements.length) return;
            const now = new Date();
            // Offset to WITA UTC+8 if user timezone differs
            const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
            const witaTime = new Date(utc + (3600000 * 8));

            const hours = String(witaTime.getHours()).padStart(2, '0');
            const minutes = String(witaTime.getMinutes()).padStart(2, '0');
            const seconds = String(witaTime.getSeconds()).padStart(2, '0');
            const formatted = hours + ':' + minutes + ':' + seconds;

            clockElements.forEach(el => {
                el.textContent = formatted;
            });
        }
        setInterval(updateLiveWitaClock, 1000);
        updateLiveWitaClock();
    </script>
    @stack('scripts')
</body>
</html>
