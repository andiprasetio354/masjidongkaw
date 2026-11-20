@extends('layouts.admin')

@section('title', 'Buku Kas Umum Digital')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Buku Kas Umum Digital</h1>
            <p class="text-xs text-secondary mt-0.5">Catatan mutasi penerimaan infaq dan pengeluaran operasional Masjid Al-Fattah Ongkaw 3.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <button onclick="document.getElementById('modal-infaq-masuk').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-success hover:bg-emerald-600 text-pure-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all">
                <span class="material-symbols-outlined text-base">add_circle</span> + Catat Kas Masuk
            </button>
            <button onclick="document.getElementById('modal-pengeluaran').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-navy-card hover:bg-navy-accent text-pure-white text-xs font-semibold flex items-center gap-1.5 transition-all">
                <span class="material-symbols-outlined text-base">outbox</span> + Catat Pengeluaran
            </button>
            <button onclick="window.print()" class="px-3.5 py-2 rounded-full bg-surface-container hover:bg-surface-container-high text-navy-deep text-xs font-semibold flex items-center gap-1.5 transition-all">
                <span class="material-symbols-outlined text-base">print</span> Cetak Kas
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Balance Summary Strip -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT p-4 shadow-sm border border-surface-container">
            <span class="text-xs text-secondary uppercase font-semibold">Total Penerimaan (Masuk)</span>
            <div class="text-xl font-bold text-success font-mono mt-1">+Rp{{ number_format($totalMasuk, 0, ',', '.') }}</div>
        </div>
        <div class="bg-surface-container-lowest rounded-DEFAULT p-4 shadow-sm border border-surface-container">
            <span class="text-xs text-secondary uppercase font-semibold">Total Penyaluran (Keluar)</span>
            <div class="text-xl font-bold text-error font-mono mt-1">-Rp{{ number_format($totalKeluar, 0, ',', '.') }}</div>
        </div>
        <div class="bg-navy-card rounded-DEFAULT p-4 shadow-sm text-pure-white">
            <span class="text-xs text-secondary-fixed-dim uppercase font-semibold">Saldo Kas Berjalan</span>
            <div class="text-xl font-extrabold text-amber-glow font-mono mt-1">Rp{{ number_format($saldoKas, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.keuangan.buku-kas') }}" class="px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm {{ $type === 'all' ? 'bg-navy-deep text-pure-white' : 'bg-surface-container text-navy-deep hover:bg-surface-container-high' }}">
            Semua Mutasi
        </a>
        <a href="{{ route('admin.keuangan.buku-kas', ['type' => 'masuk']) }}" class="px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm {{ $type === 'masuk' ? 'bg-success text-pure-white' : 'bg-surface-container text-navy-deep hover:bg-surface-container-high' }}">
            Pemasukan Saja
        </a>
        <a href="{{ route('admin.keuangan.buku-kas', ['type' => 'keluar']) }}" class="px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm {{ $type === 'keluar' ? 'bg-error text-pure-white' : 'bg-surface-container text-navy-deep hover:bg-surface-container-high' }}">
            Pengeluaran Saja
        </a>
    </div>

    <!-- Main Mutation Table -->
    <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-surface-container-high/40 text-on-surface-variant uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">Tanggal</th>
                        <th class="py-3.5 px-6">Kode Transaksi</th>
                        <th class="py-3.5 px-6">Keterangan Transaksi</th>
                        <th class="py-3.5 px-6">Pos / Kategori</th>
                        <th class="py-3.5 px-6">Akun Kas</th>
                        <th class="py-3.5 px-6 text-right">Debit (Masuk)</th>
                        <th class="py-3.5 px-6 text-right">Kredit (Keluar)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low text-navy-deep">
                    @forelse($mutations as $mut)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-4 px-6 font-mono text-secondary">
                                {{ \Carbon\Carbon::parse($mut->transaction_date)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6 font-mono font-bold">{{ $mut->transaction_code }}</td>
                            <td class="py-4 px-6 font-semibold">{{ $mut->description }}</td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-surface-container-high text-navy-accent capitalize">
                                    {{ str_replace('_', ' ', $mut->category) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 uppercase text-secondary font-mono">{{ $mut->source_account }}</td>
                            <td class="py-4 px-6 text-right font-mono font-bold text-success">
                                {{ $mut->type === 'masuk' ? 'Rp' . number_format($mut->amount, 0, ',', '.') : '-' }}
                            </td>
                            <td class="py-4 px-6 text-right font-mono font-bold text-error">
                                {{ $mut->type === 'keluar' ? 'Rp' . number_format($mut->amount, 0, ',', '.') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-secondary text-xs">Belum ada mutasi kas yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($mutations->hasPages())
            <div class="p-4 bg-surface-container-low">
                {{ $mutations->links() }}
            </div>
        @endif
    </div>

    <!-- MODAL Catat Kas Masuk -->
    <div id="modal-infaq-masuk" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-infaq-masuk').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-base font-bold text-navy-deep mb-4">Catat Penerimaan Kas Masuk</h3>
            <form action="{{ route('admin.keuangan.kas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <input type="hidden" name="type" value="masuk"/>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Uraian Penerimaan *</label>
                    <input type="text" name="description" required placeholder="Contoh: Kotak Infaq Subuh" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Nominal (Rp) *</label>
                        <input type="number" name="amount" min="1000" required placeholder="500000" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Akun Penampung *</label>
                        <select name="source_account" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="tunai_brankas">Tunai / Brankas</option>
                            <option value="bsi">Bank BSI Syariah</option>
                            <option value="sulutgo">Bank SulutGo</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Kategori *</label>
                        <select name="category" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="infaq_jumat">Kotak Infaq Jum'at</option>
                            <option value="infaq_subuh">Infaq Subuh</option>
                            <option value="sedekah_langsung">Sedekah Langsung</option>
                            <option value="wakaf">Wakaf Pembangunan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Tanggal *</label>
                        <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Lampiran Foto Bukti</label>
                    <input type="file" name="proof_slip" accept="image/*,.pdf" class="w-full text-xs text-on-surface-variant file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-surface-container file:text-navy-deep hover:file:bg-amber-primary hover:file:text-white cursor-pointer"/>
                </div>
                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 rounded-full bg-success text-pure-white text-xs font-bold">
                        Simpan ke Buku Kas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL Catat Pengeluaran -->
    <div id="modal-pengeluaran" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-pengeluaran').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-base font-bold text-navy-deep mb-4">Catat Pengeluaran / Penyaluran Kas</h3>
            <form action="{{ route('admin.keuangan.kas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <input type="hidden" name="type" value="keluar"/>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Uraian Pengeluaran *</label>
                    <input type="text" name="description" required placeholder="Contoh: Pembelian Semen Ruang TPA" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Nominal (Rp) *</label>
                        <input type="number" name="amount" min="1000" required placeholder="650000" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Sumber Akun *</label>
                        <select name="source_account" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="bsi">Bank BSI Syariah</option>
                            <option value="sulutgo">Bank SulutGo</option>
                            <option value="tunai_brankas">Tunai / Brankas</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Pos Pengeluaran *</label>
                        <select name="category" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="operasional_listrik">Listrik & Air PLN</option>
                            <option value="honor_guru_tpa">Bisyarah Guru TPA</option>
                            <option value="santunan_dhuafa">Santunan Dhuafa & Yatim</option>
                            <option value="pembangunan_fisik">Bahan Bangunan TPA</option>
                            <option value="pemeliharaan_sound">Servis Audio Sound</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Tanggal *</label>
                        <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Lampiran Nota / Kwitansi</label>
                    <input type="file" name="proof_slip" accept="image/*,.pdf" class="w-full text-xs text-on-surface-variant file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-surface-container file:text-navy-deep hover:file:bg-amber-primary hover:file:text-white cursor-pointer"/>
                </div>
                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 rounded-full bg-error text-pure-white text-xs font-bold">
                        Bukukan Pengeluaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
