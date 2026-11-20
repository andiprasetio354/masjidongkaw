<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk Portal Admin - Masjid Al-Fattah Ongkaw 3</title>
    
    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface": "#f8f9ff",
                        "surface-dim": "#cbdbf5",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff4ff",
                        "surface-container": "#e5eeff",
                        "surface-container-high": "#dce9ff",
                        "on-surface": "#0b1c30",
                        "secondary": "#565e74",
                        "navy-deep": "#0F172A",
                        "navy-card": "#1E293B",
                        "navy-accent": "#334155",
                        "amber-primary": "#F59E0B",
                        "amber-hover": "#D97706",
                        "amber-glow": "#FEF3C7",
                        "pure-white": "#FFFFFF",
                        "border-subtle": "#E2E8F0",
                        "success": "#10B981",
                        "primary-fixed-dim": "#ffb95f",
                        "primary-fixed": "#ffddb8"
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    fontFamily: {
                        "arabic-display": ["Noto Serif", "serif"]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface font-sans text-on-surface antialiased min-h-screen flex flex-col justify-center items-center relative overflow-x-hidden p-4 sm:p-6">
    <!-- Subtle Background Dot Grid -->
    <div class="fixed inset-0 pointer-events-none opacity-40 bg-[radial-gradient(#dce9ff_1px,transparent_1px)] [background-size:24px_24px]"></div>

    <div class="w-full max-w-6xl mx-auto py-6 relative z-10">
        <!-- Top Back Link & Status Bar -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <a class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-surface-container-lowest text-on-surface shadow-sm hover:shadow-md hover:bg-surface-container text-sm font-semibold transition-all" href="{{ route('beranda') }}">
                <span class="material-symbols-outlined text-amber-primary">arrow_back</span>
                <span>Kembali ke Situs Publik Masjid Al-Fattah</span>
            </a>
            <div class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-high text-secondary text-xs font-semibold shadow-sm">
                <span class="w-2 h-2 rounded-full bg-success animate-pulse"></span>
                <span>Sistem Portal BKM: Normal & Terenkripsi</span>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-DEFAULT bg-red-100 border border-red-300 text-red-800 text-sm font-medium flex items-center gap-3">
                <span class="material-symbols-outlined text-xl">error</span>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if(session('warning'))
            <div class="mb-6 p-4 rounded-DEFAULT bg-amber-100 border border-amber-300 text-amber-900 text-sm font-medium flex items-center gap-3">
                <span class="material-symbols-outlined text-xl">warning</span>
                <span>{{ session('warning') }}</span>
            </div>
        @endif

        <!-- Main Split Bento Card -->
        <div class="grid grid-cols-1 lg:grid-cols-12 rounded-xl bg-surface-container-lowest shadow-2xl overflow-hidden">
            <!-- LEFT PANE: Institutional Dignity & Amanah Showcase (5 Cols) -->
            <div class="lg:col-span-5 bg-navy-deep text-pure-white p-8 sm:p-12 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -right-16 -bottom-16 w-80 h-80 rounded-full bg-amber-primary/10 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 space-y-8">
                    <!-- Header Identity Badge -->
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-navy-card text-primary-fixed-dim text-xs font-semibold shadow-inner">
                            <span class="material-symbols-outlined text-sm text-amber-primary">verified_user</span>
                            <span>Portal Resmi BKM 2024-2029</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-amber-primary to-amber-hover flex items-center justify-center shadow-lg text-pure-white">
                                <span class="material-symbols-outlined text-3xl">mosque</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold tracking-tight text-pure-white leading-tight">Masjid Al-Fattah</h2>
                                <p class="text-xs text-secondary-fixed-dim font-medium">Ongkaw 3, Kec. Sinonsayang, Minahasa Selatan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Spiritual Guidance & Amanah Quote -->
                    <div class="p-6 rounded-lg bg-navy-card/90 shadow-xl space-y-3 relative overflow-hidden border-l-4 border-amber-primary">
                        <p class="font-arabic-display text-xl text-primary-fixed-dim leading-relaxed text-right dir-rtl">
                            إِنَّ اللَّهَ يَأْمُرُكُمْ أَنْ تُؤَدُّوا الْأَمَانَاتِ إِلَىٰ أَهْلِهَا
                        </p>
                        <p class="text-sm text-surface-container italic">
                            "Sungguh, Allah menyuruhmu menyampaikan amanat kepada yang berhak menerimanya..."
                        </p>
                        <div class="flex items-center justify-between pt-2 text-xs">
                            <span class="text-primary-fixed uppercase tracking-wider font-bold">QS. An-Nisa: 58</span>
                            <span class="text-secondary-fixed-dim">Prinsip Amanah Digital</span>
                        </div>
                    </div>

                    <!-- Quick Fill Profile Buttons (Demo Assistance) -->
                    <div class="space-y-3">
                        <span class="text-xs text-secondary uppercase tracking-wider block font-bold">Bantuan Akses Cepat Demo</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <button class="flex flex-col items-start p-3 rounded-DEFAULT bg-navy-card hover:bg-navy-accent transition-all text-left group shadow-sm" onclick="quickFill('dakwah', 'humas@alfattah.id', 'BKM@Ongkaw3#2024')" type="button">
                                <div class="flex items-center gap-1.5 text-primary-fixed text-xs font-bold group-hover:text-amber-primary">
                                    <span class="material-symbols-outlined text-base">campaign</span>
                                    <span>Akun Humas / Dakwah</span>
                                </div>
                                <span class="text-secondary-fixed text-xs mt-0.5">humas@alfattah.id</span>
                            </button>

                            <button class="flex flex-col items-start p-3 rounded-DEFAULT bg-navy-card hover:bg-navy-accent transition-all text-left group shadow-sm" onclick="quickFill('keuangan', 'kasir@alfattah.id', 'BKM@Ongkaw3#2024')" type="button">
                                <div class="flex items-center gap-1.5 text-primary-fixed text-xs font-bold group-hover:text-amber-primary">
                                    <span class="material-symbols-outlined text-base">account_balance_wallet</span>
                                    <span>Akun Bendahara Kas</span>
                                </div>
                                <span class="text-secondary-fixed text-xs mt-0.5">kasir@alfattah.id</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Helpdesk Footer -->
                <div class="relative z-10 pt-8 mt-6 border-t border-navy-card">
                    <div class="flex items-center gap-3 p-3.5 rounded-DEFAULT bg-navy-card/60">
                        <span class="material-symbols-outlined text-amber-primary text-2xl">support_agent</span>
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-pure-white truncate">Kendala Akun Pengurus?</p>
                            <p class="text-xs text-secondary-fixed-dim truncate">H. Ismail Paputungan (+62 812-3456-7890)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT PANE: Modern Interactive Role-Based Auth Form (7 Cols) -->
            <div class="lg:col-span-7 p-8 sm:p-12 bg-surface-container-lowest flex flex-col justify-center">
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="inline-block w-8 h-1 rounded-full bg-amber-primary"></span>
                        <span class="text-xs uppercase tracking-wider text-amber-primary font-bold">Autentikasi Terpadu</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-on-surface tracking-tight">Masuk Portal Admin</h1>
                    <p class="text-sm text-secondary mt-1">
                        Silakan pilih modul wewenang Anda dan masukkan kredensial resmi BKM Masjid Al-Fattah.
                    </p>
                </div>

                <form class="space-y-6" id="loginForm" method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    
                    <!-- Role Selector: Segmented Pill Radio Cards -->
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface block">Pilih Bidang Amanah / Modul Dashboard</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5" role="radiogroup">
                            <!-- Role 1: Konten Dakwah -->
                            <label class="role-card relative flex flex-col p-3.5 rounded-DEFAULT cursor-pointer bg-surface-container transition-all hover:bg-surface-container-high shadow-sm select-none" onclick="updateRoleSelect('dakwah')">
                                <input checked class="sr-only" name="admin_role" type="radio" value="dakwah" id="role-dakwah"/>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="w-8 h-8 rounded-full bg-amber-glow text-amber-primary flex items-center justify-center">
                                        <span class="material-symbols-outlined text-lg">broadcast_on_home</span>
                                    </div>
                                    <span class="role-indicator w-3.5 h-3.5 rounded-full bg-amber-primary" id="ind-dakwah"></span>
                                </div>
                                <span class="text-sm font-bold text-on-surface">Konten & Syiar</span>
                                <span class="text-xs text-secondary leading-snug mt-1">Khatib, Buletin & Galeri</span>
                            </label>

                            <!-- Role 2: Keuangan & Kas -->
                            <label class="role-card relative flex flex-col p-3.5 rounded-DEFAULT cursor-pointer bg-surface-container transition-all hover:bg-surface-container-high shadow-sm select-none" onclick="updateRoleSelect('keuangan')">
                                <input class="sr-only" name="admin_role" type="radio" value="keuangan" id="role-keuangan"/>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="w-8 h-8 rounded-full bg-surface-container-high text-primary flex items-center justify-center">
                                        <span class="material-symbols-outlined text-lg">receipt_long</span>
                                    </div>
                                    <span class="role-indicator w-3.5 h-3.5 rounded-full bg-surface-dim" id="ind-keuangan"></span>
                                </div>
                                <span class="text-sm font-bold text-on-surface">Keuangan & Kas</span>
                                <span class="text-xs text-secondary leading-snug mt-1">Infaq, QRIS & Audit</span>
                            </label>

                            <!-- Role 3: Super Admin / BKM Lead -->
                            <label class="role-card relative flex flex-col p-3.5 rounded-DEFAULT cursor-pointer bg-surface-container transition-all hover:bg-surface-container-high shadow-sm select-none" onclick="updateRoleSelect('superadmin')">
                                <input class="sr-only" name="admin_role" type="radio" value="superadmin" id="role-superadmin"/>
                                <div class="flex items-center justify-between mb-2">
                                    <div class="w-8 h-8 rounded-full bg-surface-container-high text-navy-deep flex items-center justify-center">
                                        <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
                                    </div>
                                    <span class="role-indicator w-3.5 h-3.5 rounded-full bg-surface-dim" id="ind-superadmin"></span>
                                </div>
                                <span class="text-sm font-bold text-on-surface">Ketua BKM / IT</span>
                                <span class="text-xs text-secondary leading-snug mt-1">Akses Penuh Sistem</span>
                            </label>
                        </div>
                    </div>

                    <!-- Dynamic Role Notice Banner -->
                    <div class="p-3.5 rounded-DEFAULT bg-amber-glow/60 flex items-start gap-3" id="roleNotification">
                        <span class="material-symbols-outlined text-amber-primary mt-0.5 text-xl">info</span>
                        <p class="text-xs text-on-surface" id="roleNoticeText">
                            Anda memilih <strong>Dashboard Konten & Syiar</strong>: Mengelola jadwal shalat, khutbah Jumat, berita pengajian, serta galeri BKM.
                        </p>
                    </div>

                    <!-- Input Email / NIP -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-on-surface block" for="email">
                            ID Pengurus / Email Resmi BKM
                        </label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-secondary pointer-events-none">alternate_email</span>
                            <input class="w-full pl-12 pr-4 py-3 rounded-DEFAULT bg-surface-container-low text-on-surface text-sm outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-amber-primary transition-all" 
                                   id="email" name="email" placeholder="nama@alfattah.id atau NIP" required type="text" value="{{ old('email', 'humas@alfattah.id') }}"/>
                        </div>
                    </div>

                    <!-- Input Password with Visibility Toggle -->
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label class="text-xs font-bold text-on-surface block" for="password">
                                Kata Sandi Pengurus
                            </label>
                            <span class="text-xs text-amber-primary cursor-pointer hover:underline" onclick="alert('Untuk bantuan reset sandi, silakan hubungi Sekretariat BKM H. Ismail Paputungan (+62 812-3456-7890).')">
                                Lupa Sandi?
                            </span>
                        </div>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-secondary pointer-events-none">lock</span>
                            <input class="w-full pl-12 pr-12 py-3 rounded-DEFAULT bg-surface-container-low text-on-surface text-sm outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-amber-primary transition-all" 
                                   id="password" name="password" placeholder="••••••••••••" required type="password" value="BKM@Ongkaw3#2024"/>
                            <button class="absolute right-4 text-secondary hover:text-on-surface flex items-center justify-center p-1" onclick="togglePasswordVisibility()" type="button" title="Lihat/Sembunyikan Sandi">
                                <span class="material-symbols-outlined text-xl" id="eyeIcon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Security Status -->
                    <div class="flex flex-wrap items-center justify-between gap-3 pt-1">
                        <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                            <input checked class="w-4 h-4 rounded text-amber-primary accent-amber-primary cursor-pointer" id="remember" name="remember" type="checkbox"/>
                            <span class="text-xs text-secondary">Ingat saya di perangkat pengurus ini</span>
                        </label>
                        <div class="flex items-center gap-1 text-secondary text-xs">
                            <span class="material-symbols-outlined text-sm text-success">lock_clock</span>
                            <span>Sesi Aktif 8 Jam</span>
                        </div>
                    </div>

                    <!-- Primary Submit Button -->
                    <div class="pt-2">
                        <button class="w-full py-3.5 px-6 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white font-bold text-sm shadow-lg hover:shadow-xl flex items-center justify-center gap-2.5 transition-all transform hover:-translate-y-0.5 active:translate-y-0" id="submitButton" type="submit">
                            <span class="material-symbols-outlined text-xl">login</span>
                            <span id="btnSubmitText">Masuk ke Dashboard Konten & Syiar</span>
                        </button>
                    </div>

                    <!-- Trust Badges & Compliance Bar -->
                    <div class="pt-4 flex flex-wrap items-center justify-center gap-6 text-secondary text-xs font-medium border-t border-border-subtle">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-amber-primary">security</span>
                            <span>Enkripsi SSL 256-Bit</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base text-success">shield</span>
                            <span>RBAC Multi-Level Access</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts for Interactive UI -->
    <script>
        function updateRoleSelect(role) {
            document.getElementById('role-' + role).checked = true;
            
            const roles = ['dakwah', 'keuangan', 'superadmin'];
            roles.forEach(r => {
                const ind = document.getElementById('ind-' + r);
                if (r === role) {
                    ind.className = 'role-indicator w-3.5 h-3.5 rounded-full bg-amber-primary';
                } else {
                    ind.className = 'role-indicator w-3.5 h-3.5 rounded-full bg-surface-dim';
                }
            });

            const noticeText = document.getElementById('roleNoticeText');
            const submitText = document.getElementById('btnSubmitText');

            if (role === 'dakwah') {
                noticeText.innerHTML = 'Anda memilih <strong>Dashboard Konten & Syiar</strong>: Mengelola jadwal shalat, khutbah Jumat, berita pengajian, serta galeri BKM.';
                submitText.textContent = 'Masuk ke Dashboard Konten & Syiar';
            } else if (role === 'keuangan') {
                noticeText.innerHTML = 'Anda memilih <strong>Dashboard Keuangan & Kas</strong>: Verifikasi mutasi sedekah QRIS/BSI, pembukuan kas terbuka, dan laporan pertanggungjawaban.';
                submitText.textContent = 'Masuk ke Dashboard Keuangan & Kas';
            } else {
                noticeText.innerHTML = 'Anda memilih <strong>Ketua BKM / Super Admin</strong>: Akses penuh tata kelola dakwah, buku kas umum, dan konfigurasi sistem terpadu.';
                submitText.textContent = 'Masuk Portal Manajemen Penuh';
            }
        }

        function quickFill(role, email, pass) {
            updateRoleSelect(role);
            document.getElementById('email').value = email;
            document.getElementById('password').value = pass;
        }

        function togglePasswordVisibility() {
            const passInput = document.getElementById('password');
            const eye = document.getElementById('eyeIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eye.textContent = 'visibility_off';
            } else {
                passInput.type = 'password';
                eye.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
