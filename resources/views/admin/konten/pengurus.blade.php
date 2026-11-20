@extends('layouts.admin')

@section('title', 'Struktur Kepengurusan BKM')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Struktur Kepengurusan BKM Al-Fattah</h1>
            <p class="text-xs text-secondary mt-0.5">Daftar Dewan Pembina, Pengurus Harian, Imam Rawatib, dan RISMA periode 2024-2029.</p>
        </div>
        <button onclick="document.getElementById('modal-pengurus').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all">
            <span class="material-symbols-outlined text-base">person_add</span> + Tambah Anggota Pengurus
        </button>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($members as $m)
            <div class="bg-surface-container-lowest rounded-DEFAULT p-5 shadow-sm flex items-start gap-4">
                <img src="{{ $m->photo_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDiTYKg6JA8H8wMPAw_6-zwm8TOQmO4RSWKAdgFajDKmzFOcO5Haas8OwB3SGsPvrzBCNOEPTH8qHEOkows7l6gUPphe7b4Hc49pkVe_IGTZDoKvv9HFshvV8yPpO-Jk9WKXEH7B9F-EkvrA7oTxFJcHeJpUSvZxSx__OiTWb3Xrqtk6m31-qYEaL_P2ksYNAGrGxTEf69wnCtZg2kMZmLRgOyoyfgN2CVOiAHaUw' }}" alt="{{ $m->name }}" class="w-14 h-14 rounded-full object-cover shrink-0 shadow-sm"/>
                <div class="flex-1 min-w-0">
                    <span class="px-2 py-0.5 rounded-full bg-amber-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider">
                        {{ $m->division }}
                    </span>
                    <h3 class="text-sm font-bold text-navy-deep truncate mt-1">{{ $m->name }}</h3>
                    <p class="text-xs text-secondary truncate">{{ $m->role_title }}</p>
                    <p class="text-[11px] text-on-surface-variant line-clamp-2 mt-1 leading-snug">{{ $m->bio }}</p>
                    <div class="pt-2 mt-2 border-t border-surface-container-low flex items-center justify-between text-[11px]">
                        <span class="text-secondary">{{ $m->phone ?? '-' }}</span>
                        <form action="{{ route('admin.konten.pengurus.delete', $m->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengurus ini?')">
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
            <div class="col-span-3 p-8 text-center text-xs text-secondary bg-surface-container-lowest rounded-DEFAULT">
                Belum ada data pengurus yang tersimpan.
            </div>
        @endforelse
    </div>

    <!-- Modal Tambah Pengurus -->
    <div id="modal-pengurus" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-pengurus').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-lg font-bold text-navy-deep mb-4">Tambah Data Pengurus BKM</h3>
            <form action="{{ route('admin.konten.pengurus.store') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Nama Lengkap & Gelar *</label>
                    <input type="text" name="name" required placeholder="Contoh: H. Ismail Paputungan" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Jabatan *</label>
                        <input type="text" name="role_title" required placeholder="Contoh: Ketua BKM" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Divisi / Bidang *</label>
                        <select name="division" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="harian">Pengurus Harian</option>
                            <option value="pembina">Dewan Pembina / Penasihat</option>
                            <option value="imam_muadzin">Imam & Muadzin Rawatib</option>
                            <option value="risma">Remaja Islam Masjid (RISMA)</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">No. Telepon / WhatsApp</label>
                        <input type="text" name="phone" placeholder="081234567890" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">URL Foto Profil</label>
                        <input type="url" name="photo_url" placeholder="https://..." class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Profil Singkat / Tugas</label>
                    <textarea name="bio" rows="2" placeholder="Tanggung jawab dan amanah pengurus..." class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"></textarea>
                </div>
                <div class="pt-3">
                    <button type="submit" class="w-full py-3 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold shadow-md transition-colors">
                        Simpan Data Pengurus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
