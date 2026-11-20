@extends('layouts.public')

@section('title', 'Sedekah & Transparansi Keuangan')

@section('content')
<div class="flex flex-col w-full">
    <!-- Top Atmospheric Banner with Islamic Geometric & Cloud Scrim -->
    <section class="relative overflow-hidden bg-gradient-to-b from-sky-dawn-from via-surface to-background pt-12 pb-20 px-6 lg:px-12">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-amber-glow/40 blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-80 h-80 rounded-full bg-tertiary-fixed/30 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <!-- Alert if redirected after submission -->
            @if(session('donation_success'))
                <div class="mb-8 p-6 bg-amber-glow rounded-DEFAULT border border-amber-primary/40 flex items-center gap-4 text-navy-deep shadow-md">
                    <span class="material-symbols-outlined text-3xl text-amber-primary">check_circle</span>
                    <div>
                        <h4 class="font-bold text-lg">Alhamdulillah, Donasi Anda Berhasil Dicatat!</h4>
                        <p class="text-sm">Kode Referensi: <span class="font-mono font-bold">{{ session('reference_code') }}</span> • Nominal: <strong>Rp{{ number_format(session('amount'), 0, ',', '.') }}</strong></p>
                        <p class="text-xs text-on-surface-variant mt-0.5">Notifikasi instan telah dikirimkan ke Telegram Bot Bendahara untuk verifikasi.</p>
                    </div>
                </div>
            @endif

            <!-- Top Pill Tag & Arabic Calligraphy Sub-text -->
            <div class="flex flex-col items-center text-center space-y-4 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-high/80 backdrop-blur-md shadow-sm">
                    <span class="material-symbols-outlined text-amber-primary text-base" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
                    <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider">Amanah & Transparansi Dana Umat</span>
                </div>
                <p class="font-serif text-2xl text-primary leading-loose pt-1">
                    مَثَلُ الَّذِينَ يُنْفِقُونَ أَمْوَالَهُمْ فِي سَبِيلِ اللَّهِ كَمَثَلِ حَبَّةٍ أَنْبَتَتْ سَبْعَ سَنَابِلَ
                </p>
                <h1 class="text-4xl lg:text-5xl text-navy-deep font-extrabold tracking-tight">
                    Tunaikan Sedekah & Infaq Terbaik untuk <span class="text-amber-primary">{{ $profile->name ?? 'Masjid Al-Fattah' }}</span>
                </h1>
                <p class="text-base text-secondary max-w-2xl mx-auto">
                    Penyaluran amanah yang transparan, akuntabel, dan berdampak langsung bagi kemaslahatan jamaah serta warga di Desa Ongkaw 3, Minahasa Selatan.
                </p>
            </div>

            <!-- Live Financial Transparency Key Metrics -->
            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Metric Card 1 -->
                <div class="relative bg-surface-container-lowest rounded-DEFAULT p-6 lg:p-8 shadow-sm flex flex-col justify-between overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-amber-glow/40 rounded-bl-full pointer-events-none transition-transform group-hover:scale-110"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-secondary uppercase tracking-wider">Infaq Masuk (Bulan Ini)</span>
                        <div class="w-10 h-10 rounded-full bg-amber-glow flex items-center justify-center text-amber-hover">
                            <span class="material-symbols-outlined text-xl">savings</span>
                        </div>
                    </div>
                    <div class="mt-6">
                        <span class="text-3xl text-navy-deep font-extrabold tracking-tight">Rp{{ number_format($infaqMonth, 0, ',', '.') }}</span>
                        <div class="flex items-center gap-1.5 mt-2 text-success text-xs font-semibold">
                            <span class="material-symbols-outlined text-base">trending_up</span>
                            <span>Tercatat real-time di sistem</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 lg:-mx-8 lg:-mb-8 px-6 lg:px-8 py-3 flex items-center justify-between text-on-surface-variant text-xs">
                        <span>Penerimaan Kas Berjalan</span>
                        <span class="font-semibold text-primary">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</span>
                    </div>
                </div>

                <!-- Metric Card 2 -->
                <div class="relative bg-surface-container-lowest rounded-DEFAULT p-6 lg:p-8 shadow-sm flex flex-col justify-between overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-sky-dawn-from rounded-bl-full pointer-events-none transition-transform group-hover:scale-110"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-secondary uppercase tracking-wider">Penyaluran & Operasional</span>
                        <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-tertiary">
                            <span class="material-symbols-outlined text-xl">outbox</span>
                        </div>
                    </div>
                    <div class="mt-6">
                        <span class="text-3xl text-navy-deep font-extrabold tracking-tight">Rp{{ number_format($pengeluaranMonth, 0, ',', '.') }}</span>
                        <div class="flex items-center gap-1.5 mt-2 text-secondary text-xs">
                            <span class="material-symbols-outlined text-base text-tertiary">task_alt</span>
                            <span>Program Penyaluran Terdistribusi</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 bg-surface-container-low/50 -mx-6 -mb-6 lg:-mx-8 lg:-mb-8 px-6 lg:px-8 py-3 flex items-center justify-between text-on-surface-variant text-xs">
                        <span>Akuntabilitas Publik</span>
                        <a class="text-tertiary font-semibold hover:underline flex items-center gap-1" href="#laporan-kas">
                            Detail <span class="material-symbols-outlined text-xs">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Metric Card 3 -->
                <div class="relative bg-navy-card rounded-DEFAULT p-6 lg:p-8 shadow-xl text-pure-white flex flex-col justify-between overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-amber-primary/10 rounded-full blur-xl pointer-events-none"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-secondary-fixed-dim uppercase tracking-wider">Saldo Kas Terjaga</span>
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-amber-primary">
                            <span class="material-symbols-outlined text-xl">account_balance</span>
                        </div>
                    </div>
                    <div class="mt-6">
                        <span class="text-3xl text-pure-white font-extrabold tracking-tight">Rp{{ number_format($saldoKas, 0, ',', '.') }}</span>
                        <p class="text-xs text-secondary-fixed-dim mt-2 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-success inline-block"></span> Terverifikasi Tim Audit & BKM
                        </p>
                    </div>
                    <div class="mt-4 pt-4 bg-white/5 -mx-6 -mb-6 lg:-mx-8 lg:-mb-8 px-6 lg:px-8 py-3 flex items-center justify-between text-xs">
                        <span class="text-secondary-fixed-dim">Terakhir disinkronkan</span>
                        <span class="font-mono text-amber-glow font-semibold">{{ date('d M Y, H:i') }} WITA</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Active Donation Programs -->
    <section class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <div class="flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-wider mb-2">
                    <span class="w-6 h-0.5 bg-amber-primary"></span>
                    <span>PROGRAM INFAQ & WAKAF PILIHAN</span>
                </div>
                <h2 class="text-3xl text-navy-deep font-bold tracking-tight">
                    Penyaluran Kebaikan Sedang Berjalan
                </h2>
            </div>
            <p class="text-sm text-secondary max-w-md">
                Pilihlah salah satu pos kebaikan yang paling dekat di hati Anda. Setiap rupiah disalurkan secara amanah dengan pelaporan terperinci.
            </p>
        </div>

        <!-- 4 Active Programs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($programs as $prog)
                @php
                    $target = $prog->target_amount ?: 1;
                    $percent = min(100, round(($prog->collected_amount / $target) * 100));
                @endphp
                <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                    <div class="relative h-44 overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $prog->image_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuAXLcztuR7QA6V50k1F5ANNoGpZ8jNfm5x8AHYyT0TLP7_uhs5IPlSOfx8RtW5X6coBBn-b9G37_A3Tv2PqPDnV1kS0Gx7x5exPHebqnwivYIY5YtsYcOx0PHFii5N9sdt4XTjnAoQ7fOXT_1QlbtKLV33il8YVpgqILFG_5Be5C_56GOgvmbZ1vdpIO6rVhcL8zJbe-G_XgEZ4HRtq6hCAycb8BgjjhlLIS1qWtw' }}" alt="{{ $prog->title }}"/>
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-navy-deep/80 backdrop-blur-md text-pure-white text-xs font-semibold capitalize">
                            {{ $prog->category ?? 'Program' }}
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-base text-navy-deep font-bold leading-snug group-hover:text-primary transition-colors">
                                {{ $prog->title }}
                            </h3>
                            <p class="text-xs text-secondary mt-2 line-clamp-2">
                                {{ $prog->description }}
                            </p>
                        </div>
                        <div class="mt-6 pt-4 bg-surface-container-low/40 -mx-5 -mb-5 p-5">
                            <div class="flex justify-between items-baseline mb-1.5 text-xs">
                                <span class="text-navy-deep font-bold">Rp{{ number_format($prog->collected_amount, 0, ',', '.') }}</span>
                                <span class="text-amber-hover font-bold">{{ $percent }}%</span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-border-subtle overflow-hidden">
                                <div class="h-full bg-amber-primary rounded-full" style="width: {{ $percent }}%;"></div>
                            </div>
                            <div class="flex justify-between items-center text-secondary text-xs mt-2">
                                <span>Target: Rp{{ number_format($prog->target_amount, 0, ',', '.') }}</span>
                                <span>{{ $prog->is_featured ? 'Unggulan' : 'Aktif' }}</span>
                            </div>
                            <button class="w-full mt-4 py-2.5 px-4 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-semibold transition-all shadow-sm flex items-center justify-center gap-1.5" onclick="selectProgram({{ $prog->id }})">
                                <span>Salurkan Donasi</span>
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Interactive Donation Flow & Payment Form -->
    <section class="w-full bg-surface-container-low py-16 px-6 lg:px-12" id="form-sedekah">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold text-primary uppercase tracking-wider">Formulir Shodaqoh Digital</span>
                <h2 class="text-3xl text-navy-deep font-bold mt-2">
                    Kirimkan Sedekah Cepat & Aman
                </h2>
                <p class="text-sm text-secondary mt-2">
                    Pilih nominal yang dikehendaki, dapatkan instruksi pembayaran QRIS instan atau salin nomor rekening bank resmi BKM Al-Fattah.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left: Interactive Form (7 Cols) -->
                <div class="lg:col-span-7 bg-surface-container-lowest rounded-DEFAULT p-6 sm:p-8 shadow-sm space-y-6">
                    <form action="{{ route('sedekah.submit') }}" method="POST" enctype="multipart/form-data" id="donation-form">
                        @csrf
                        <!-- Step 1: Program Targeted -->
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-navy-deep uppercase tracking-wider mb-2">1. Pilih Program Kebaikan</label>
                            <div class="relative">
                                <select name="program_id" id="selected-program-select" class="w-full bg-surface-container-low text-navy-deep px-4 py-3 rounded-DEFAULT text-sm appearance-none focus:outline-none focus:ring-2 focus:ring-amber-primary pr-10 cursor-pointer">
                                    <option value="">-- Infaq & Sedekah Umum Operasional --</option>
                                    @foreach($programs as $prog)
                                        <option value="{{ $prog->id }}">{{ $prog->title }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-3.5 text-secondary pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <!-- Step 2: Nominal Chips & Frequency -->
                        <div class="mb-5">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold text-navy-deep uppercase tracking-wider">2. Nominal Sedekah</label>
                                <div class="bg-surface-container-high p-1 rounded-full flex items-center text-xs">
                                    <input type="hidden" name="frequency" id="input-frequency" value="sekali"/>
                                    <button class="freq-btn px-3 py-1 rounded-full bg-surface-container-lowest text-navy-deep font-semibold shadow-sm transition-all" onclick="setFrequency('sekali', this)" type="button">Sekali</button>
                                    <button class="freq-btn px-3 py-1 rounded-full text-secondary hover:text-navy-deep font-medium transition-all" onclick="setFrequency('harian', this)" type="button">Harian</button>
                                    <button class="freq-btn px-3 py-1 rounded-full text-secondary hover:text-navy-deep font-medium transition-all" onclick="setFrequency('bulanan', this)" type="button">Bulanan</button>
                                </div>
                            </div>
                            <!-- Chips Group -->
                            <div class="grid grid-cols-3 sm:grid-cols-5 gap-2.5 pt-1">
                                <button class="chip-btn py-2.5 px-2 rounded-DEFAULT bg-surface-container-low hover:bg-surface-container text-navy-deep text-xs font-bold transition-all text-center" onclick="setAmount(50000, this)" type="button">
                                    Rp50.000
                                </button>
                                <button class="chip-btn py-2.5 px-2 rounded-DEFAULT bg-amber-primary text-pure-white text-xs font-bold transition-all text-center shadow-sm" onclick="setAmount(100000, this)" type="button">
                                    Rp100.000
                                </button>
                                <button class="chip-btn py-2.5 px-2 rounded-DEFAULT bg-surface-container-low hover:bg-surface-container text-navy-deep text-xs font-bold transition-all text-center" onclick="setAmount(200000, this)" type="button">
                                    Rp200.000
                                </button>
                                <button class="chip-btn py-2.5 px-2 rounded-DEFAULT bg-surface-container-low hover:bg-surface-container text-navy-deep text-xs font-bold transition-all text-center" onclick="setAmount(500000, this)" type="button">
                                    Rp500.000
                                </button>
                                <button class="chip-btn py-2.5 px-2 rounded-DEFAULT bg-surface-container-low hover:bg-surface-container text-navy-deep text-xs font-bold transition-all text-center" onclick="setAmount(1000000, this)" type="button">
                                    Rp1.000.000
                                </button>
                            </div>
                            <!-- Custom Input Field -->
                            <div class="relative mt-3">
                                <span class="absolute left-4 top-3.5 font-bold text-navy-deep text-sm">Rp</span>
                                <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low text-navy-deep rounded-DEFAULT text-lg font-bold focus:outline-none focus:ring-2 focus:ring-amber-primary" id="custom-amount" name="amount" placeholder="Nominal lainnya (minimal 10.000)" type="number" min="10000" value="100000" required/>
                            </div>
                        </div>

                        <!-- Step 3: Donor Identity with Anonymous Option -->
                        <div class="space-y-4 mb-5">
                            <label class="block text-xs font-bold text-navy-deep uppercase tracking-wider">3. Data Diri & Niat Doa</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <input class="w-full px-4 py-3 bg-surface-container-low text-navy-deep rounded-DEFAULT text-sm focus:outline-none focus:ring-2 focus:ring-amber-primary" id="donor-name" name="donor_name" placeholder="Nama Lengkap Donatur" type="text"/>
                                </div>
                                <div>
                                    <input class="w-full px-4 py-3 bg-surface-container-low text-navy-deep rounded-DEFAULT text-sm focus:outline-none focus:ring-2 focus:ring-amber-primary" name="phone_wa" placeholder="Nomor WhatsApp (Aktif)" type="text"/>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 pt-1">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input class="sr-only peer" id="anonim-check" name="is_anonymous" value="1" onchange="toggleAnonim(this)" type="checkbox"/>
                                    <div class="w-9 h-5 bg-surface-container-high peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-amber-primary"></div>
                                    <span class="ml-3 text-xs text-navy-deep font-medium">Sembunyikan nama saya (Tampil sebagai 'Hamba Allah')</span>
                                </label>
                            </div>
                            <div>
                                <textarea class="w-full px-4 py-3 bg-surface-container-low text-navy-deep rounded-DEFAULT text-sm focus:outline-none focus:ring-2 focus:ring-amber-primary" name="donor_prayer" placeholder="Tuliskan doa atau hajat kebaikan Anda di sini (akan ditampilkan di dinding doa)..." rows="2"></textarea>
                            </div>
                        </div>

                        <!-- Step 4: Payment Method Selection -->
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-navy-deep uppercase tracking-wider mb-2">4. Metode Pembayaran</label>
                            <input type="hidden" name="payment_method" id="input-payment-method" value="qris"/>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <button class="pay-method p-3 rounded-DEFAULT bg-surface-container-high text-navy-deep text-center transition-all flex flex-col items-center justify-center gap-1 shadow-sm ring-2 ring-amber-primary" onclick="setMethod('qris', this)" type="button">
                                    <span class="material-symbols-outlined text-2xl text-amber-primary">qr_code_scanner</span>
                                    <span class="text-xs font-bold">QRIS Instant</span>
                                </button>
                                <button class="pay-method p-3 rounded-DEFAULT bg-surface-container-low text-navy-deep text-center transition-all flex flex-col items-center justify-center gap-1 hover:bg-surface-container" onclick="setMethod('transfer_bsi', this)" type="button">
                                    <span class="material-symbols-outlined text-2xl text-secondary">account_balance</span>
                                    <span class="text-xs font-bold">BSI (Syariah)</span>
                                </button>
                                <button class="pay-method p-3 rounded-DEFAULT bg-surface-container-low text-navy-deep text-center transition-all flex flex-col items-center justify-center gap-1 hover:bg-surface-container" onclick="setMethod('transfer_sulutgo', this)" type="button">
                                    <span class="material-symbols-outlined text-2xl text-secondary">domain</span>
                                    <span class="text-xs font-bold">Bank SulutGo</span>
                                </button>
                                <button class="pay-method p-3 rounded-DEFAULT bg-surface-container-low text-navy-deep text-center transition-all flex flex-col items-center justify-center gap-1 hover:bg-surface-container" onclick="setMethod('tunai_kotak', this)" type="button">
                                    <span class="material-symbols-outlined text-2xl text-secondary">savings</span>
                                    <span class="text-xs font-bold">Kotak Infaq</span>
                                </button>
                            </div>
                        </div>

                        <!-- Upload Proof Slip Option -->
                        <div class="mb-6">
                            <label class="block text-xs font-bold text-navy-deep uppercase tracking-wider mb-1">Unggah Struk / Bukti Transfer (Opsional)</label>
                            <input type="file" name="proof_slip" accept="image/*,.pdf" class="w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-surface-container-high file:text-navy-deep hover:file:bg-amber-primary hover:file:text-white cursor-pointer"/>
                        </div>

                        <!-- CTA Submit Button -->
                        <button class="w-full py-4 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-base font-bold shadow-md transition-all transform active:scale-[0.99] flex items-center justify-center gap-2" type="submit">
                            <span class="material-symbols-outlined">favorite</span>
                            <span>Tunaikan Shodaqoh Sekarang</span>
                        </button>
                    </form>
                </div>

                <!-- Right: Dynamic Payment Instruction & Bank Cards (5 Cols) -->
                <div class="lg:col-span-5 space-y-6">
                    <!-- QRIS Showcase Card -->
                    <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm flex flex-col items-center text-center">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-glow text-primary text-xs font-semibold mb-4">
                            <span class="material-symbols-outlined text-sm">bolt</span>
                            <span>QRIS Terverifikasi Otomatis</span>
                        </div>
                        <!-- Dynamic Mock QRIS Code -->
                        <div class="relative p-4 bg-pure-white rounded-DEFAULT shadow-md flex flex-col items-center">
                            <svg class="w-48 h-48 text-navy-deep" fill="currentColor" viewBox="0 0 200 200">
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
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-10 h-10 rounded-full bg-amber-primary text-pure-white flex items-center justify-center shadow-lg border-2 border-white">
                                    <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">mosque</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-navy-deep mt-4">NMID: ID1024392819280</p>
                        <p class="text-xs text-secondary mt-1">BKM MASJID AL FATTAH ONGKAW 3</p>
                        <div class="flex items-center gap-2 text-on-surface-variant text-xs mt-3 bg-surface-container-low px-4 py-2 rounded-full">
                            <span class="material-symbols-outlined text-success text-base">verified</span>
                            <span>Mendukung GoPay, OVO, ShopeePay, Livin Mandiri, BSI, BCA</span>
                        </div>
                    </div>

                    <!-- Official Bank Accounts List with Instant Clipboard Copy -->
                    <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm space-y-4">
                        <h4 class="text-base text-navy-deep font-bold flex items-center justify-between">
                            <span>Rekening Resmi BKM</span>
                            <span class="material-symbols-outlined text-amber-primary">lock</span>
                        </h4>
                        <!-- Bank 1: BSI -->
                        <div class="p-3.5 rounded-DEFAULT bg-surface-container-low flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-tertiary/10 text-tertiary flex items-center justify-center font-bold text-xs">
                                    BSI
                                </div>
                                <div>
                                    <p class="text-xs text-navy-deep font-bold">Bank Syariah Indonesia</p>
                                    <p class="font-mono text-sm text-secondary font-semibold">718-2938-192</p>
                                    <p class="text-[11px] text-on-surface-variant">a.n. BKM Al-Fattah Ongkaw</p>
                                </div>
                            </div>
                            <button class="p-2 rounded-full hover:bg-surface-container text-primary transition-colors" onclick="copyToClipboard('7182938192', this)" title="Salin Nomor" type="button">
                                <span class="material-symbols-outlined text-lg">content_copy</span>
                            </button>
                        </div>
                        <!-- Bank 2: Bank SulutGo -->
                        <div class="p-3.5 rounded-DEFAULT bg-surface-container-low flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-secondary-fixed text-navy-deep flex items-center justify-center font-bold text-xs">
                                    BSG
                                </div>
                                <div>
                                    <p class="text-xs text-navy-deep font-bold">Bank SulutGo</p>
                                    <p class="font-mono text-sm text-secondary font-semibold">004-02-11-009283-4</p>
                                    <p class="text-[11px] text-on-surface-variant">a.n. Panitia Pembangunan Al-Fattah</p>
                                </div>
                            </div>
                            <button class="p-2 rounded-full hover:bg-surface-container text-primary transition-colors" onclick="copyToClipboard('00402110092834', this)" title="Salin Nomor" type="button">
                                <span class="material-symbols-outlined text-lg">content_copy</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Financial Transparency & Disbursement Ledger -->
    <section class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-20" id="laporan-kas">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <div class="flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-wider mb-2">
                    <span class="w-6 h-0.5 bg-amber-primary"></span>
                    <span>AKUNTABILITAS & KETERBUKAAN</span>
                </div>
                <h2 class="text-3xl text-navy-deep font-bold tracking-tight">
                    Laporan Realisasi Kas Masjid
                </h2>
            </div>
            <button class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-surface-container-high hover:bg-surface-container-highest text-navy-deep text-xs font-semibold transition-all shadow-sm" onclick="window.print()">
                <span class="material-symbols-outlined text-lg text-amber-hover">print</span>
                <span>Cetak Laporan Kas</span>
            </button>
        </div>

        <!-- Disbursement Ledger Table -->
        <div class="bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm">
            <div class="p-6 bg-surface-container-low flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-xl">account_balance_wallet</span>
                    <span class="text-base text-navy-deep font-bold">Mutasi Penyaluran & Penerimaan Kas Terakhir</span>
                </div>
                <span class="text-xs text-secondary">Status: Terverifikasi oleh Bendahara BKM</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-surface-container-high/40 text-on-surface-variant text-xs uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Tanggal</th>
                            <th class="py-3.5 px-6">Keterangan / Pos</th>
                            <th class="py-3.5 px-6">Kategori</th>
                            <th class="py-3.5 px-6">Jenis Akun</th>
                            <th class="py-3.5 px-6 text-right">Jumlah</th>
                            <th class="py-3.5 px-6 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low text-navy-deep">
                        @foreach($mutations as $mut)
                            <tr class="hover:bg-surface-container-low/40 transition-colors">
                                <td class="py-4 px-6 font-mono text-xs text-secondary">{{ \Carbon\Carbon::parse($mut->transaction_date)->translatedFormat('d M Y') }}</td>
                                <td class="py-4 px-6 font-medium">{{ $mut->description }}</td>
                                <td class="py-4 px-6">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $mut->type === 'masuk' ? 'bg-amber-glow text-on-primary-container' : 'bg-surface-container-high text-navy-accent' }}">
                                        {{ $mut->category }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-secondary text-xs uppercase">{{ $mut->account_type }}</td>
                                <td class="py-4 px-6 text-right font-mono font-bold {{ $mut->type === 'masuk' ? 'text-success' : 'text-error' }}">
                                    {{ $mut->type === 'masuk' ? '+' : '-' }} Rp{{ number_format($mut->amount, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center gap-1 text-success text-xs font-semibold">
                                        <span class="material-symbols-outlined text-sm">check_circle</span> Valid
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Section: Real-time Donor Wall & Prayer Testimonials -->
    <section class="w-full bg-gradient-to-b from-surface via-surface-container-low/30 to-surface py-16 px-6 lg:px-12">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold text-primary uppercase tracking-wider">Untaian Doa Jamaah</span>
                <h2 class="text-3xl text-navy-deep font-bold mt-2">
                    Dinding Kebaikan & Doa Para Donatur
                </h2>
                <p class="text-sm text-secondary mt-2">
                    "Barangsiapa yang membangun sebuah masjid karena Allah, maka Allah akan membangunkan untuknya sebuah rumah di surga."
                </p>
            </div>

            <!-- Real-time Donor Wall Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recentDonors as $donor)
                    <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-amber-primary/10 text-amber-hover flex items-center justify-center font-bold">
                                        <span class="material-symbols-outlined text-xl">person</span>
                                    </div>
                                    <div>
                                        <h4 class="text-sm text-navy-deep font-bold">{{ $donor->donor_name }}</h4>
                                        <span class="text-xs text-secondary">{{ $donor->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-primary">Rp{{ number_format($donor->amount, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-xs text-on-surface-variant italic bg-surface-container-low/50 p-3 rounded-DEFAULT">
                                "{{ $donor->donor_prayer ?: 'Semoga berkah untuk kemakmuran masjid dan keluarga kami.' }}"
                            </p>
                        </div>
                        <div class="mt-4 pt-3 flex items-center justify-between">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-tertiary-fixed text-on-tertiary-container">
                                {{ $donor->program ? $donor->program->title : 'Sedekah Umum' }}
                            </span>
                            <span class="text-xs text-success font-medium flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">verified</span> Terverifikasi
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<script>
function selectProgram(id) {
    const sel = document.getElementById('selected-program-select');
    if (sel) sel.value = id;
    const formEl = document.getElementById('form-sedekah');
    if (formEl) formEl.scrollIntoView({ behavior: 'smooth' });
}

function setAmount(val, btn) {
    document.getElementById('custom-amount').value = val;
    document.querySelectorAll('.chip-btn').forEach(b => {
        b.classList.remove('bg-amber-primary', 'text-pure-white', 'shadow-sm');
        b.classList.add('bg-surface-container-low', 'text-navy-deep');
    });
    btn.classList.add('bg-amber-primary', 'text-pure-white', 'shadow-sm');
    btn.classList.remove('bg-surface-container-low', 'text-navy-deep');
}

function setFrequency(freq, btn) {
    document.getElementById('input-frequency').value = freq;
    document.querySelectorAll('.freq-btn').forEach(b => {
        b.classList.remove('bg-surface-container-lowest', 'text-navy-deep', 'font-semibold', 'shadow-sm');
        b.classList.add('text-secondary', 'font-medium');
    });
    btn.classList.add('bg-surface-container-lowest', 'text-navy-deep', 'font-semibold', 'shadow-sm');
    btn.classList.remove('text-secondary', 'font-medium');
}

function setMethod(method, btn) {
    document.getElementById('input-payment-method').value = method;
    document.querySelectorAll('.pay-method').forEach(b => {
        b.classList.remove('bg-surface-container-high', 'ring-2', 'ring-amber-primary');
        b.classList.add('bg-surface-container-low');
    });
    btn.classList.add('bg-surface-container-high', 'ring-2', 'ring-amber-primary');
    btn.classList.remove('bg-surface-container-low');
}

function toggleAnonim(cb) {
    const nameInput = document.getElementById('donor-name');
    if (cb.checked) {
        nameInput.value = 'Hamba Allah';
        nameInput.disabled = true;
    } else {
        nameInput.value = '';
        nameInput.disabled = false;
    }
}

function copyToClipboard(text, btn) {
    navigator.clipboard.writeText(text);
    const original = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined text-lg text-success">done</span>';
    setTimeout(() => {
        btn.innerHTML = original;
    }, 2000);
}
</script>
@endsection
