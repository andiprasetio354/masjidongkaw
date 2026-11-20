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
    
    <!-- Top Sticky Header Container with Dynamic Micro-bar & Main Glassmorphic Navbar -->
    <header id="main-header" class="fixed top-0 w-full z-50 transition-all duration-300">
        <!-- Top Announcement & Live Time Micro-bar -->
        <div id="top-utility-bar" class="w-full bg-navy-deep text-pure-white/90 text-xs border-b border-navy-card/80 transition-all duration-300 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-1.5 flex items-center justify-between gap-4">
                <!-- Left: Status & Location -->
                <div class="flex items-center gap-2.5 truncate">
                    <span class="flex h-2 w-2 relative shrink-0">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="font-semibold text-pure-white truncate">Masjid Al-Fattah</span>
                    <span class="text-secondary-fixed-dim hidden sm:inline">• Ongkaw 3, Kec. Sinonsayang, Minahasa Selatan</span>
                    <span class="bg-emerald-500/15 text-emerald-400 border border-emerald-500/20 px-2 py-0.5 rounded-full text-[10px] font-bold tracking-wide hidden md:inline-flex items-center gap-1">
                        <span class="material-symbols-outlined text-[11px]">door_front</span>
                        Pintu Terbuka 24 Jam
                    </span>
                </div>

                <!-- Right: Live WITA Clock & Quick Links -->
                <div class="flex items-center gap-4 shrink-0 text-[11px]">
                    <div class="flex items-center gap-1.5 bg-navy-card/80 px-2.5 py-0.5 rounded-full border border-navy-accent/50 text-slate-300">
                        <span class="material-symbols-outlined text-[13px] text-amber-primary">schedule</span>
                        <span class="text-secondary-fixed-dim">WITA:</span>
                        <span class="live-clock-display font-mono font-bold text-amber-glow tabular-nums">--:--:--</span>
                    </div>

                    <div class="hidden sm:flex items-center gap-3 text-secondary-fixed-dim">
                        <a href="{{ route('jadwal-salat') }}" class="hover:text-amber-primary transition-colors flex items-center gap-1">
                            <span class="material-symbols-outlined text-[13px]">alarm</span>
                            <span>Jadwal Sholat Hari Ini</span>
                        </a>
                        <span>•</span>
                        <a href="{{ route('login') }}" class="hover:text-amber-primary transition-colors flex items-center gap-1">
                            <span class="material-symbols-outlined text-[13px]">lock</span>
                            <span>Portal BKM</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Glassmorphic Navigation Bar -->
        <nav id="main-navbar" class="w-full bg-surface/90 backdrop-blur-xl border-b border-border-subtle/80 shadow-[0_1px_10px_rgba(15,23,42,0.03)] transition-all duration-300">
            <div class="h-18 lg:h-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 flex items-center justify-between gap-4">
                <!-- Brand Logo & Identity with Hover Glow -->
                <a href="{{ route('beranda') }}" class="flex items-center gap-3 shrink-0 group" title="Beranda Masjid Al-Fattah Ongkaw 3">
                    <div class="w-10 h-10 lg:w-11 lg:h-11 rounded-full bg-gradient-to-tr from-amber-primary via-amber-hover to-amber-primary flex items-center justify-center text-pure-white shadow-md ring-2 ring-amber-primary/30 group-hover:ring-amber-primary/70 transition-all duration-300 group-hover:scale-105 shrink-0">
                        <span class="material-symbols-outlined text-2xl group-hover:rotate-6 transition-transform duration-300">mosque</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1.5">
                            <span class="font-headline-sm text-headline-sm text-navy-deep font-extrabold tracking-tight leading-tight group-hover:text-amber-primary transition-colors">Masjid Al-Fattah</span>
                            <span class="hidden sm:inline-block w-1.5 h-1.5 rounded-full bg-emerald-500" title="Sistem Aktif"></span>
                        </div>
                        <span class="font-body-sm text-xs text-on-surface-variant font-medium">Ongkaw 3, Minahasa Selatan</span>
                    </div>
                </a>

                <!-- Desktop Floating Pill Menu (Visible on lg & above) -->
                <nav class="hidden lg:flex items-center gap-1 bg-surface-container-low/80 backdrop-blur-md p-1.5 rounded-full border border-border-subtle/60 shadow-inner">
                    <a href="{{ route('beranda') }}" class="px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('beranda') ? 'bg-surface-container-lowest text-navy-deep font-bold shadow-sm ring-1 ring-border-subtle/50' : 'text-on-surface-variant hover:text-navy-deep hover:bg-surface-container/60' }}">
                        <span class="material-symbols-outlined text-[17px] {{ request()->routeIs('beranda') ? 'text-amber-primary' : 'text-secondary' }}">home</span>
                        <span>Beranda</span>
                        @if(request()->routeIs('beranda'))
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-primary"></span>
                        @endif
                    </a>

                    <a href="{{ route('jadwal-salat') }}" class="px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('jadwal-salat') ? 'bg-surface-container-lowest text-navy-deep font-bold shadow-sm ring-1 ring-border-subtle/50' : 'text-on-surface-variant hover:text-navy-deep hover:bg-surface-container/60' }}">
                        <span class="material-symbols-outlined text-[17px] {{ request()->routeIs('jadwal-salat') ? 'text-amber-primary' : 'text-secondary' }}">schedule</span>
                        <span>Jadwal Salat</span>
                        @if(request()->routeIs('jadwal-salat'))
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-primary"></span>
                        @endif
                    </a>

                    <a href="{{ route('layanan-program') }}" class="px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('layanan-program') ? 'bg-surface-container-lowest text-navy-deep font-bold shadow-sm ring-1 ring-border-subtle/50' : 'text-on-surface-variant hover:text-navy-deep hover:bg-surface-container/60' }}">
                        <span class="material-symbols-outlined text-[17px] {{ request()->routeIs('layanan-program') ? 'text-amber-primary' : 'text-secondary' }}">diversity_3</span>
                        <span>Program</span>
                        @if(request()->routeIs('layanan-program'))
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-primary"></span>
                        @endif
                    </a>

                    <a href="{{ route('sedekah') }}" class="px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('sedekah') ? 'bg-surface-container-lowest text-navy-deep font-bold shadow-sm ring-1 ring-border-subtle/50' : 'text-on-surface-variant hover:text-navy-deep hover:bg-surface-container/60' }}">
                        <span class="material-symbols-outlined text-[17px] {{ request()->routeIs('sedekah') ? 'text-amber-primary' : 'text-secondary' }}">volunteer_activism</span>
                        <span>Donasi & Kas</span>
                        <span class="text-[9px] bg-amber-primary/15 text-amber-primary font-extrabold px-1.5 py-0.5 rounded-full uppercase tracking-wider">Amanah</span>
                    </a>

                    <a href="{{ route('galeri') }}" class="px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('galeri') ? 'bg-surface-container-lowest text-navy-deep font-bold shadow-sm ring-1 ring-border-subtle/50' : 'text-on-surface-variant hover:text-navy-deep hover:bg-surface-container/60' }}">
                        <span class="material-symbols-outlined text-[17px] {{ request()->routeIs('galeri') ? 'text-amber-primary' : 'text-secondary' }}">photo_library</span>
                        <span>Galeri</span>
                        @if(request()->routeIs('galeri'))
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-primary"></span>
                        @endif
                    </a>

                    <a href="{{ route('pengurus') }}" class="px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('pengurus') || request()->routeIs('profil') ? 'bg-surface-container-lowest text-navy-deep font-bold shadow-sm ring-1 ring-border-subtle/50' : 'text-on-surface-variant hover:text-navy-deep hover:bg-surface-container/60' }}">
                        <span class="material-symbols-outlined text-[17px] {{ request()->routeIs('pengurus') || request()->routeIs('profil') ? 'text-amber-primary' : 'text-secondary' }}">groups</span>
                        <span>Profil</span>
                        @if(request()->routeIs('pengurus') || request()->routeIs('profil'))
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-primary"></span>
                        @endif
                    </a>

                    <a href="{{ route('kontak') }}" class="px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('kontak') ? 'bg-surface-container-lowest text-navy-deep font-bold shadow-sm ring-1 ring-border-subtle/50' : 'text-on-surface-variant hover:text-navy-deep hover:bg-surface-container/60' }}">
                        <span class="material-symbols-outlined text-[17px] {{ request()->routeIs('kontak') ? 'text-amber-primary' : 'text-secondary' }}">chat</span>
                        <span>Kontak</span>
                        @if(request()->routeIs('kontak'))
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-primary"></span>
                        @endif
                    </a>
                </nav>

                <!-- CTA Actions & Admin Shortcut -->
                <div class="flex items-center gap-2.5 sm:gap-3 shrink-0">
                    <!-- Shimmering Donasi Button -->
                    <a href="{{ route('sedekah') }}#form-donasi" class="inline-flex items-center justify-center px-4 sm:px-5 py-2 sm:py-2.5 rounded-full bg-gradient-to-r from-amber-primary to-amber-hover hover:from-amber-hover hover:to-amber-primary text-pure-white font-label-md text-xs sm:text-sm shadow-[0_4px_14px_rgba(245,158,11,0.35)] hover:shadow-[0_6px_20px_rgba(245,158,11,0.45)] transition-all transform hover:-translate-y-0.5 active:translate-y-0 gap-1.5 font-bold group">
                        <span class="material-symbols-outlined text-base sm:text-lg group-hover:scale-110 transition-transform">volunteer_activism</span>
                        <span>Donasi Sekarang</span>
                    </a>

                    @auth
                        <!-- Authenticated Admin Shortcut -->
                        <a href="{{ auth()->user()->canAccessContent() ? route('admin.konten.index') : route('admin.keuangan.index') }}" class="flex items-center gap-2 p-1.5 pr-3 rounded-full bg-surface-container hover:bg-surface-container-high border border-border-subtle transition-all duration-200" title="Buka Dashboard Admin ({{ auth()->user()->name }})">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-navy-deep text-amber-primary flex items-center justify-center text-xs font-bold ring-2 ring-amber-primary/30">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="text-xs font-bold text-navy-deep hidden md:inline">Dashboard</span>
                        </a>
                    @else
                        <!-- Guest Admin Login Icon Button -->
                        <a href="{{ route('login') }}" class="p-2 sm:p-2.5 rounded-full text-secondary hover:text-navy-deep hover:bg-surface-container border border-transparent hover:border-border-subtle transition-all duration-200 flex items-center justify-center" title="Masuk Portal Admin BKM">
                            <span class="material-symbols-outlined text-xl">admin_panel_settings</span>
                        </a>
                    @endauth

                    <!-- Mobile Hamburger Button with Dynamic Toggle Animation -->
                    <button type="button" id="mobile-menu-btn" class="lg:hidden p-2 rounded-full text-navy-deep hover:bg-surface-container border border-border-subtle/70 transition-colors flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-amber-primary/50" onclick="toggleMobileMenu()" aria-label="Buka Menu Navigasi" aria-expanded="false">
                        <span id="hamburger-icon" class="material-symbols-outlined text-2xl transition-transform duration-200">menu</span>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Dynamic Mobile Off-Canvas Drawer & Backdrop Overlay -->
    <div id="mobile-backdrop" class="fixed inset-0 bg-navy-deep/60 backdrop-blur-sm z-50 opacity-0 pointer-events-none transition-opacity duration-300" onclick="closeMobileMenu()" aria-hidden="true"></div>

    <aside id="mobile-drawer" class="fixed top-0 right-0 h-full w-[88%] max-w-sm bg-surface-container-lowest z-50 shadow-2xl transform translate-x-full transition-transform duration-300 ease-out flex flex-col justify-between overflow-y-auto border-l border-border-subtle" aria-label="Menu Navigasi Mobile">
        <div class="p-6 space-y-6">
            <!-- Drawer Brand & Close Button -->
            <div class="flex items-center justify-between pb-4 border-b border-border-subtle">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-primary to-amber-hover flex items-center justify-center text-pure-white shadow-md">
                        <span class="material-symbols-outlined text-xl">mosque</span>
                    </div>
                    <div>
                        <h3 class="font-headline-sm text-sm font-bold text-navy-deep leading-tight">Masjid Al-Fattah</h3>
                        <p class="text-[11px] text-secondary">Desa Ongkaw 3, Minahasa Selatan</p>
                    </div>
                </div>
                <button type="button" class="w-9 h-9 rounded-full bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-navy-deep transition-transform duration-200 hover:rotate-90" onclick="closeMobileMenu()" aria-label="Tutup Menu">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>

            <!-- Dynamic Mosque Live Clock Card -->
            <div class="p-4 rounded-xl bg-gradient-to-br from-navy-deep to-navy-card text-pure-white shadow-md relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-24 h-24 rounded-full bg-amber-primary/10 blur-xl pointer-events-none"></div>
                <div class="flex items-center justify-between text-xs text-amber-glow font-medium mb-1">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Waktu Resmi WITA (UTC+8)
                    </span>
                    <span class="text-[10px] bg-white/10 px-2 py-0.5 rounded-full">Sulut</span>
                </div>
                <div class="text-2xl font-mono font-bold text-pure-white tracking-wider tabular-nums live-clock-display py-1">--:--:--</div>
                <p class="text-[11px] text-secondary-fixed-dim flex items-center gap-1 mt-1">
                    <span class="material-symbols-outlined text-[13px] text-amber-primary">location_on</span>
                    Ongkaw 3, Kec. Sinonsayang
                </p>
            </div>

            <!-- Navigation Links List with Rich Icons -->
            <nav class="space-y-1.5">
                <a href="{{ route('beranda') }}" class="flex items-center justify-between p-3 rounded-xl transition-all {{ request()->routeIs('beranda') ? 'bg-amber-primary text-pure-white font-bold shadow-md' : 'text-on-surface hover:bg-surface-container' }}" onclick="closeMobileMenu()">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl {{ request()->routeIs('beranda') ? 'text-pure-white' : 'text-amber-primary' }}">home</span>
                        <div class="text-left">
                            <div class="text-sm font-semibold">Beranda</div>
                            <div class="text-[11px] {{ request()->routeIs('beranda') ? 'text-pure-white/80' : 'text-secondary' }}">Pusat informasi & kegiatan</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-base opacity-70">chevron_right</span>
                </a>

                <a href="{{ route('jadwal-salat') }}" class="flex items-center justify-between p-3 rounded-xl transition-all {{ request()->routeIs('jadwal-salat') ? 'bg-amber-primary text-pure-white font-bold shadow-md' : 'text-on-surface hover:bg-surface-container' }}" onclick="closeMobileMenu()">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl {{ request()->routeIs('jadwal-salat') ? 'text-pure-white' : 'text-amber-primary' }}">schedule</span>
                        <div class="text-left">
                            <div class="text-sm font-semibold">Jadwal Salat & Imsak</div>
                            <div class="text-[11px] {{ request()->routeIs('jadwal-salat') ? 'text-pure-white/80' : 'text-secondary' }}">5 waktu & petugas Jumat</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-base opacity-70">chevron_right</span>
                </a>

                <a href="{{ route('layanan-program') }}" class="flex items-center justify-between p-3 rounded-xl transition-all {{ request()->routeIs('layanan-program') ? 'bg-amber-primary text-pure-white font-bold shadow-md' : 'text-on-surface hover:bg-surface-container' }}" onclick="closeMobileMenu()">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl {{ request()->routeIs('layanan-program') ? 'text-pure-white' : 'text-amber-primary' }}">diversity_3</span>
                        <div class="text-left">
                            <div class="text-sm font-semibold">Layanan & Program</div>
                            <div class="text-[11px] {{ request()->routeIs('layanan-program') ? 'text-pure-white/80' : 'text-secondary' }}">Pemberdayaan & majelis taklim</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-base opacity-70">chevron_right</span>
                </a>

                <a href="{{ route('sedekah') }}" class="flex items-center justify-between p-3 rounded-xl transition-all {{ request()->routeIs('sedekah') ? 'bg-amber-primary text-pure-white font-bold shadow-md' : 'text-on-surface hover:bg-surface-container' }}" onclick="closeMobileMenu()">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl {{ request()->routeIs('sedekah') ? 'text-pure-white' : 'text-amber-primary' }}">volunteer_activism</span>
                        <div class="text-left">
                            <div class="text-sm font-semibold flex items-center gap-1.5">
                                <span>Donasi Shodaqoh</span>
                                <span class="text-[9px] bg-amber-glow text-amber-hover px-1.5 py-0.2 rounded font-bold uppercase">Kas Terbuka</span>
                            </div>
                            <div class="text-[11px] {{ request()->routeIs('sedekah') ? 'text-pure-white/80' : 'text-secondary' }}">Transparansi kas & rekening resmi</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-base opacity-70">chevron_right</span>
                </a>

                <a href="{{ route('galeri') }}" class="flex items-center justify-between p-3 rounded-xl transition-all {{ request()->routeIs('galeri') ? 'bg-amber-primary text-pure-white font-bold shadow-md' : 'text-on-surface hover:bg-surface-container' }}" onclick="closeMobileMenu()">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl {{ request()->routeIs('galeri') ? 'text-pure-white' : 'text-amber-primary' }}">photo_library</span>
                        <div class="text-left">
                            <div class="text-sm font-semibold">Galeri & Dokumentasi</div>
                            <div class="text-[11px] {{ request()->routeIs('galeri') ? 'text-pure-white/80' : 'text-secondary' }}">Foto kegiatan & syiar masjid</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-base opacity-70">chevron_right</span>
                </a>

                <a href="{{ route('pengurus') }}" class="flex items-center justify-between p-3 rounded-xl transition-all {{ request()->routeIs('pengurus') || request()->routeIs('profil') ? 'bg-amber-primary text-pure-white font-bold shadow-md' : 'text-on-surface hover:bg-surface-container' }}" onclick="closeMobileMenu()">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl {{ request()->routeIs('pengurus') || request()->routeIs('profil') ? 'text-pure-white' : 'text-amber-primary' }}">groups</span>
                        <div class="text-left">
                            <div class="text-sm font-semibold">Pengurus & Profil BKM</div>
                            <div class="text-[11px] {{ request()->routeIs('pengurus') || request()->routeIs('profil') ? 'text-pure-white/80' : 'text-secondary' }}">Struktur takmir & imam masjid</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-base opacity-70">chevron_right</span>
                </a>

                <a href="{{ route('kontak') }}" class="flex items-center justify-between p-3 rounded-xl transition-all {{ request()->routeIs('kontak') ? 'bg-amber-primary text-pure-white font-bold shadow-md' : 'text-on-surface hover:bg-surface-container' }}" onclick="closeMobileMenu()">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl {{ request()->routeIs('kontak') ? 'text-pure-white' : 'text-amber-primary' }}">chat</span>
                        <div class="text-left">
                            <div class="text-sm font-semibold">Kontak & Aspirasi</div>
                            <div class="text-[11px] {{ request()->routeIs('kontak') ? 'text-pure-white/80' : 'text-secondary' }}">Kirim pesan langsung ke takmir</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-base opacity-70">chevron_right</span>
                </a>
            </nav>
        </div>

        <!-- Drawer Footer Actions -->
        <div class="p-6 bg-surface-container border-t border-border-subtle space-y-3">
            <a href="{{ route('sedekah') }}#form-donasi" class="w-full flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-amber-primary to-amber-hover text-pure-white font-bold text-sm shadow-md hover:shadow-lg transition-all" onclick="closeMobileMenu()">
                <span class="material-symbols-outlined text-lg">volunteer_activism</span>
                <span>Infaq / Donasi Online</span>
            </a>

            <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-surface-container-lowest text-navy-deep border border-border-subtle text-xs font-semibold hover:bg-surface-container-high transition-colors" onclick="closeMobileMenu()">
                <span class="material-symbols-outlined text-base text-amber-primary">admin_panel_settings</span>
                <span>Portal Khusus Pengurus BKM</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Container with Adjusted Top Padding -->
    <main class="w-full pt-28 sm:pt-32 bg-surface flex-grow min-h-[calc(100vh-80px)]">
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

    <!-- Micro-interaction & Dynamic UI Scripts -->
    <script>
        // Mobile Drawer Controller
        const mobileDrawer = document.getElementById('mobile-drawer');
        const mobileBackdrop = document.getElementById('mobile-backdrop');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const hamburgerIcon = document.getElementById('hamburger-icon');

        function openMobileMenu() {
            if (!mobileDrawer || !mobileBackdrop) return;
            mobileDrawer.classList.remove('translate-x-full');
            mobileBackdrop.classList.remove('opacity-0', 'pointer-events-none');
            mobileBackdrop.classList.add('opacity-100');
            document.body.classList.add('overflow-hidden');
            if (mobileMenuBtn) mobileMenuBtn.setAttribute('aria-expanded', 'true');
            if (hamburgerIcon) hamburgerIcon.textContent = 'close';
        }

        function closeMobileMenu() {
            if (!mobileDrawer || !mobileBackdrop) return;
            mobileDrawer.classList.add('translate-x-full');
            mobileBackdrop.classList.remove('opacity-100');
            mobileBackdrop.classList.add('opacity-0', 'pointer-events-none');
            document.body.classList.remove('overflow-hidden');
            if (mobileMenuBtn) mobileMenuBtn.setAttribute('aria-expanded', 'false');
            if (hamburgerIcon) hamburgerIcon.textContent = 'menu';
        }

        function toggleMobileMenu() {
            if (!mobileDrawer) return;
            const isOpen = !mobileDrawer.classList.contains('translate-x-full');
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        }

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMobileMenu();
            }
        });

        // Dynamic Scroll Elevation for Header
        const topUtilityBar = document.getElementById('top-utility-bar');
        const mainNavbar = document.getElementById('main-navbar');

        function handleNavbarScroll() {
            const scrollY = window.scrollY || window.pageYOffset;
            if (scrollY > 35) {
                if (topUtilityBar) {
                    topUtilityBar.style.maxHeight = '0px';
                    topUtilityBar.style.opacity = '0';
                    topUtilityBar.style.paddingTop = '0px';
                    topUtilityBar.style.paddingBottom = '0px';
                }
                if (mainNavbar) {
                    mainNavbar.classList.add('shadow-lg', 'border-b', 'border-border-subtle', 'bg-surface/95');
                    mainNavbar.classList.remove('border-border-subtle/80', 'shadow-[0_1px_10px_rgba(15,23,42,0.03)]');
                }
            } else {
                if (topUtilityBar) {
                    topUtilityBar.style.maxHeight = '50px';
                    topUtilityBar.style.opacity = '1';
                    topUtilityBar.style.paddingTop = '';
                    topUtilityBar.style.paddingBottom = '';
                }
                if (mainNavbar) {
                    mainNavbar.classList.remove('shadow-lg', 'bg-surface/95');
                    mainNavbar.classList.add('border-border-subtle/80', 'shadow-[0_1px_10px_rgba(15,23,42,0.03)]');
                }
            }
        }

        window.addEventListener('scroll', handleNavbarScroll, { passive: true });
        handleNavbarScroll();

        // Live Clock in WITA (UTC+8)
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
