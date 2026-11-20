@extends('layouts.admin')

@section('title', 'Berita & Pengumuman BKM')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Berita & Pengumuman BKM</h1>
            <p class="text-xs text-secondary mt-0.5">Publikasikan warta kegiatan, laporan syiar, dan edaran resmi pengurus ke jamaah.</p>
        </div>
        <button onclick="document.getElementById('modal-berita').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all">
            <span class="material-symbols-outlined text-base">add</span> + Tulis Pengumuman Baru
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
                        <th class="py-3.5 px-6">Tanggal Rilis</th>
                        <th class="py-3.5 px-6">Judul Berita / Pengumuman</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Penulis / Humas</th>
                        <th class="py-3.5 px-6 text-center">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low text-navy-deep">
                    @forelse($news as $item)
                        <tr class="hover:bg-surface-container-low/40 transition-colors">
                            <td class="py-4 px-6 text-xs font-mono text-secondary">
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-4 px-6 font-semibold">
                                <div class="flex items-center gap-2">
                                    @if($item->is_pinned)
                                        <span class="material-symbols-outlined text-amber-primary text-base" title="Disematkan di Beranda">push_pin</span>
                                    @endif
                                    <span>{{ $item->title }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-tertiary-fixed text-on-tertiary-container capitalize">
                                    {{ $item->category }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-secondary">{{ $item->author_name ?? 'Humas BKM' }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold {{ $item->status === 'published' ? 'bg-success/20 text-success' : 'bg-surface-container text-secondary' }}">
                                    {{ $item->status === 'published' ? 'Terbit' : 'Draft' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.konten.berita.delete', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?')">
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
                            <td colspan="6" class="py-8 text-center text-secondary text-xs">Belum ada berita atau pengumuman yang dibuat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($news->hasPages())
            <div class="p-4 bg-surface-container-low">
                {{ $news->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Tambah Berita -->
    <div id="modal-berita" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-berita').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-lg font-bold text-navy-deep mb-4">Tulis Pengumuman / Warta BKM</h3>
            <form action="{{ route('admin.konten.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Judul Pengumuman *</label>
                    <input type="text" name="title" required placeholder="Contoh: Edaran Shalat Gerhana Bulan & Khutbah Khusuf" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Kategori</label>
                        <select name="category" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="pengumuman">Pengumuman Resmi</option>
                            <option value="berita">Berita & Syiar</option>
                            <option value="kajian">Kajian Khusus</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Status Publikasi</label>
                        <select name="status" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="published">Langsung Terbitkan</option>
                            <option value="draft">Simpan sebagai Draft</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Isi Berita / Pengumuman *</label>
                    <textarea name="content" rows="4" required placeholder="Tuliskan isi pengumuman lengkap..." class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_pinned" id="is_pinned" value="1" class="accent-amber-primary"/>
                    <label for="is_pinned" class="text-xs text-navy-deep font-semibold">Sematkan sebagai Berita Utama (Pinned)</label>
                </div>
                <div class="pt-3">
                    <button type="submit" class="w-full py-3 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold shadow-md transition-colors">
                        Simpan & Publikasikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
