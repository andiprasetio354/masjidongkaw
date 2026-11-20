@extends('layouts.admin')

@section('title', 'Verifikasi Sedekah Masuk')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Antrean Verifikasi Donasi Masuk</h1>
            <p class="text-xs text-secondary mt-0.5">Validasi slip setoran dan mutasi rekening sebelum masuk ke Buku Kas dan Dinding Doa.</p>
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

    <!-- Pending Queue Table -->
    <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm space-y-4 p-6">
        <h2 class="text-base font-bold text-navy-deep flex items-center gap-2 border-b border-surface-container-low pb-3">
            <span class="material-symbols-outlined text-amber-primary">pending_actions</span>
            <span>Menunggu Konfirmasi Bendahara ({{ $pendingDonations->total() }})</span>
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-surface-container-high/40 text-on-surface-variant text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4">Ref Code</th>
                        <th class="py-3 px-4">Donatur</th>
                        <th class="py-3 px-4">Program</th>
                        <th class="py-3 px-4">Metode</th>
                        <th class="py-3 px-4 text-right">Nominal</th>
                        <th class="py-3 px-4 text-center">Bukti Slip</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low text-navy-deep">
                    @forelse($pendingDonations as $don)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-3.5 px-4 text-xs font-mono text-secondary">
                                {{ $don->created_at->format('d/m H:i') }}
                            </td>
                            <td class="py-3.5 px-4 font-mono text-xs font-bold">{{ $don->reference_code }}</td>
                            <td class="py-3.5 px-4 font-semibold">{{ $don->display_name }}</td>
                            <td class="py-3.5 px-4 text-xs text-secondary">{{ $don->program ? $don->program->title : 'Sedekah Umum' }}</td>
                            <td class="py-3.5 px-4 text-xs uppercase">{{ str_replace('_', ' ', $don->payment_method) }}</td>
                            <td class="py-3.5 px-4 text-right font-bold font-mono">Rp{{ number_format($don->amount, 0, ',', '.') }}</td>
                            <td class="py-3.5 px-4 text-center">
                                @if($don->proof_image_path)
                                    <a href="{{ $don->proof_image_path }}" target="_blank" class="text-xs text-primary font-bold hover:underline flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-xs">image</span> Lihat
                                    </a>
                                @else
                                    <span class="text-[11px] text-secondary italic">Tanpa Slip</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <form action="{{ route('admin.keuangan.verifikasi.action', $don->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak donasi ini?')">
                                        @csrf
                                        <input type="hidden" name="action" value="reject"/>
                                        <button type="submit" class="px-2.5 py-1 rounded bg-surface-container-high text-xs font-semibold text-secondary hover:bg-error-container hover:text-error transition-colors">
                                            Tolak
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.keuangan.verifikasi.action', $don->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="action" value="verify"/>
                                        <button type="submit" class="px-3 py-1 rounded-full bg-success text-pure-white hover:bg-emerald-600 text-xs font-bold transition-all shadow-sm">
                                            Verifikasi
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-secondary text-xs">Tidak ada donasi yang menunggu verifikasi saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pendingDonations->hasPages())
            <div class="pt-3">
                {{ $pendingDonations->links() }}
            </div>
        @endif
    </div>

    <!-- Riwayat Verifikasi Terakhir -->
    <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm p-6 space-y-4">
        <h2 class="text-base font-bold text-navy-deep flex items-center gap-2 border-b border-surface-container-low pb-3">
            <span class="material-symbols-outlined text-success">history</span>
            <span>Riwayat Transaksi yang Telah Ditindaklanjuti</span>
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-surface-container-high/40 text-on-surface-variant uppercase tracking-wider">
                    <tr>
                        <th class="py-2.5 px-4">Waktu Diverifikasi</th>
                        <th class="py-2.5 px-4">Ref Code</th>
                        <th class="py-2.5 px-4">Donatur</th>
                        <th class="py-2.5 px-4">Nominal</th>
                        <th class="py-2.5 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low text-navy-deep">
                    @foreach($verifiedHistory as $vh)
                        <tr class="hover:bg-surface-container-low/40">
                            <td class="py-2.5 px-4 text-secondary font-mono">{{ $vh->verified_at ? \Carbon\Carbon::parse($vh->verified_at)->format('d/m/Y H:i') : '-' }}</td>
                            <td class="py-2.5 px-4 font-mono font-bold">{{ $vh->reference_code }}</td>
                            <td class="py-2.5 px-4 font-semibold">{{ $vh->display_name }}</td>
                            <td class="py-2.5 px-4 font-mono font-bold">Rp{{ number_format($vh->amount, 0, ',', '.') }}</td>
                            <td class="py-2.5 px-4 text-center">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $vh->status === 'verified' ? 'bg-success/20 text-success' : 'bg-error/20 text-error' }}">
                                    {{ $vh->status === 'verified' ? 'Terverifikasi' : 'Ditolak' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
