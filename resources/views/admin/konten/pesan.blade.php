@extends('layouts.admin')

@section('title', 'Pesan & Aspirasi Jamaah')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Pesan & Layanan Aspirasi Jamaah</h1>
            <p class="text-xs text-secondary mt-0.5">Daftar permohonan aula, pendaftaran santri TPA, dan pesan aspirasi yang dikirimkan warga.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-surface-container-high/40 text-on-surface-variant text-xs uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">Tanggal & Waktu</th>
                        <th class="py-3.5 px-6">Nama Pengirim</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Isi Pesan</th>
                        <th class="py-3.5 px-6">Kontak</th>
                        <th class="py-3.5 px-6 text-center">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low text-navy-deep">
                    @forelse($messages as $msg)
                        <tr class="{{ $msg->is_read ? 'hover:bg-surface-container-low/40' : 'bg-amber-glow/20 hover:bg-amber-glow/40 font-semibold' }} transition-colors">
                            <td class="py-4 px-6 text-xs font-mono text-secondary">
                                {{ $msg->created_at->translatedFormat('d M Y, H:i') }}
                            </td>
                            <td class="py-4 px-6 font-bold">
                                {{ $msg->name }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-tertiary-fixed text-on-tertiary-container capitalize">
                                    {{ str_replace('_', ' ', $msg->category) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs max-w-xs truncate">
                                {{ $msg->message }}
                            </td>
                            <td class="py-4 px-6 text-xs text-secondary font-mono">
                                {{ $msg->phone ?? $msg->email ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold {{ $msg->is_read ? 'bg-surface-container text-secondary' : 'bg-amber-primary text-pure-white' }}">
                                    {{ $msg->is_read ? 'Sudah Dibaca' : 'Baru' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($msg->phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="p-1 rounded-full text-success hover:bg-success/10" title="Balas via WhatsApp">
                                            <span class="material-symbols-outlined text-base">chat</span>
                                        </a>
                                    @endif
                                    <form action="{{ route('admin.konten.pesan.toggle-read', $msg->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1 rounded-full text-secondary hover:bg-surface-container" title="{{ $msg->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                            <span class="material-symbols-outlined text-base">{{ $msg->is_read ? 'mark_email_unread' : 'mark_email_read' }}</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-secondary text-xs">Belum ada pesan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
            <div class="p-4 bg-surface-container-low">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
