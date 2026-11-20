@extends('layouts.admin')

@section('title', 'Rekening Bank & Sertifikat QRIS')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-navy-deep">Rekening Bank Resmi & QRIS Nasional</h1>
        <p class="text-xs text-secondary mt-0.5">Kelola nomor rekening bank syariah, bank daerah sulutgo, dan barcode QRIS BKM Al-Fattah.</p>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- Form Rekening Bank (7 cols) -->
        <div class="lg:col-span-7 bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm space-y-5">
            <h2 class="text-base font-bold text-navy-deep flex items-center gap-2 border-b border-surface-container-low pb-3">
                <span class="material-symbols-outlined text-amber-primary">account_balance</span>
                <span>Konfigurasi Rekening Bank Resmi</span>
            </h2>

            <form action="{{ route('admin.keuangan.rekening.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <!-- BSI -->
                <div class="p-4 rounded-DEFAULT bg-surface-container-low space-y-3">
                    <span class="text-xs font-bold text-tertiary uppercase tracking-wider block">Rekening Utama: Bank Syariah Indonesia (BSI)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-navy-deep mb-1">Nomor Rekening *</label>
                            <input type="text" name="rekening_bsi" value="{{ $profile->rekening_bsi ?? '7182938192' }}" required class="w-full px-3 py-2 rounded bg-surface-container-lowest text-navy-deep text-xs font-mono font-bold"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-navy-deep mb-1">Atas Nama Rekening *</label>
                            <input type="text" name="rekening_bsi_an" value="{{ $profile->rekening_bsi_an ?? 'BKM Masjid Al-Fattah Ongkaw' }}" required class="w-full px-3 py-2 rounded bg-surface-container-lowest text-navy-deep text-xs"/>
                        </div>
                    </div>
                </div>

                <!-- Bank SulutGo -->
                <div class="p-4 rounded-DEFAULT bg-surface-container-low space-y-3">
                    <span class="text-xs font-bold text-navy-deep uppercase tracking-wider block">Rekening Pembangunan: Bank SulutGo (BSG)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-navy-deep mb-1">Nomor Rekening *</label>
                            <input type="text" name="rekening_sulutgo" value="{{ $profile->rekening_sulutgo ?? '00402110092834' }}" required class="w-full px-3 py-2 rounded bg-surface-container-lowest text-navy-deep text-xs font-mono font-bold"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-navy-deep mb-1">Atas Nama Rekening *</label>
                            <input type="text" name="rekening_sulutgo_an" value="{{ $profile->rekening_sulutgo_an ?? 'Panitia Pembangunan Al-Fattah' }}" required class="w-full px-3 py-2 rounded bg-surface-container-lowest text-navy-deep text-xs"/>
                        </div>
                    </div>
                </div>

                <!-- QRIS Image / File -->
                <div class="p-4 rounded-DEFAULT bg-surface-container-low space-y-3">
                    <span class="text-xs font-bold text-amber-hover uppercase tracking-wider block">Sertifikat Barcode QRIS Standar BI</span>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Unggah Berkas Gambar QRIS</label>
                        <input type="file" name="qris_file" accept="image/*" class="w-full text-xs text-on-surface-variant file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:bg-surface-container-high file:text-navy-deep hover:file:bg-amber-primary hover:file:text-white cursor-pointer"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Atau Path / URL QRIS</label>
                        <input type="text" name="qris_image_path" value="{{ $profile->qris_image_path ?? '' }}" placeholder="/uploads/qris/qris_alfattah.png" class="w-full px-3 py-2 rounded bg-surface-container-lowest text-navy-deep text-xs font-mono"/>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold shadow-sm transition-colors">
                        Simpan Rekening & QRIS
                    </button>
                </div>
            </form>
        </div>

        <!-- Preview QRIS & Keamanan (5 cols) -->
        <div class="lg:col-span-5 space-y-4">
            <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm text-center flex flex-col items-center">
                <span class="px-3 py-1 rounded-full bg-amber-glow text-primary text-xs font-bold uppercase tracking-wider mb-3">
                    Pratinjau QRIS Web
                </span>
                <div class="p-4 bg-pure-white rounded-DEFAULT shadow-md border border-surface-container flex flex-col items-center">
                    <svg class="w-44 h-44 text-navy-deep" fill="currentColor" viewBox="0 0 200 200">
                        <rect fill="none" height="50" stroke="currentColor" stroke-width="12" width="50" x="10" y="10"></rect>
                        <rect height="20" width="20" x="25" y="25"></rect>
                        <rect fill="none" height="50" stroke="currentColor" stroke-width="12" width="50" x="140" y="10"></rect>
                        <rect height="20" width="20" x="155" y="25"></rect>
                        <rect fill="none" height="50" stroke="currentColor" stroke-width="12" width="50" x="10" y="140"></rect>
                        <rect height="20" width="20" x="25" y="155"></rect>
                        <rect height="12" width="12" x="75" y="15"></rect>
                        <rect height="20" width="12" x="95" y="25"></rect>
                        <rect height="12" width="15" x="115" y="15"></rect>
                        <rect height="15" width="20" x="75" y="45"></rect>
                        <rect height="25" width="15" x="105" y="45"></rect>
                        <rect height="15" width="30" x="15" y="75"></rect>
                        <rect height="20" width="20" x="55" y="75"></rect>
                        <rect height="15" width="30" x="85" y="80"></rect>
                        <rect height="30" width="25" x="130" y="75"></rect>
                        <rect height="15" width="25" x="165" y="75"></rect>
                        <rect height="25" width="25" x="20" y="100"></rect>
                        <rect height="30" width="15" x="65" y="105"></rect>
                        <rect height="25" width="25" x="90" y="105"></rect>
                        <rect height="15" width="30" x="125" y="115"></rect>
                        <rect height="35" width="20" x="165" y="100"></rect>
                        <rect height="40" width="15" x="75" y="145"></rect>
                        <rect height="18" width="25" x="100" y="140"></rect>
                        <rect height="20" width="20" x="135" y="145"></rect>
                        <rect height="40" width="25" x="165" y="145"></rect>
                        <rect height="18" width="35" x="105" y="170"></rect>
                    </svg>
                </div>
                <p class="text-xs font-bold text-navy-deep mt-3">NMID: ID1024392819280</p>
                <p class="text-[11px] text-secondary">BKM MASJID AL FATTAH ONGKAW 3</p>
                <div class="mt-4 p-3 rounded bg-surface-container-low text-left text-xs space-y-1 text-secondary">
                    <div class="flex items-center gap-1 text-success font-semibold">
                        <span class="material-symbols-outlined text-sm">security</span> Terdaftar Resmi Bank Indonesia
                    </div>
                    <p class="text-[11px]">Setiap donasi QRIS masuk langsung ke rekening giro kas masjid tanpa potongan perantara.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
