@extends('layouts.admin')

@section('title', 'Program Infaq & Target Donasi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Program Infaq & Target Capaian</h1>
            <p class="text-xs text-secondary mt-0.5">Kelola pos penggalangan dana umat, target anggaran, dan progres serapan sedekah.</p>
        </div>
        <button onclick="document.getElementById('modal-program').classList.remove('hidden')" class="px-4 py-2 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all">
            <span class="material-symbols-outlined text-base">add</span> + Tambah Program Baru
        </button>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($programs as $prog)
            @php
                $target = $prog->target_amount ?: 1;
                $percent = min(100, round(($prog->collected_amount / $target) * 100));
            @endphp
            <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm flex flex-col justify-between border border-surface-container">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-glow text-on-primary-container uppercase">
                            {{ $prog->category ?? 'Sosial' }}
                        </span>
                        <div class="flex items-center gap-1">
                            @if($prog->is_featured)
                                <span class="px-2 py-0.5 rounded-full bg-amber-primary text-pure-white text-[10px] font-bold">Unggulan</span>
                            @endif
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $prog->is_active ? 'bg-success/20 text-success' : 'bg-surface-container text-secondary' }}">
                                {{ $prog->is_active ? 'Aktif' : 'Non-aktif' }}
                            </span>
                        </div>
                    </div>
                    <h3 class="text-base font-bold text-navy-deep">{{ $prog->title }}</h3>
                    <p class="text-xs text-secondary mt-1.5 line-clamp-3 leading-relaxed">{{ $prog->description }}</p>
                </div>

                <div class="mt-6 pt-4 border-t border-surface-container-low">
                    <div class="flex justify-between items-baseline mb-1 text-xs font-bold">
                        <span class="text-navy-deep">Rp{{ number_format($prog->collected_amount, 0, ',', '.') }}</span>
                        <span class="text-amber-hover">{{ $percent }}%</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-border-subtle overflow-hidden">
                        <div class="h-full bg-amber-primary rounded-full" style="width: {{ $percent }}%;"></div>
                    </div>
                    <div class="flex justify-between items-center text-[11px] text-secondary mt-2">
                        <span>Target: Rp{{ number_format($prog->target_amount, 0, ',', '.') }}</span>
                        <span>Sisa: Rp{{ number_format(max(0, $prog->target_amount - $prog->collected_amount), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Tambah Program -->
    <div id="modal-program" class="fixed inset-0 z-50 bg-navy-deep/80 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest rounded-DEFAULT max-w-lg w-full p-6 shadow-2xl relative">
            <button onclick="document.getElementById('modal-program').classList.add('hidden')" class="absolute top-4 right-4 text-secondary hover:text-navy-deep p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-base font-bold text-navy-deep mb-4">Buat Program Infaq Baru</h3>
            <form action="{{ route('admin.keuangan.programs.store') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Nama Program *</label>
                    <input type="text" name="title" required placeholder="Contoh: Renovasi Fasilitas Tempat Wudhu" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Kategori *</label>
                        <select name="category" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs">
                            <option value="pendidikan">Pendidikan TPA</option>
                            <option value="operasional">Kemakmuran & Listrik</option>
                            <option value="sosial">Santunan Sosial & Dhuafa</option>
                            <option value="darurat">Ambulans & Darurat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Target Anggaran (Rp) *</label>
                        <input type="number" name="target_amount" min="100000" required placeholder="25000000" class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-navy-deep mb-1">Deskripsi & Peruntukan</label>
                    <textarea name="description" rows="3" placeholder="Rincian manfaat program dan estimasi penyaluran..." class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"></textarea>
                </div>
                <div class="flex items-center gap-4 text-xs font-semibold">
                    <label class="flex items-center gap-1.5 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="accent-amber-primary"/>
                        <span>Status Aktif</span>
                    </label>
                    <label class="flex items-center gap-1.5 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" class="accent-amber-primary"/>
                        <span>Tampilkan di Beranda (Unggulan)</span>
                    </label>
                </div>
                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold shadow-md transition-colors">
                        Simpan Program
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
