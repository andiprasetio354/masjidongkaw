@extends('layouts.admin')

@section('title', 'Dashboard Admin Keuangan & Kas BKM')

@section('content')
<div class="space-y-6">
    <!-- Header & Action Buttons -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Dashboard Keuangan & Kas Masjid</h1>
            <p class="text-xs text-secondary mt-0.5">
                Buku kas digital, verifikasi sedekah online, rekening BSI / SulutGo, dan laporan transparansi jamaah.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <button onclick="document.getElementById('modal-infaq-masuk').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-success hover:bg-emerald-600 text-pure-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all">
                <span class="material-symbols-outlined text-base">add_circle</span> + Catat Infaq Masuk
            </button>
            <button onclick="document.getElementById('modal-pengeluaran').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-navy-card hover:bg-navy-accent text-pure-white text-xs font-semibold flex items-center gap-1.5 transition-all">
                <span class="material-symbols-outlined text-base">outbox</span> + Catat Pengeluaran
            </button>
            <a href="{{ route('admin.keuangan.laporan') }}" class="px-3.5 py-2 rounded-full bg-surface-container hover:bg-surface-container-high text-navy-deep text-xs font-semibold flex items-center gap-1.5 transition-all">
                <span class="material-symbols-outlined text-base text-primary">print</span> Laporan Kas
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('info'))
        <div class="p-4 rounded-DEFAULT bg-surface-container-low border border-surface-container flex items-center gap-3 text-secondary shadow-sm">
            <span class="material-symbols-outlined text-secondary">info</span>
            <span class="text-xs font-semibold">{{ session('info') }}</span>
        </div>
    @endif

    <!-- 4 Financial KPI Metric Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Saldo Kas Terjaga -->
        <div class="bg-navy-card text-pure-white rounded-DEFAULT p-5 shadow-lg flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-secondary-fixed-dim uppercase tracking-wider">Saldo Kas Gabungan</span>
                <span class="material-symbols-outlined text-amber-primary text-xl">account_balance</span>
            </div>
            <div class="my-3">
                <div class="text-2xl font-extrabold text-pure-white">Rp{{ number_format($saldoKas, 0, ',', '.') }}</div>
                <span class="text-[10px] text-amber-glow font-medium flex items-center gap-1 mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-success"></span> Terverifikasi & Diaudit
                </span>
            </div>
            <div class="pt-2 border-t border-white/10 text-[10px] text-secondary-fixed-dim space-y-0.5">
                <div class="flex justify-between"><span>BSI Syariah:</span> <strong class="text-pure-white">Rp{{ number_format($kasBsi, 0, ',', '.') }}</strong></div>
                <div class="flex justify-between"><span>Bank SulutGo:</span> <strong class="text-pure-white">Rp{{ number_format($kasSulutgo, 0, ',', '.') }}</strong></div>
                <div class="flex justify-between"><span>Tunai Brankas:</span> <strong class="text-pure-white">Rp{{ number_format($kasTunai, 0, ',', '.') }}</strong></div>
            </div>
        </div>

        <!-- Card 2: Infaq Masuk Bulan Ini -->
        <div class="bg-surface-container-lowest rounded-DEFAULT p-5 shadow-sm border border-surface-container flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-secondary uppercase tracking-wider">Infaq Masuk Bulan Ini</span>
                <span class="material-symbols-outlined text-amber-primary text-xl">savings</span>
            </div>
            <div class="my-3">
                <div class="text-2xl font-bold text-navy-deep">Rp{{ number_format($infaqBulanIni, 0, ',', '.') }}</div>
                <span class="text-[11px] text-success font-semibold flex items-center gap-1 mt-0.5">
                    <span class="material-symbols-outlined text-xs">trending_up</span> Real-time Kas Masuk
                </span>
            </div>
            <div class="pt-2 border-t border-surface-container-low text-[11px] text-secondary flex justify-between">
                <span>Periode:</span>
                <strong class="text-navy-deep">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</strong>
            </div>
        </div>

        <!-- Card 3: Penyaluran Kas -->
        <div class="bg-surface-container-lowest rounded-DEFAULT p-5 shadow-sm border border-surface-container flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-secondary uppercase tracking-wider">Penyaluran & Operasional</span>
                <span class="material-symbols-outlined text-tertiary text-xl">outbox</span>
            </div>
            <div class="my-3">
                <div class="text-2xl font-bold text-navy-deep">Rp{{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</div>
                <span class="text-[11px] text-secondary font-medium flex items-center gap-1 mt-0.5">
                    <span class="material-symbols-outlined text-xs">check_circle</span> Realisasi Program Ummat
                </span>
            </div>
            <div class="pt-2 border-t border-surface-container-low text-[11px] text-secondary flex justify-between">
                <span>Rasio Serapan:</span>
                <strong class="text-tertiary">65.2%</strong>
            </div>
        </div>

        <!-- Card 4: Antrean Verifikasi -->
        <div class="bg-amber-glow/50 rounded-DEFAULT p-5 shadow-sm border border-amber-primary/40 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-on-primary-container uppercase tracking-wider">Antrean Verifikasi</span>
                <span class="material-symbols-outlined text-amber-primary text-xl">pending_actions</span>
            </div>
            <div class="my-3">
                <div class="text-2xl font-extrabold text-navy-deep">{{ $pendingCount }} Donasi</div>
                <span class="text-[11px] text-amber-hover font-bold flex items-center gap-1 mt-0.5">
                    <span class="w-2 h-2 rounded-full bg-amber-primary animate-ping"></span> Menunggu Validasi Slip
                </span>
            </div>
            <div class="pt-2 border-t border-amber-primary/20 text-[11px] flex justify-between">
                <span class="text-on-surface-variant">Tindakan Cepat:</span>
                <a href="{{ route('admin.keuangan.verifikasi') }}" class="font-bold text-primary hover:underline">Periksa Antrean →</a>
            </div>
        </div>
    </div>

    <!-- Main Content Layout (8 Cols + 4 Cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- LEFT PANEL (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            <!-- ANTREAN VERIFIKASI DONASI MASUK -->
            <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-surface-container-low pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-primary text-xl">verified_user</span>
                        <h2 class="text-base font-bold text-navy-deep">Antrean Verifikasi Donasi Masuk</h2>
                    </div>
                    <span class="text-xs text-secondary">Sinkronisasi Realtime dengan Form Website</span>
                </div>

                <div class="space-y-3">
                    @forelse($pendingDonations as $don)
                        <div class="p-4 rounded-DEFAULT bg-surface-container-low flex flex-col md:flex-row md:items-center justify-between gap-3">
                            <div class="space-y-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-sm font-bold text-navy-deep">{{ $don->display_name }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-surface-container-high text-navy-accent uppercase">
                                        {{ str_replace('_', ' ', $don->payment_method) }}
                                    </span>
                                    <span class="text-[11px] text-secondary font-mono">{{ $don->reference_code }}</span>
                                </div>
                                <p class="text-xs text-secondary">
                                    Alokasi: <span class="font-semibold text-primary">{{ $don->program ? $don->program->title : 'Sedekah Umum' }}</span>
                                    • {{ $don->created_at->diffForHumans() }}
                                </p>
                                @if($don->donor_prayer)
                                    <p class="text-[11px] text-on-surface-variant italic truncate max-w-md">"{{ $don->donor_prayer }}"</p>
                                @endif
                            </div>

                            <div class="flex flex-col md:items-end justify-between gap-2 shrink-0">
                                <span class="text-lg font-bold text-navy-deep">Rp{{ number_format($don->amount, 0, ',', '.') }}</span>
                                <div class="flex items-center gap-1.5">
                                    @if($don->proof_image_path)
                                        <button type="button" onclick="previewSlip('{{ $don->proof_image_path }}', '{{ $don->display_name }}', '{{ $don->reference_code }}', 'Rp{{ number_format($don->amount, 0, ',', '.') }}')" class="px-2.5 py-1 rounded bg-surface-container-lowest hover:bg-surface-container text-navy-deep text-xs font-semibold shadow-sm flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">visibility</span> Bukti
                                        </button>
                                    @endif

                                    <!-- Reject Form -->
                                    <form action="{{ route('admin.keuangan.verifikasi.action', $don->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak donasi ini?')">
                                        @csrf
                                        <input type="hidden" name="action" value="reject"/>
                                        <button type="submit" class="px-2.5 py-1 rounded bg-surface-container-high hover:bg-error-container hover:text-error text-secondary text-xs font-semibold transition-colors">
                                            Tolak
                                        </button>
                                    </form>

                                    <!-- Verify Form -->
                                    <form action="{{ route('admin.keuangan.verifikasi.action', $don->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="action" value="verify"/>
                                        <button type="submit" class="px-3 py-1 rounded-full bg-success text-pure-white hover:bg-emerald-600 text-xs font-bold transition-all shadow-sm flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">check_circle</span> Verifikasi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-xs text-secondary bg-surface-container-lowest rounded">
                            <span class="material-symbols-outlined text-3xl text-success mb-1">done_all</span>
                            <p class="font-semibold text-navy-deep">Semua donasi telah diverifikasi!</p>
                            <p class="text-[11px] text-secondary mt-0.5">Tidak ada transaksi yang tertahan dalam antrean.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- BUKU KAS DIGITAL: MUTASI TERKINI -->
            <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-surface-container-low pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-primary text-xl">account_balance_wallet</span>
                        <h2 class="text-base font-bold text-navy-deep">Buku Kas Digital (Mutasi Terakhir)</h2>
                    </div>
                    <a href="{{ route('admin.keuangan.buku-kas') }}" class="text-xs font-semibold text-primary hover:text-amber-hover flex items-center gap-1">
                        Buka Buku Kas Lengkap <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-surface-container-high/40 text-on-surface-variant uppercase tracking-wider">
                            <tr>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Kode Transaksi</th>
                                <th class="py-3 px-4">Keterangan / Pos</th>
                                <th class="py-3 px-4">Akun</th>
                                <th class="py-3 px-4 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-low text-navy-deep">
                            @foreach($recentMutations as $mut)
                                <tr class="hover:bg-surface-container-low/40 transition-colors">
                                    <td class="py-3 px-4 text-secondary font-mono">{{ \Carbon\Carbon::parse($mut->transaction_date)->format('d/m/Y') }}</td>
                                    <td class="py-3 px-4 font-mono font-semibold">{{ $mut->transaction_code }}</td>
                                    <td class="py-3 px-4">{{ $mut->description }}</td>
                                    <td class="py-3 px-4 text-secondary uppercase">{{ $mut->source_account ?? 'BSI' }}</td>
                                    <td class="py-3 px-4 text-right font-mono font-bold {{ $mut->type === 'masuk' ? 'text-success' : 'text-error' }}">
                                        {{ $mut->type === 'masuk' ? '+' : '-' }} Rp{{ number_format($mut->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- WIDGET 1: Integrasi Bot Telegram -->
            <div class="bg-surface-container-lowest rounded-DEFAULT p-5 shadow-sm space-y-3 border-t-4 border-amber-primary">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-primary text-xl">send</span>
                        <h3 class="text-sm font-bold text-navy-deep">Bot Telegram Sedekah</h3>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-success/20 text-success text-[10px] font-bold">Aktif</span>
                </div>
                <p class="text-xs text-secondary">
                    Alert instan dikirimkan ke HP Bendahara & Ketua BKM setiap kali jamaah mengisi form sedekah di website.
                </p>
                <div class="p-2.5 rounded bg-surface-container-low text-xs space-y-1 font-mono">
                    <div class="text-navy-deep font-semibold">@AlFattahOngkawBot</div>
                    <div class="text-secondary text-[11px]">Token: 7928***...alfattah</div>
                </div>
                <div class="flex items-center gap-2 pt-1">
                    <a href="{{ route('admin.keuangan.telegram') }}" class="w-full py-2 rounded-full bg-navy-card hover:bg-navy-accent text-pure-white text-xs font-semibold text-center transition-colors">
                        Pengaturan & Test Ping
                    </a>
                </div>
            </div>

            <!-- WIDGET 2: Rekening & QRIS BKM -->
            <div class="bg-surface-container-lowest rounded-DEFAULT p-5 shadow-sm space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-xl">credit_card</span>
                        <h3 class="text-sm font-bold text-navy-deep">Rekening Resmi BKM</h3>
                    </div>
                    <a href="{{ route('admin.keuangan.rekening') }}" class="text-xs text-primary font-bold hover:underline">Edit</a>
                </div>
                <div class="space-y-2 text-xs">
                    <div class="p-2.5 rounded bg-surface-container-low">
                        <span class="text-secondary block text-[10px]">Bank Syariah Indonesia (BSI)</span>
                        <span class="font-bold text-navy-deep font-mono">718-2938-192</span>
                        <span class="text-[11px] text-secondary block">a.n. BKM Al-Fattah Ongkaw</span>
                    </div>
                    <div class="p-2.5 rounded bg-surface-container-low">
                        <span class="text-secondary block text-[10px]">Bank SulutGo</span>
                        <span class="font-bold text-navy-deep font-mono">004-02-11-009283-4</span>
                        <span class="text-[11px] text-secondary block">a.n. Panitia Pembangunan Al-Fattah</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL 1: Catat Infaq Masuk Manual -->
    <div id="modal-infaq-masuk" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-infaq-masuk').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-lg font-bold text-navy-deep mb-4">Pencatatan Infaq / Penerimaan Kas</h3>
            <form action="{{ route('admin.keuangan.kas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <input type="hidden" name="type" value="masuk"/>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Keterangan / Sumber Penerimaan *</label>
                    <input type="text" name="description" required placeholder="Contoh: Kotak Infaq Shalat Jum'at Pekan 3" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Nominal (Rp) *</label>
                        <input type="number" name="amount" min="1000" required placeholder="250000" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Akun Penampung *</label>
                        <select name="source_account" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="tunai_brankas">Tunai / Brankas Masjid</option>
                            <option value="bsi">Bank BSI Syariah</option>
                            <option value="sulutgo">Bank SulutGo</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Kategori Pos *</label>
                        <select name="category" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="infaq_jumat">Kotak Infaq Jum'at</option>
                            <option value="infaq_subuh">Infaq Majelis Subuh</option>
                            <option value="sedekah_langsung">Sedekah Langsung Jamaah</option>
                            <option value="wakaf_fisik">Wakaf Fisik / Material</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Tanggal Transaksi *</label>
                        <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Foto Berita Acara / Hitung Kotak (Opsional)</label>
                    <input type="file" name="proof_slip" accept="image/*,.pdf" class="w-full text-xs text-on-surface-variant file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-surface-container file:text-navy-deep hover:file:bg-amber-primary hover:file:text-white cursor-pointer"/>
                </div>
                <div class="pt-3">
                    <button type="submit" class="w-full py-3 rounded-full bg-success hover:bg-emerald-600 text-pure-white text-xs font-bold shadow-md transition-colors">
                        Simpan Penerimaan Kas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 2: Catat Pengeluaran Kas -->
    <div id="modal-pengeluaran" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-pengeluaran').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-lg font-bold text-navy-deep mb-4">Pencatatan Pengeluaran / Penyaluran Kas</h3>
            <form action="{{ route('admin.keuangan.kas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <input type="hidden" name="type" value="keluar"/>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Uraian Keperluan Pengeluaran *</label>
                    <input type="text" name="description" required placeholder="Contoh: Pembayaran Token Listrik PLN & Pompa Air" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Nominal (Rp) *</label>
                        <input type="number" name="amount" min="1000" required placeholder="1850000" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Diambil dari Akun *</label>
                        <select name="source_account" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="bsi">Bank BSI Syariah</option>
                            <option value="sulutgo">Bank SulutGo</option>
                            <option value="tunai_brankas">Tunai / Brankas Kasir</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Pos Pengeluaran *</label>
                        <select name="category" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="operasional_listrik">Listrik & Air PLN</option>
                            <option value="honor_guru_tpa">Bisyarah Guru TPA</option>
                            <option value="santunan_dhuafa">Santunan Yatim & Sembako</option>
                            <option value="pemeliharaan_sound">Pemeliharaan & Sound System</option>
                            <option value="pembangunan_fisik">Material Bangunan TPA</option>
                            <option value="konsumsi_kajian">Konsumsi Majelis Dakwah</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Tanggal Transaksi *</label>
                        <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Foto Nota / Kwitansi / Struk</label>
                    <input type="file" name="proof_slip" accept="image/*,.pdf" class="w-full text-xs text-on-surface-variant file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-surface-container file:text-navy-deep hover:file:bg-amber-primary hover:file:text-white cursor-pointer"/>
                </div>
                <div class="pt-3">
                    <button type="submit" class="w-full py-3 rounded-full bg-error hover:bg-red-700 text-pure-white text-xs font-bold shadow-md transition-colors">
                        Bukukan Pengeluaran Kas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 3: Slip Preview Modal -->
    <div id="slip-preview-modal" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4" onclick="closeSlipModal()">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative" onclick="event.stopPropagation()">
            <button onclick="closeSlipModal()" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-base font-bold text-navy-deep mb-1">Lampiran Bukti Donasi</h3>
            <p id="slip-modal-info" class="text-xs text-secondary mb-4"></p>
            <div class="max-h-96 overflow-auto bg-surface-container-low p-2 rounded flex items-center justify-center">
                <img id="slip-modal-img" src="" alt="Bukti Transfer" class="max-h-80 w-auto object-contain rounded"/>
            </div>
            <div class="mt-4 flex justify-end">
                <button onclick="closeSlipModal()" class="px-4 py-2 rounded-full bg-surface-container text-xs font-semibold text-navy-deep">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function previewSlip(url, name, ref, amount) {
    document.getElementById('slip-modal-img').src = url;
    document.getElementById('slip-modal-info').innerText = `${name} • Ref: ${ref} • ${amount}`;
    document.getElementById('slip-preview-modal').classList.remove('hidden');
}

function closeSlipModal() {
    document.getElementById('slip-preview-modal').classList.add('hidden');
}
</script>
@endsection
