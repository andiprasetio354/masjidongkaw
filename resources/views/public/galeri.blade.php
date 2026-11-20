@extends('layouts.public')

@section('title', 'Galeri & Dokumentasi Kegiatan')

@section('content')
<div class="flex flex-col w-full">
    <!-- Header Hero -->
    <section class="relative overflow-hidden bg-gradient-to-b from-sky-dawn-from/50 via-surface to-background py-16 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto text-center space-y-4 max-w-3xl">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-high/80 shadow-sm">
                <span class="material-symbols-outlined text-amber-primary text-base">photo_library</span>
                <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider">Rekam Jejak Dakwah</span>
            </div>
            <h1 class="text-3xl lg:text-5xl font-extrabold text-navy-deep tracking-tight">
                Galeri Foto & Dokumentasi Syiar Al-Fattah
            </h1>
            <p class="text-base text-secondary leading-relaxed">
                Merekam momen kebersamaan ibadah, majelis ilmu, kegiatan sosial, dan kemajuan pembangunan masjid di pesisir Ongkaw 3.
            </p>

            <!-- Filter Categories -->
            <div class="pt-6 flex flex-wrap items-center justify-center gap-2">
                <a href="{{ route('galeri') }}" class="px-5 py-2 rounded-full text-xs font-semibold shadow-sm transition-all {{ $category === 'semua' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                    Semua Foto
                </a>
                <a href="{{ route('galeri', ['kategori' => 'ibadah']) }}" class="px-5 py-2 rounded-full text-xs font-semibold shadow-sm transition-all {{ $category === 'ibadah' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                    Ibadah & Shalat
                </a>
                <a href="{{ route('galeri', ['kategori' => 'kajian']) }}" class="px-5 py-2 rounded-full text-xs font-semibold shadow-sm transition-all {{ $category === 'kajian' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                    Kajian & PHBI
                </a>
                <a href="{{ route('galeri', ['kategori' => 'sosial']) }}" class="px-5 py-2 rounded-full text-xs font-semibold shadow-sm transition-all {{ $category === 'sosial' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                    Bakti Sosial
                </a>
                <a href="{{ route('galeri', ['kategori' => 'pembangunan']) }}" class="px-5 py-2 rounded-full text-xs font-semibold shadow-sm transition-all {{ $category === 'pembangunan' ? 'bg-navy-card text-pure-white' : 'bg-surface-container-lowest text-on-surface-variant hover:text-on-surface' }}">
                    Pembangunan Fisik
                </a>
            </div>
        </div>
    </section>

    <!-- Gallery Grid (3x2 or responsive) -->
    <section class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($photos as $photo)
                <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm hover:shadow-md transition-all group flex flex-col cursor-pointer" onclick="openLightbox('{{ $photo->photo_url }}', '{{ addslashes($photo->caption) }}', '{{ $photo->category }}')">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ $photo->photo_url }}" alt="{{ $photo->caption }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-deep/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                            <span class="text-pure-white text-xs font-semibold flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">zoom_in</span> Klik untuk perbesar
                            </span>
                        </div>
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-navy-card/90 backdrop-blur-md text-amber-primary text-[11px] font-bold capitalize">
                            {{ $photo->category }}
                        </span>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <p class="text-sm text-navy-deep font-semibold leading-snug">
                            {{ $photo->caption }}
                        </p>
                        <div class="pt-3 mt-3 border-t border-surface-container-low flex items-center justify-between text-[11px] text-secondary">
                            <span>Foto Dokumentasi</span>
                            <span>{{ $photo->created_at ? $photo->created_at->format('d M Y') : '2026' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 bg-surface-container-lowest rounded-lg p-12 text-center text-secondary">
                    <span class="material-symbols-outlined text-4xl text-secondary mb-2">image_not_supported</span>
                    <p class="font-medium">Belum ada foto untuk kategori ini.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4" onclick="closeLightbox()">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-3xl w-full overflow-hidden shadow-2xl relative" onclick="event.stopPropagation()">
            <button class="absolute top-4 right-4 bg-navy-deep/80 text-pure-white hover:bg-navy-deep p-1.5 rounded-full z-10 transition-colors" onclick="closeLightbox()">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="max-h-[75vh] overflow-hidden bg-black flex items-center justify-center">
                <img id="lightbox-img" src="" alt="" class="max-h-[75vh] w-auto object-contain"/>
            </div>
            <div class="p-5 flex items-center justify-between bg-surface-container-low">
                <div>
                    <span id="lightbox-cat" class="text-[11px] font-bold text-amber-primary uppercase tracking-wider block mb-1"></span>
                    <p id="lightbox-caption" class="text-sm font-semibold text-navy-deep"></p>
                </div>
                <button class="px-4 py-2 rounded-full bg-surface-container text-navy-deep text-xs font-semibold hover:bg-surface-container-high transition-colors" onclick="closeLightbox()">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openLightbox(url, caption, category) {
    document.getElementById('lightbox-img').src = url;
    document.getElementById('lightbox-caption').innerText = caption;
    document.getElementById('lightbox-cat').innerText = category;
    document.getElementById('lightbox-modal').classList.remove('hidden');
}

function closeLightbox() {
    document.getElementById('lightbox-modal').classList.add('hidden');
}
</script>
@endsection
