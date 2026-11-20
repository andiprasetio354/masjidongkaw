@extends('layouts.admin')

@section('title', 'Manajemen Galeri Foto')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Galeri & Dokumentasi Syiar</h1>
            <p class="text-xs text-secondary mt-0.5">Kelola foto arsip kegiatan shalat, kajian, bakti sosial, dan renovasi fisik masjid.</p>
        </div>
        <button onclick="document.getElementById('modal-galeri').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all">
            <span class="material-symbols-outlined text-base">cloud_upload</span> + Unggah Foto Dokumentasi
        </button>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($photos as $photo)
            <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm flex flex-col justify-between group">
                <div class="h-44 overflow-hidden relative">
                    <img src="{{ $photo->photo_url }}" alt="{{ $photo->caption }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full bg-navy-deep/80 backdrop-blur text-amber-primary text-[10px] font-bold uppercase">
                        {{ $photo->category }}
                    </span>
                </div>
                <div class="p-3 flex-1 flex flex-col justify-between">
                    <p class="text-xs font-semibold text-navy-deep line-clamp-2">{{ $photo->caption }}</p>
                    <div class="pt-2 mt-2 border-t border-surface-container-low flex items-center justify-between text-[11px] text-secondary">
                        <span>{{ $photo->created_at->format('d M Y') }}</span>
                        <form action="{{ route('admin.konten.galeri.delete', $photo->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-error hover:underline flex items-center gap-0.5">
                                <span class="material-symbols-outlined text-sm">delete</span> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-4 p-8 text-center text-xs text-secondary bg-surface-container-lowest rounded-DEFAULT">
                Belum ada foto dalam galeri.
            </div>
        @endforelse
    </div>

    @if($photos->hasPages())
        <div class="p-4 bg-surface-container-lowest rounded-DEFAULT shadow-sm">
            {{ $photos->links() }}
        </div>
    @endif

    <!-- Modal Upload Galeri -->
    <div id="modal-galeri" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-galeri').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-lg font-bold text-navy-deep mb-4">Unggah Foto Galeri</h3>
            <form action="{{ route('admin.konten.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Keterangan / Kepsyen Foto *</label>
                    <input type="text" name="caption" required placeholder="Contoh: Shalat Idul Fitri 1446 H Berjamaah" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Kategori *</label>
                        <select name="category" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="ibadah">Ibadah & Shalat</option>
                            <option value="kajian">Kajian & PHBI</option>
                            <option value="sosial">Bakti Sosial & Umat</option>
                            <option value="pembangunan">Pembangunan Fisik</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Urutan Tampil</label>
                        <input type="number" name="order_index" value="0" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Pilih Berkas Foto *</label>
                    <input type="file" name="photo_file" accept="image/*" class="w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-surface-container-high file:text-navy-deep hover:file:bg-amber-primary hover:file:text-white cursor-pointer"/>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Atau Masukkan URL Gambar</label>
                    <input type="url" name="photo_url" placeholder="https://..." class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="pt-3">
                    <button type="submit" class="w-full py-3 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold shadow-md transition-colors">
                        Unggah Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
