@extends('layouts.admin')

@section('title', 'Pengaturan Website & Tampilan TV')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-navy-deep">Pengaturan Identitas & Fitur Website</h1>
        <p class="text-xs text-secondary mt-0.5">Konfigurasi profil masjid, sakelar bagian beranda publik, dan koordinat hisab shalat.</p>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- Profil Masjid Form (7 cols) -->
        <div class="lg:col-span-7 bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm space-y-4">
            <h2 class="text-base font-bold text-navy-deep flex items-center gap-2 border-b border-surface-container-low pb-3">
                <span class="material-symbols-outlined text-amber-primary">mosque</span>
                <span>Identitas Resmi Masjid</span>
            </h2>

            <form action="{{ route('admin.konten.pengaturan.profile') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Nama Institusi / Masjid *</label>
                    <input type="text" name="name" value="{{ $profile->name ?? 'Masjid Al-Fattah Ongkaw 3' }}" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>

                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Alamat Lengkap</label>
                    <textarea name="address" rows="2" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">{{ $profile->address ?? 'Jl. Trans Sulawesi, Desa Ongkaw 3, Kec. Sinonsayang, Minahasa Selatan' }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">No. Kontak / WhatsApp</label>
                        <input type="text" name="phone" value="{{ $profile->phone ?? '0812-3456-7890' }}" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Email Resmi</label>
                        <input type="email" name="email" value="{{ $profile->email ?? 'sekretariat@alfattah-ongkaw.id' }}" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Kapasitas Jamaah</label>
                        <input type="text" name="capacity" value="{{ $profile->capacity ?? '650+ Jamaah' }}" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Arah Kiblat</label>
                        <input type="text" readonly value="291.4° Barat Laut (0.912° LU, 124.365° BT)" class="w-full px-3 py-2 rounded bg-surface-container text-secondary text-xs cursor-not-allowed"/>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Visi Kepengurusan</label>
                    <textarea name="vision" rows="2" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">{{ $profile->vision ?? '' }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Sejarah Singkat Pendirian</label>
                    <textarea name="history" rows="3" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">{{ $profile->history ?? '' }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold shadow-sm transition-colors">
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>

        <!-- Sakelar Fitur & Kendali Live (5 cols) -->
        <div class="lg:col-span-5 bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm space-y-4">
            <h2 class="text-base font-bold text-navy-deep flex items-center gap-2 border-b border-surface-container-low pb-3">
                <span class="material-symbols-outlined text-amber-primary">toggle_on</span>
                <span>Kendali Tampilan Beranda Publik</span>
            </h2>

            <form action="{{ route('admin.konten.pengaturan.toggles') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-3 text-xs">
                    <div class="flex items-center justify-between p-3 rounded bg-surface-container-low">
                        <div>
                            <span class="font-bold text-navy-deep block">Hero Banner & Pengumuman Utama</span>
                            <span class="text-secondary text-[11px]">Tampilkan slider hero beranda</span>
                        </div>
                        <input type="checkbox" name="show_hero" value="1" checked class="w-4 h-4 accent-amber-primary"/>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded bg-surface-container-low">
                        <div>
                            <span class="font-bold text-navy-deep block">Widget Jam Salat Real-time</span>
                            <span class="text-secondary text-[11px]">Tampilkan 6 slot jadwal salat di beranda</span>
                        </div>
                        <input type="checkbox" name="show_prayer_widget" value="1" checked class="w-4 h-4 accent-amber-primary"/>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded bg-surface-container-low">
                        <div>
                            <span class="font-bold text-navy-deep block">Banner Petugas Jum'at Terdekat</span>
                            <span class="text-secondary text-[11px]">Tampilkan khatib & imam pekan ini</span>
                        </div>
                        <input type="checkbox" name="show_friday_officer" value="1" checked class="w-4 h-4 accent-amber-primary"/>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded bg-surface-container-low">
                        <div>
                            <span class="font-bold text-navy-deep block">Form Donasi / Sedekah Cepat</span>
                            <span class="text-secondary text-[11px]">Formulir nominal dan pilihan program</span>
                        </div>
                        <input type="checkbox" name="show_donation_form" value="1" checked class="w-4 h-4 accent-amber-primary"/>
                    </div>

                    <div class="flex items-center justify-between p-3 rounded bg-surface-container-low">
                        <div>
                            <span class="font-bold text-navy-deep block">Galeri Foto & Testimoni</span>
                            <span class="text-secondary text-[11px]">Cuplikan foto dan doa donatur</span>
                        </div>
                        <input type="checkbox" name="show_gallery_testimonials" value="1" checked class="w-4 h-4 accent-amber-primary"/>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 rounded-full bg-navy-card hover:bg-navy-accent text-pure-white text-xs font-bold transition-colors">
                        Terapkan Pengaturan Fitur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
