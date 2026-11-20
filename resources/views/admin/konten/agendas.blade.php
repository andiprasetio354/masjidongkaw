@extends('layouts.admin')

@section('title', 'Manajemen Agenda Dakwah')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Manajemen Agenda & Majelis Dakwah</h1>
            <p class="text-xs text-secondary mt-0.5">Jadwal kajian rutin, PHBI, majelis taklim, dan kegiatan remaja masjid.</p>
        </div>
        <button onclick="document.getElementById('modal-agenda').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all">
            <span class="material-symbols-outlined text-base">add</span> + Tambah Agenda Baru
        </button>
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
                        <th class="py-3.5 px-6">Nama Agenda / Kajian</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Narasumber / PIC</th>
                        <th class="py-3.5 px-6">Lokasi</th>
                        <th class="py-3.5 px-6 text-center">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low text-navy-deep">
                    @forelse($agendas as $agenda)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-4 px-6 text-xs font-mono text-secondary">
                                {{ \Carbon\Carbon::parse($agenda->date_time)->translatedFormat('d M Y, H:i') }} WITA
                            </td>
                            <td class="py-4 px-6 font-semibold">
                                {{ $agenda->title }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-glow text-on-primary-container capitalize">
                                    {{ str_replace('_', ' ', $agenda->category) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-secondary">{{ $agenda->speaker ?? '-' }}</td>
                            <td class="py-4 px-6 text-xs text-secondary">{{ $agenda->location ?? 'Masjid Al-Fattah' }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold {{ $agenda->status === 'published' ? 'bg-success/20 text-success' : 'bg-surface-container text-secondary' }}">
                                    {{ $agenda->status === 'published' ? 'Publik' : 'Draft' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.konten.agendas.delete', $agenda->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus agenda ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 rounded-full text-error hover:bg-error/10" title="Hapus">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-secondary text-xs">Belum ada agenda yang dibuat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($agendas->hasPages())
            <div class="p-4 bg-surface-container-low">
                {{ $agendas->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Tambah Agenda -->
    <div id="modal-agenda" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-agenda').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-lg font-bold text-navy-deep mb-4">Tambah Agenda Dakwah</h3>
            <form action="{{ route('admin.konten.agendas.store') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Judul Agenda *</label>
                    <input type="text" name="title" required placeholder="Contoh: Kajian Subuh Berkah & Sarapan Ukhuwah" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Kategori *</label>
                        <select name="category" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="kajian_rutin">Kajian Rutin</option>
                            <option value="phbi">PHBI & Hari Besar</option>
                            <option value="tpa">TPA & Remaja</option>
                            <option value="tabligh_akbar">Tabligh Akbar</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Tanggal & Waktu *</label>
                        <input type="datetime-local" name="date_time" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Narasumber / Penceramah</label>
                        <input type="text" name="speaker" placeholder="Contoh: Ust. H. Ridwan Mokodongan" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Lokasi Kegiatan</label>
                        <input type="text" name="location" value="Ruang Utama Masjid Al-Fattah" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" placeholder="Rincian bahasan atau kitab yang dibedah..." class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"></textarea>
                </div>
                <div class="pt-3">
                    <button type="submit" class="w-full py-3 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold shadow-md transition-colors">
                        Simpan & Terbitkan Agenda
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
