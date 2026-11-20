@extends('layouts.public')

@section('title', 'Kontak & Sekretariat BKM')

@section('content')
<div class="flex flex-col w-full">
    <!-- Header Hero -->
    <section class="relative overflow-hidden bg-gradient-to-b from-sky-dawn-from/50 via-surface to-background py-16 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto text-center space-y-4 max-w-3xl">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-high/80 shadow-sm">
                <span class="material-symbols-outlined text-amber-primary text-base">support_agent</span>
                <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider">Layanan Jamaah & Aspirasi</span>
            </div>
            <h1 class="text-3xl lg:text-5xl font-extrabold text-navy-deep tracking-tight">
                Hubungi Sekretariat Masjid Al-Fattah
            </h1>
            <p class="text-base text-secondary leading-relaxed">
                Kami siap melayani kebutuhan informasi jadwal, peminjaman aula syiar, pendaftaran santri TPA, konsultasi keluarga, serta menerima infaq dan wakaf.
            </p>
        </div>
    </section>

    <!-- Main Content: Contact Cards & Form -->
    <section class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-12">
        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-8 p-6 bg-amber-glow rounded-DEFAULT border border-amber-primary/40 flex items-center gap-4 text-navy-deep shadow-sm">
                <span class="material-symbols-outlined text-3xl text-amber-primary">check_circle</span>
                <div>
                    <h4 class="font-bold text-base">Alhamdulillah, Pesan Anda Berhasil Dikirimkan!</h4>
                    <p class="text-xs text-on-surface-variant mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <!-- Left: Info Cards & Map (5 Cols) -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Address Card -->
                <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-glow flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined text-xl">location_on</span>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-navy-deep">Lokasi & Alamat</h3>
                            <p class="text-xs text-secondary mt-1 leading-relaxed">
                                {{ $profile->address ?? 'Jl. Trans Sulawesi, Desa Ongkaw 3, Jaga II, Kec. Sinonsayang, Kabupaten Minahasa Selatan, Sulawesi Utara 95357' }}
                            </p>
                            <span class="text-[11px] text-on-surface-variant mt-2 block">Koordinat: 0.912° LU, 124.365° BT (Arah Kiblat 291.4°)</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Channels -->
                <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-navy-deep">Saluran Komunikasi Cepat</h3>
                    <div class="space-y-3">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->phone ?? '081234567890') }}" target="_blank" class="flex items-center justify-between p-3 rounded-DEFAULT bg-surface-container-low hover:bg-surface-container transition-colors">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-success text-xl">chat</span>
                                <div>
                                    <span class="text-xs font-bold text-navy-deep block">WhatsApp Sekretariat</span>
                                    <span class="text-xs text-secondary">{{ $profile->phone ?? '0812-3456-7890' }}</span>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-secondary text-sm">open_in_new</span>
                        </a>

                        <a href="mailto:{{ $profile->email ?? 'sekretariat@alfattah-ongkaw.id' }}" class="flex items-center justify-between p-3 rounded-DEFAULT bg-surface-container-low hover:bg-surface-container transition-colors">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-tertiary text-xl">mail</span>
                                <div>
                                    <span class="text-xs font-bold text-navy-deep block">Email Resmi</span>
                                    <span class="text-xs text-secondary">{{ $profile->email ?? 'sekretariat@alfattah-ongkaw.id' }}</span>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-secondary text-sm">open_in_new</span>
                        </a>

                        <div class="flex items-center justify-between p-3 rounded-DEFAULT bg-surface-container-low">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-primary text-xl">schedule</span>
                                <div>
                                    <span class="text-xs font-bold text-navy-deep block">Jam Pelayanan Sekretariat</span>
                                    <span class="text-xs text-secondary">Setiap Hari: 04.00 - 21.00 WITA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm">
                    <div class="h-64 w-full">
                        <iframe 
                            src="https://maps.google.com/maps?q=Ongkaw%203,%20Sinonsayang,%20Minahasa%20Selatan&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Right: Interactive Inbox Form (7 Cols) -->
            <div class="lg:col-span-7 bg-surface-container-lowest rounded-DEFAULT p-6 sm:p-8 shadow-sm">
                <div class="mb-6">
                    <span class="text-xs font-bold text-amber-primary uppercase tracking-wider">Formulir Pesan</span>
                    <h2 class="text-2xl font-bold text-navy-deep mt-1">Kirimkan Permohonan atau Masukan</h2>
                    <p class="text-xs text-secondary mt-1">Pesan Anda akan langsung masuk ke Dashboard Pengurus BKM Al-Fattah untuk segera ditindaklanjuti.</p>
                </div>

                <form action="{{ route('kontak.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-navy-deep uppercase tracking-wider mb-1">Nama Lengkap *</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 bg-surface-container-low text-navy-deep rounded-DEFAULT text-sm focus:outline-none focus:ring-2 focus:ring-amber-primary" placeholder="Masukkan nama Anda"/>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-navy-deep uppercase tracking-wider mb-1">Nomor WhatsApp / HP</label>
                            <input type="text" name="phone" class="w-full px-4 py-3 bg-surface-container-low text-navy-deep rounded-DEFAULT text-sm focus:outline-none focus:ring-2 focus:ring-amber-primary" placeholder="Contoh: 081234567890"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-navy-deep uppercase tracking-wider mb-1">Alamat Email (Opsional)</label>
                            <input type="email" name="email" class="w-full px-4 py-3 bg-surface-container-low text-navy-deep rounded-DEFAULT text-sm focus:outline-none focus:ring-2 focus:ring-amber-primary" placeholder="nama@email.com"/>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-navy-deep uppercase tracking-wider mb-1">Kategori Kepentingan *</label>
                        <select name="category" required class="w-full px-4 py-3 bg-surface-container-low text-navy-deep rounded-DEFAULT text-sm focus:outline-none focus:ring-2 focus:ring-amber-primary cursor-pointer">
                            <option value="pertanyaan">Pertanyaan Umum & Jadwal</option>
                            <option value="doa">Permohonan Doa Bersama</option>
                            <option value="pinjam_aula">Permohonan Izin / Pinjam Fasilitas Aula</option>
                            <option value="pendaftaran_tpa">Pendaftaran Santri TPA Al-Fattah</option>
                            <option value="pengaduan">Aspirasi / Saran Kebersihan & Kenyamanan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-navy-deep uppercase tracking-wider mb-1">Isi Pesan / Aspirasi *</label>
                        <textarea name="message" rows="5" required class="w-full px-4 py-3 bg-surface-container-low text-navy-deep rounded-DEFAULT text-sm focus:outline-none focus:ring-2 focus:ring-amber-primary" placeholder="Tuliskan pesan, permohonan, atau aspirasi Anda secara rinci di sini..."></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-sm font-bold shadow-md transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">send</span>
                            <span>Kirimkan Pesan Sekarang</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
