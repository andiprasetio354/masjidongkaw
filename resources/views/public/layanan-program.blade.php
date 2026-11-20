@extends('layouts.public')

@section('title', 'Layanan & Program Kemakmuran')

@section('content')
<div class="flex flex-col w-full">
    <!-- Header Hero -->
    <section class="relative overflow-hidden bg-gradient-to-b from-sky-dawn-from/50 via-surface to-background py-16 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto text-center space-y-4 max-w-3xl">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-high/80 shadow-sm">
                <span class="material-symbols-outlined text-amber-primary text-base">hub</span>
                <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider">Khidmat & Pelayanan Umat</span>
            </div>
            <h1 class="text-3xl lg:text-5xl font-extrabold text-navy-deep tracking-tight">
                Layanan Ibadah & Program Unggulan Masjid Al-Fattah
            </h1>
            <p class="text-base text-secondary leading-relaxed">
                Mendedikasikan fasilitas dan kegiatan untuk menopang kebutuhan spiritual, pendidikan Al-Qur'an generasi muda, dan kepedulian sosial warga di Minahasa Selatan.
            </p>
        </div>
    </section>

    <!-- Routine Services & Dakwah -->
    <section class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-12">
        <div class="flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-wider mb-2">
            <span class="w-6 h-0.5 bg-amber-primary"></span>
            <span>LAYANAN RUTIN SEPANJANG WAKTU</span>
        </div>
        <h2 class="text-2xl lg:text-3xl font-bold text-navy-deep mb-8">
            Fasilitas Ibadah & Kemaslahatan Harian
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($routines as $routine)
                <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
                    <div class="h-40 overflow-hidden relative">
                        <img src="{{ $routine->image ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuC3Q5hIv5JHyny405LyZzvPrp-ko9jpC0kTl-_h7VNUlQy4oIdVQTZE5LTapXsRpg3WOxkf1I6D38nkRT9sPIliZmanyXcmUb4Y44NEeS7jTt6eBA6M_XnQIJ5UlgDZjl5IBtpxmtpmm5l2fiIBaaB-XWGm1jXr7BfCmsHRz8w-2tvnGvt7mowiVuZaMMdKYeS13ZQcm2aRE1DNrfPp67GdvR4F2on0A9shmvzzzQ' }}" alt="{{ $routine->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-navy-deep/80 backdrop-blur-md text-pure-white text-[11px] font-semibold">
                            {{ $routine->schedule_day }}
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] text-amber-hover font-bold uppercase tracking-wider block mb-1">{{ $routine->time_slot }}</span>
                            <h3 class="text-base font-bold text-navy-deep group-hover:text-primary transition-colors">
                                {{ $routine->title }}
                            </h3>
                            <p class="text-xs text-secondary mt-2 line-clamp-3">
                                {{ $routine->description }}
                            </p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-surface-container-low flex items-center justify-between text-xs text-on-surface-variant">
                            <span>PIC: {{ $routine->pic_name ?? 'Sekretariat BKM' }}</span>
                            <span class="text-success font-semibold flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">check_circle</span> Aktif
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Social & Community Programs -->
    <section class="w-full bg-surface-container-low/50 py-16 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto space-y-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-wider mb-2">
                        <span class="w-6 h-0.5 bg-amber-primary"></span>
                        <span>PROGRAM DAKWAH & SOSIAL</span>
                    </div>
                    <h2 class="text-2xl lg:text-3xl font-bold text-navy-deep">
                        Pilar Program Kemaslahatan Ummat
                    </h2>
                </div>
                <a href="{{ route('sedekah') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold transition-all shadow-sm">
                    <span>Salurkan Donasi Program</span>
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($donationPrograms as $prog)
                    @php
                        $target = $prog->target_amount ?: 1;
                        $percent = min(100, round(($prog->collected_amount / $target) * 100));
                    @endphp
                    <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-glow text-on-primary-container capitalize">
                                    {{ $prog->category ?? 'Sosial' }}
                                </span>
                                <span class="text-xs text-secondary">{{ $prog->is_featured ? 'Program Utama' : 'Sedang Berjalan' }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-navy-deep">{{ $prog->title }}</h3>
                            <p class="text-xs text-secondary mt-2 line-clamp-3">{{ $prog->description }}</p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-surface-container-low">
                            <div class="flex justify-between items-baseline mb-1.5 text-xs font-bold">
                                <span class="text-navy-deep">Terkumpul: Rp{{ number_format($prog->collected_amount, 0, ',', '.') }}</span>
                                <span class="text-amber-hover">{{ $percent }}%</span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-border-subtle overflow-hidden">
                                <div class="h-full bg-amber-primary rounded-full" style="width: {{ $percent }}%;"></div>
                            </div>
                            <div class="flex justify-between items-center text-xs text-secondary mt-2">
                                <span>Target: Rp{{ number_format($prog->target_amount, 0, ',', '.') }}</span>
                                <a href="{{ route('sedekah') }}" class="text-primary font-bold hover:underline flex items-center gap-1">
                                    Donasi <span class="material-symbols-outlined text-xs">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fardhu Kifayah & Layanan Khusus Banner -->
    <section class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-16">
        <div class="bg-navy-deep text-pure-white rounded-lg p-8 lg:p-12 shadow-xl flex flex-col lg:flex-row items-center justify-between gap-8 relative overflow-hidden">
            <div class="space-y-4 max-w-xl">
                <span class="text-xs text-amber-primary uppercase tracking-widest font-bold block">Siaga 24 Jam</span>
                <h3 class="text-2xl lg:text-3xl font-extrabold text-pure-white">Layanan Ambulans & Penyelenggaraan Fardhu Kifayah Jenazah</h3>
                <p class="text-sm text-secondary-fixed-dim leading-relaxed">
                    Masjid Al-Fattah menyediakan kain kafan, pemandian jenazah, shalat jenazah, serta armada pengantaran ambulans secara cuma-cuma bagi jamaah dan warga muslim di Ongkaw 3 dan sekitarnya.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->phone ?? '081234567890') }}?text={{ urlencode('Assalamu\'alaikum, darurat fardhu kifayah / ambulans') }}" target="_blank" class="px-6 py-3.5 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white font-bold text-xs flex items-center justify-center gap-2 shadow-lg">
                    <span class="material-symbols-outlined">call</span>
                    <span>Hubungi Hotline Siaga</span>
                </a>
                <a href="{{ route('kontak') }}" class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-pure-white font-bold text-xs flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">info</span>
                    <span>Informasi Lengkap</span>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
