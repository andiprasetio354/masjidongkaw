@extends('layouts.admin')

@section('title', 'Audit Trail & Log Aktivitas')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Audit Trail & Log Aktivitas Sistem</h1>
            <p class="text-xs text-secondary mt-0.5">Catatan immutable atas setiap aksi verifikasi donasi, perubahan jadwal, mutasi kas, dan konfigurasi API.</p>
        </div>
    </div>

    <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-surface-container-high/40 text-on-surface-variant uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Waktu (WITA)</th>
                        <th class="py-3 px-4">Pengguna / Akun</th>
                        <th class="py-3 px-4">Modul</th>
                        <th class="py-3 px-4">Tindakan / Aksi</th>
                        <th class="py-3 px-4">Rincian Perubahan</th>
                        <th class="py-3 px-4">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low text-navy-deep">
                    @forelse($logs as $log)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-3 px-4 text-secondary font-mono whitespace-nowrap">
                                {{ $log->created_at->format('d/m/Y H:i:s') }}
                            </td>
                            <td class="py-3 px-4 font-bold whitespace-nowrap">
                                {{ $log->user_name ?? ($log->user ? $log->user->name : 'Sistem Otomatis') }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-surface-container text-navy-deep capitalize">
                                    {{ $log->module }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-semibold">{{ $log->action }}</td>
                            <td class="py-3 px-4 text-secondary max-w-md truncate">{{ $log->details }}</td>
                            <td class="py-3 px-4 font-mono text-[11px] text-secondary">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-secondary text-xs">Belum ada catatan log aktivitas yang terekam.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="p-4 bg-surface-container-low">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
