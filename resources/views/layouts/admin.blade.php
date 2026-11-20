<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Dashboard BKM') - Masjid Al-Fattah Ongkaw 3</title>
    
    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Serif:wght@500;600&display=swap" rel="stylesheet"/>
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
<body class="bg-surface font-body-md text-on-surface antialiased">
    
    @php
        $user = auth()->user();
        $isKonten = request()->is('admin/konten*');
        $isKeuangan = request()->is('admin/keuangan*');
        $unreadMessagesCount = \App\Models\InboxMessage::where('is_read', false)->count();
        $pendingDonationsCount = \App\Models\Donation::where('status', 'pending')->count();
    @endphp

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="admin-sidebar-backdrop" class="fixed inset-0 bg-navy-deep/60 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300" onclick="toggleAdminSidebar()" aria-hidden="true"></div>

    <!-- Responsive Sidebar (Midnight Navy #0F172A) with Smooth Mobile Drawer Support -->
    <aside id="admin-sidebar" class="fixed left-0 top-0 h-full w-72 bg-navy-deep z-50 flex flex-col justify-between shadow-2xl transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 border-r border-navy-card">
        <div class="flex flex-col h-full overflow-hidden">
            <!-- Brand Header -->
            <div class="px-6 pt-6 pb-4 flex items-center justify-between bg-navy-deep border-b border-navy-card/60">
                <a href="{{ $isKonten ? route('admin.konten.index') : route('admin.keuangan.index') }}" class="flex items-center gap-3 min-w-0 group">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-primary to-amber-hover flex items-center justify-center text-pure-white shrink-0 shadow-md ring-2 ring-amber-primary/30 group-hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-[22px]">mosque</span>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-headline-sm text-sm text-pure-white truncate font-extrabold tracking-tight">Al-Fattah Ongkaw 3</span>
                        <span class="text-[11px] text-amber-glow font-medium truncate flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            {{ $isKonten ? 'Humas & Dakwah' : 'Bendahara & Kas' }}
                        </span>
                    </div>
                </a>

                <!-- Mobile Close Button -->
                <button type="button" class="lg:hidden p-1.5 rounded-full text-secondary-fixed-dim hover:text-pure-white hover:bg-navy-accent transition-colors" onclick="toggleAdminSidebar()" aria-label="Tutup Menu Admin">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>

            <!-- Role Badge & Switch Module Bar -->
            <div class="px-5 py-3">
                <div class="p-2 rounded-xl bg-navy-card/90 border border-navy-accent/40 flex items-center justify-between gap-2 shadow-inner">
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="flex h-2 w-2 relative shrink-0">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-xs text-pure-white font-semibold truncate">
                            {{ $isKonten ? 'Portal Humas BKM' : 'Portal Kas Bendahara' }}
                        </span>
                    </div>

                    @if($user && $user->isSuperAdmin())
                        <a href="{{ $isKonten ? route('admin.keuangan.index') : route('admin.konten.index') }}" 
                           class="text-[11px] font-bold px-2.5 py-1 rounded-lg bg-surface-container text-navy-deep hover:bg-amber-primary hover:text-pure-white transition-all duration-200 shrink-0 flex items-center gap-1 shadow-sm" 
                           title="Beralih ke {{ $isKonten ? 'Modul Keuangan' : 'Modul Konten' }}">
                            <span class="material-symbols-outlined text-[13px]">sync_alt</span>
                            <span>{{ $isKonten ? 'Keuangan' : 'Konten' }}</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-3 space-y-1 overflow-y-auto custom-scrollbar">
                @if($isKonten)
                    <!-- KONTEN MENU -->
                    <div class="px-3 pt-2 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Ringkasan Utama</div>

                    <a href="{{ route('admin.konten.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.konten.index') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.konten.index') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">dashboard</span>
                        <span class="text-xs truncate font-medium">Dashboard Syiar</span>
                    </a>

                    <div class="px-3 pt-3 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Jadwal & Agenda Dakwah</div>

                    <a href="{{ route('admin.konten.jadwal') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.konten.jadwal') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.konten.jadwal') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">schedule</span>
                        <span class="text-xs truncate font-medium">Jadwal Salat & Petugas</span>
                    </a>

                    <a href="{{ route('admin.konten.agendas') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.konten.agendas') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.konten.agendas') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">event</span>
                        <span class="text-xs truncate font-medium">Agenda & Majelis Dakwah</span>
                    </a>

                    <div class="px-3 pt-3 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Publikasi & Media</div>

                    <a href="{{ route('admin.konten.berita') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.konten.berita') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.konten.berita') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">campaign</span>
                        <span class="text-xs truncate font-medium">Berita & Pengumuman BKM</span>
                    </a>

                    <a href="{{ route('admin.konten.galeri') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.konten.galeri') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.konten.galeri') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">photo_library</span>
                        <span class="text-xs truncate font-medium">Galeri Dokumentasi</span>
                    </a>

                    <a href="{{ route('admin.konten.pengurus') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.konten.pengurus') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.konten.pengurus') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">groups</span>
                        <span class="text-xs truncate font-medium">Susunan Pengurus BKM</span>
                    </a>

                    <div class="px-3 pt-3 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Layanan & Pengaturan</div>

                    <a href="{{ route('admin.konten.pesan') }}" 
                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.konten.pesan') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.konten.pesan') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">forum</span>
                            <span class="text-xs truncate font-medium">Pesan & Layanan Aspirasi</span>
                        </div>
                        @if($unreadMessagesCount > 0)
                            <span class="px-2 py-0.5 rounded-full bg-red-500 text-pure-white text-[10px] font-bold shadow-sm animate-pulse">{{ $unreadMessagesCount }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.konten.pengaturan') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.konten.pengaturan') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.konten.pengaturan') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">settings_suggest</span>
                        <span class="text-xs truncate font-medium">Display TV & Pengaturan</span>
                    </a>
                @else
                    <!-- KEUANGAN MENU -->
                    <div class="px-3 pt-2 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Ringkasan Kas</div>

                    <a href="{{ route('admin.keuangan.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.keuangan.index') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.keuangan.index') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">account_balance_wallet</span>
                        <span class="text-xs truncate font-medium">Dashboard Keuangan</span>
                    </a>

                    <div class="px-3 pt-3 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Verifikasi & Mutasi Kas</div>

                    <a href="{{ route('admin.keuangan.verifikasi') }}" 
                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.keuangan.verifikasi') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.keuangan.verifikasi') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">approval</span>
                            <span class="text-xs truncate font-medium">Verifikasi Donasi</span>
                        </div>
                        @if($pendingDonationsCount > 0)
                            <span class="px-2 py-0.5 rounded-full bg-amber-primary text-navy-deep text-[10px] font-extrabold shadow-sm animate-pulse">{{ $pendingDonationsCount }} Baru</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.keuangan.buku-kas') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.keuangan.buku-kas') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.keuangan.buku-kas') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">receipt_long</span>
                        <span class="text-xs truncate font-medium">Buku Kas & Pengeluaran</span>
                    </a>

                    <a href="{{ route('admin.keuangan.programs') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.keuangan.programs') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.keuangan.programs') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">volunteer_activism</span>
                        <span class="text-xs truncate font-medium">Program Infaq & Capaian</span>
                    </a>

                    <div class="px-3 pt-3 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Saluran & Laporan</div>

                    <a href="{{ route('admin.keuangan.rekening') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.keuangan.rekening') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.keuangan.rekening') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">qr_code_2</span>
                        <span class="text-xs truncate font-medium">Rekening Bank & QRIS</span>
                    </a>

                    <a href="{{ route('admin.keuangan.telegram') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.keuangan.telegram') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.keuangan.telegram') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">smart_toy</span>
                        <span class="text-xs truncate font-medium">Integrasi Bot Telegram</span>
                    </a>

                    <a href="{{ route('admin.keuangan.laporan') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.keuangan.laporan') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.keuangan.laporan') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">assessment</span>
                        <span class="text-xs truncate font-medium">Laporan & Audit Publik</span>
                    </a>

                    <a href="{{ route('admin.keuangan.audit-log') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.keuangan.audit-log') ? 'bg-gradient-to-r from-amber-primary/25 via-amber-primary/10 to-transparent text-amber-glow font-bold border-l-4 border-amber-primary shadow-sm translate-x-1' : 'text-slate-300 hover:bg-navy-accent/70 hover:text-pure-white hover:translate-x-1' }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('admin.keuangan.audit-log') ? 'text-amber-primary' : 'text-slate-400 group-hover:text-amber-primary' }}">history_edu</span>
                        <span class="text-xs truncate font-medium">Log Audit Transaksi</span>
                    </a>
                @endif
            </nav>

            <!-- User Footer Card -->
            <div class="p-3.5 m-3 rounded-2xl bg-navy-card/90 border border-navy-accent/40 flex items-center justify-between gap-2 shadow-inner">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-amber-primary to-amber-hover flex items-center justify-center text-pure-white font-bold text-sm shrink-0 shadow-md ring-2 ring-amber-primary/30">
                        {{ substr($user->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-xs text-pure-white truncate font-bold">{{ $user->name ?? 'Pengurus' }}</span>
                        <span class="text-[11px] text-amber-glow truncate">{{ $user->title ?? 'BKM Al-Fattah' }}</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                    @csrf
                    <button type="submit" class="p-1.5 text-slate-400 hover:text-pure-white hover:bg-red-500/20 hover:text-red-400 rounded-lg transition-colors" title="Keluar dari Portal">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Workspace Pane (with responsive left padding) -->
    <div class="pl-0 lg:pl-72 flex flex-col min-h-screen transition-all duration-300">
        <!-- Top Sticky Header Bar -->
        <header class="fixed top-0 left-0 lg:left-72 right-0 h-16 bg-surface/90 backdrop-blur-xl border-b border-border-subtle/80 shadow-[0_1px_8px_rgba(0,0,0,0.03)] z-30 flex items-center justify-between px-4 sm:px-8 transition-all duration-300">
            <!-- Left: Mobile Toggle & Breadcrumbs -->
            <div class="flex items-center gap-3 min-w-0">
                <!-- Hamburger Button for Mobile / Tablet -->
                <button type="button" class="lg:hidden p-2 rounded-xl text-navy-deep hover:bg-surface-container border border-border-subtle transition-colors flex items-center justify-center" onclick="toggleAdminSidebar()" aria-label="Buka Menu Admin">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>

                <!-- Breadcrumbs -->
                <nav class="flex items-center gap-1.5 text-secondary font-label-md text-xs sm:text-sm truncate">
                    <a href="{{ $isKonten ? route('admin.konten.index') : route('admin.keuangan.index') }}" class="hover:text-on-surface transition-colors flex items-center gap-1 text-slate-500">
                        <span class="material-symbols-outlined text-[16px]">dashboard</span>
                        <span class="hidden sm:inline">Admin</span>
                    </a>
                    <span class="material-symbols-outlined text-[14px] text-slate-400">chevron_right</span>
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold {{ $isKonten ? 'bg-teal-500/10 text-teal-700' : 'bg-amber-500/10 text-amber-700' }}">
                        {{ $isKonten ? 'Konten & Syiar' : 'Keuangan & Kas' }}
                    </span>
                    <span class="material-symbols-outlined text-[14px] text-slate-400 hidden sm:inline">chevron_right</span>
                    <span class="text-on-surface font-extrabold truncate hidden sm:inline">@yield('page_title', 'Ringkasan')</span>
                </nav>
            </div>

            <!-- Right: Dynamic Telemetry, Clock, Shortcut & Profile -->
            <div class="flex items-center gap-2 sm:gap-4 shrink-0">
                <!-- Dynamic Live WITA Clock Pill -->
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-surface-container border border-border-subtle text-xs text-navy-deep shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="font-semibold text-slate-500">WITA:</span>
                    <span id="live-clock" class="font-mono font-bold text-navy-deep tabular-nums">--:--:--</span>
                </div>

                <!-- Shortcut to Public Site -->
                <a href="{{ route('beranda') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-surface-container hover:bg-surface-container-high text-navy-deep text-xs font-semibold border border-border-subtle transition-all duration-200" title="Buka Situs Publik Masjid di Tab Baru">
                    <span class="material-symbols-outlined text-[16px] text-amber-primary">open_in_new</span>
                    <span class="hidden md:inline">Situs Publik</span>
                </a>

                @if($isKonten)
                    <a href="{{ route('admin.konten.jadwal') }}" class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-amber-primary to-amber-hover text-pure-white text-xs font-bold shadow-sm transition-all hover:shadow-md">
                        <span class="material-symbols-outlined text-[16px]">tv</span>
                        <span>Display TV</span>
                    </a>
                @else
                    <a href="{{ route('admin.keuangan.verifikasi') }}" class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-amber-primary to-amber-hover text-pure-white text-xs font-bold shadow-sm transition-all hover:shadow-md">
                        <span class="material-symbols-outlined text-[16px]">verified</span>
                        <span>Verifikasi Donasi</span>
                        @if($pendingDonationsCount > 0)
                            <span class="bg-pure-white text-amber-hover text-[10px] px-1.5 py-0.2 rounded-full font-extrabold">{{ $pendingDonationsCount }}</span>
                        @endif
                    </a>
                @endif

                <div class="h-5 w-px bg-border-subtle hidden sm:block"></div>

                <!-- User Avatar Pill -->
                <div class="flex items-center gap-2 pl-1">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-amber-primary to-amber-hover text-pure-white flex items-center justify-center font-bold text-xs shadow-sm ring-2 ring-amber-primary/30" title="{{ $user->name ?? 'Pengurus' }}">
                        {{ substr($user->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="w-full pt-16 bg-surface flex-grow p-4 sm:p-8">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-DEFAULT bg-success/15 border border-success/30 text-success flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl">check_circle</span>
                        <p class="font-body-md text-body-md font-semibold">{{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-success hover:opacity-80">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            @endif

            @if(session('info'))
                <div class="mb-6 p-4 rounded-DEFAULT bg-tertiary-container/30 border border-tertiary/30 text-tertiary flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl">info</span>
                        <p class="font-body-md text-body-md font-semibold">{{ session('info') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-tertiary hover:opacity-80">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Dynamic Admin Sidebar & Live Clock Scripts -->
    <script>
        // Mobile Sidebar Toggle
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('admin-sidebar-backdrop');
            if (!sidebar || !backdrop) return;

            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
                document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('opacity-0');
                setTimeout(() => backdrop.classList.add('hidden'), 300);
                document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
            }
        }

        // Close sidebar on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('admin-sidebar');
                if (sidebar && !sidebar.classList.contains('-translate-x-full') && window.innerWidth < 1024) {
                    toggleAdminSidebar();
                }
            }
        });

        // Live Clock Script in WITA
        function updateLiveWitaClock() {
            const clockElements = document.querySelectorAll('#live-clock');
            if (!clockElements.length) return;
            const now = new Date();
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
