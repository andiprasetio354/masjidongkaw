@extends('layouts.admin')

@section('title', 'Laporan Kas & Neraca Keuangan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 print:hidden">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Laporan Keuangan & Neraca Kas Masjid</h1>
            <p class="text-xs text-secondary mt-0.5">Laporan pertanggungjawaban kas terbuka BKM Al-Fattah Ongkaw 3.</p>
        </div>
        <button onclick="window.print()" class="px-5 py-2.5 rounded-full bg-navy-deep hover:bg-navy-accent text-pure-white text-xs font-bold flex items-center gap-2 shadow-sm transition-all">
            <span class="material-symbols-outlined text-base">print</span> Cetak Laporan Resmi
        </button>
    </div>

    <!-- Printable Official Report Card -->
    <div class="bg-surface-container-lowest rounded-DEFAULT p-8 shadow-sm space-y-6 print:shadow-none print:p-0">
        <!-- Letterhead Header -->
        <div class="text-center pb-6 border-b-2 border-navy-deep/20 space-y-1">
            <h2 class="text-lg font-extrabold text-navy-deep uppercase tracking-wider">BADAN KEMAKMURAN MASJID (BKM) AL-FATTAH</h2>
            <h3 class="text-base font-bold text-primary">DESA ONGKAW 3, KECAMATAN SINONSAYANG, MINAHASA SELATAN</h3>
            <p class="text-xs text-secondary">Jl. Trans Sulawesi, Ongkaw 3, Jaga II, Sinonsayang, Minahasa Selatan, Sulawesi Utara 95357</p>
            <div class="pt-2 text-xs font-semibold text-navy-deep">
                LAPORAN REALISASI PENERIMAAN & PENYALURAN KAS BULANAN
            </div>
            <p class="text-[11px] text-secondary">Periode: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }} • Dicetak: {{ date('d F Y, H:i') }} WITA</p>
        </div>

        <!-- Financial Summary Matrix -->
        <div class="grid grid-cols-3 gap-4 text-xs font-medium">
            <div class="p-3 rounded bg-surface-container-low text-center">
                <span class="text-secondary block">Total Penerimaan (Infaq/Sedekah)</span>
                <span class="text-base font-bold text-success font-mono">Rp{{ number_format($totalMasuk, 0, ',', '.') }}</span>
            </div>
            <div class="p-3 rounded bg-surface-container-low text-center">
                <span class="text-secondary block">Total Penyaluran (Beban Operasional)</span>
                <span class="text-base font-bold text-error font-mono">Rp{{ number_format($totalKeluar, 0, ',', '.') }}</span>
            </div>
            <div class="p-3 rounded bg-amber-glow/60 text-center border border-amber-primary/30">
                <span class="text-on-primary-container font-bold block">Saldo Kas Terjaga</span>
                <span class="text-base font-extrabold text-navy-deep font-mono">Rp{{ number_format($saldoKas, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Ledger Table -->
        <div class="overflow-x-auto pt-2">
            <table class="w-full text-left text-xs border border-surface-container">
                <thead class="bg-surface-container text-navy-deep uppercase">
                    <tr>
                        <th class="py-2.5 px-3 border border-surface-container">No</th>
                        <th class="py-2.5 px-3 border border-surface-container">Tanggal</th>
                        <th class="py-2.5 px-3 border border-surface-container">Kode Reff</th>
                        <th class="py-2.5 px-3 border border-surface-container">Uraian / Keterangan</th>
                        <th class="py-2.5 px-3 border border-surface-container">Akun</th>
                        <th class="py-2.5 px-3 border border-surface-container text-right">Penerimaan (Debit)</th>
                        <th class="py-2.5 px-3 border border-surface-container text-right">Pengeluaran (Kredit)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container text-navy-deep">
                    @foreach($mutations as $i => $m)
                        <tr>
                            <td class="py-2 px-3 border border-surface-container text-center">{{ $i + 1 }}</td>
                            <td class="py-2 px-3 border border-surface-container font-mono">{{ \Carbon\Carbon::parse($m->transaction_date)->format('d/m/Y') }}</td>
                            <td class="py-2 px-3 border border-surface-container font-mono font-bold">{{ $m->transaction_code }}</td>
                            <td class="py-2 px-3 border border-surface-container">{{ $m->description }}</td>
                            <td class="py-2 px-3 border border-surface-container uppercase font-mono">{{ $m->source_account }}</td>
                            <td class="py-2 px-3 border border-surface-container text-right font-mono text-success font-semibold">
                                {{ $m->type === 'masuk' ? 'Rp' . number_format($m->amount, 0, ',', '.') : '-' }}
                            </td>
                            <td class="py-2 px-3 border border-surface-container text-right font-mono text-error font-semibold">
                                {{ $m->type === 'keluar' ? 'Rp' . number_format($m->amount, 0, ',', '.') : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-surface-container font-bold text-navy-deep">
                    <tr>
                        <td colspan="5" class="py-2.5 px-3 border border-surface-container text-right">TOTAL REALISASI</td>
                        <td class="py-2.5 px-3 border border-surface-container text-right font-mono text-success">Rp{{ number_format($totalMasuk, 0, ',', '.') }}</td>
                        <td class="py-2.5 px-3 border border-surface-container text-right font-mono text-error">Rp{{ number_format($totalKeluar, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Signatures Section -->
        <div class="pt-8 grid grid-cols-2 text-center text-xs text-navy-deep">
            <div>
                <p>Mengetahui,</p>
                <p class="font-bold">Ketua BKM Masjid Al-Fattah</p>
                <div class="h-20"></div>
                <p class="font-bold underline">H. Ismail Paputungan</p>
            </div>
            <div>
                <p>Ongkaw 3, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="font-bold">Bendahara Umum</p>
                <div class="h-20"></div>
                <p class="font-bold underline">Zulkifli Mamonto, S.E.</p>
            </div>
        </div>
    </div>
</div>
@endsection
