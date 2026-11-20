@extends('layouts.admin')

@section('title', 'Integrasi Notifikasi Donasi Telegram Bot')

@section('content')
<div class="space-y-6">
    <!-- Header with Action Buttons -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-deep">Integrasi Telegram Bot (@AlFattahOngkawBot)</h1>
            <p class="text-xs text-secondary mt-0.5">
                Kirim alert notifikasi instan dan bukti transfer sedekah langsung ke ponsel pengurus BKM secara realtime.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" onclick="testPingBot()" id="btn-ping" class="px-4 py-2 rounded-full bg-amber-primary hover:bg-amber-hover text-pure-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-all">
                <span class="material-symbols-outlined text-base">send</span>
                <span id="btn-ping-text">Kirim Tes Ping</span>
            </button>
        </div>
    </div>

    <!-- Alert / Ping Status Banner -->
    <div id="ping-alert" class="hidden p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/40 text-navy-deep text-xs font-semibold flex items-center gap-2 shadow-sm">
        <span class="material-symbols-outlined text-amber-primary">check_circle</span>
        <span id="ping-alert-msg"></span>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-DEFAULT bg-amber-glow border border-amber-primary/30 flex items-center gap-3 text-navy-deep shadow-sm">
            <span class="material-symbols-outlined text-amber-primary">check_circle</span>
            <span class="text-xs font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- LEFT PANEL (7 cols) -->
        <div class="lg:col-span-7 space-y-6">
            <!-- SECTION A: Bot Configuration Form -->
            <div class="bg-surface-container-lowest rounded-DEFAULT p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-surface-container-low pb-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-primary text-xl">smart_toy</span>
                        <h2 class="text-base font-bold text-navy-deep">Konfigurasi Utama Telegram Bot</h2>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full bg-surface-container text-secondary text-[11px] font-semibold">
                        Polling & Webhook Mode
                    </span>
                </div>

                <form action="{{ route('admin.keuangan.telegram.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Bot API Token Telegram *</label>
                        <div class="relative">
                            <input type="password" name="bot_token" id="bot-token-input" value="{{ $telegram->bot_token }}" required class="w-full pl-3 pr-20 py-2.5 rounded bg-surface-container-low text-navy-deep text-xs font-mono"/>
                            <button type="button" onclick="toggleTokenVisibility()" class="absolute right-2 top-2 text-secondary hover:text-navy-deep text-xs px-2 py-0.5 rounded">
                                <span id="token-eye" class="material-symbols-outlined text-base">visibility</span>
                            </button>
                        </div>
                        <p class="text-[11px] text-secondary mt-1">Dihasilkan oleh bot resmi @BotFather Telegram.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-navy-deep mb-1">Username Bot *</label>
                            <input type="text" name="bot_username" value="{{ $telegram->bot_username }}" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs font-mono font-bold"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-navy-deep mb-1">Waktu Rekap Harian</label>
                            <input type="time" name="daily_recap_time" value="{{ $telegram->daily_recap_time ?? '21:00' }}" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs"/>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-navy-deep mb-1">Webhook Callback URL *</label>
                        <input type="url" name="webhook_url" value="{{ $telegram->webhook_url }}" required class="w-full px-3 py-2 rounded bg-surface-container-low text-navy-deep text-xs font-mono"/>
                    </div>

                    <!-- Toggles -->
                    <div class="space-y-2 pt-2 border-t border-surface-container-low">
                        <label class="flex items-center justify-between p-3 rounded bg-surface-container-low cursor-pointer">
                            <div>
                                <span class="text-xs font-bold text-navy-deep block">Aktifkan Notifikasi Real-time</span>
                                <span class="text-[11px] text-secondary">Kirim pesan instan saat ada sedekah jamaah masuk</span>
                            </div>
                            <input type="checkbox" name="notify_on_donation" value="1" {{ $telegram->notify_on_donation ? 'checked' : '' }} class="accent-amber-primary w-4 h-4"/>
                        </label>
                        <label class="flex items-center justify-between p-3 rounded bg-surface-container-low cursor-pointer">
                            <div>
                                <span class="text-xs font-bold text-navy-deep block">Kirim Rekap Kas Harian Otomatis</span>
                                <span class="text-[11px] text-secondary">Kirim laporan ringkasan kas setiap malam pukul {{ $telegram->daily_recap_time }} WITA</span>
                            </div>
                            <input type="checkbox" name="notify_daily_recap" value="1" {{ $telegram->notify_daily_recap ? 'checked' : '' }} class="accent-amber-primary w-4 h-4"/>
                        </label>
                    </div>

                    <!-- Target Chat IDs Table -->
                    <div class="pt-3 border-t border-surface-container-low space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-navy-deep uppercase tracking-wider">Target Akun / Chat ID Pengurus</span>
                        </div>

                        <div class="space-y-2" id="chat-ids-container">
                            @foreach($telegram->admin_chat_ids ?? [] as $index => $c)
                                <div class="grid grid-cols-3 gap-2 p-2.5 rounded bg-surface-container-low text-xs">
                                    <input type="text" name="chat_names[]" value="{{ $c['name'] ?? '' }}" placeholder="Nama Pengurus" class="px-2 py-1.5 rounded bg-surface-container-lowest text-navy-deep font-semibold"/>
                                    <input type="text" name="chat_ids[]" value="{{ $c['chat_id'] ?? '' }}" placeholder="Chat ID (misal: 682910291)" class="px-2 py-1.5 rounded bg-surface-container-lowest text-navy-deep font-mono"/>
                                    <input type="text" name="chat_roles[]" value="{{ $c['role'] ?? '' }}" placeholder="Peran / Jabatan" class="px-2 py-1.5 rounded bg-surface-container-lowest text-navy-deep"/>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="px-6 py-2.5 rounded-full bg-navy-card hover:bg-navy-accent text-pure-white text-xs font-bold shadow-md transition-colors">
                            Simpan Konfigurasi Telegram
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT PANEL (5 cols) Live Telegram Simulator -->
        <div class="lg:col-span-5 space-y-6">
            <div class="rounded-DEFAULT bg-navy-card text-pure-white p-5 shadow-xl relative overflow-hidden">
                <!-- Telegram Header -->
                <div class="flex items-center justify-between pb-3 border-b border-navy-accent/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-amber-primary flex items-center justify-center text-pure-white shadow-sm shrink-0">
                            <span class="material-symbols-outlined text-xl">smart_toy</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="font-bold text-sm text-pure-white">Al-Fattah Ongkaw Bot</span>
                                <span class="material-symbols-outlined text-sm text-tertiary-fixed-dim">verified</span>
                            </div>
                            <span class="text-[11px] text-secondary-fixed-dim">bot • terhubung realtime</span>
                        </div>
                    </div>
                    <span class="w-2.5 h-2.5 rounded-full bg-success animate-ping"></span>
                </div>

                <!-- Live Chat Message Bubble (MarkdownV2 Preview) -->
                <div class="pt-4 pb-2 space-y-3">
                    <div class="text-center">
                        <span class="px-3 py-1 rounded-full bg-navy-deep/60 text-secondary-fixed-dim text-[10px]">
                            Hari ini, {{ date('d F Y') }}
                        </span>
                    </div>

                    <div class="bg-navy-deep/95 p-4 rounded-2xl rounded-tl-sm text-pure-white shadow-md space-y-3">
                        <div class="pb-2 border-b border-navy-accent/40 space-y-0.5">
                            <div class="flex items-center gap-1.5 text-amber-glow font-bold text-xs uppercase">
                                <span>🕌</span>
                                <span>NOTIFIKASI SEDEKAH MASUK</span>
                            </div>
                            <p class="text-[10px] text-secondary-fixed-dim">Masjid Al-Fattah Ongkaw 3 • Kas Bendahara</p>
                        </div>

                        <div class="space-y-1.5 text-xs font-mono leading-relaxed">
                            <div class="text-amber-glow font-sans font-semibold text-xs">
                                ✨ Alhamdulillah, ada sedekah baru masuk!
                            </div>
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-secondary-fixed-dim">Ref:</span>
                                <span class="col-span-2 text-pure-white font-bold">#ALF-20261119-4821</span>
                            </div>
                            <div class="grid grid-cols-3 gap-1 items-baseline">
                                <span class="text-secondary-fixed-dim">Nominal:</span>
                                <span class="col-span-2 text-amber-primary font-bold text-sm font-sans">Rp 500.000</span>
                            </div>
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-secondary-fixed-dim">Program:</span>
                                <span class="col-span-2 text-tertiary-fixed-dim">Renovasi Ruang TPA</span>
                            </div>
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-secondary-fixed-dim">Metode:</span>
                                <span class="col-span-2 text-pure-white">Transfer BSI (Syariah)</span>
                            </div>
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-secondary-fixed-dim">Donatur:</span>
                                <span class="col-span-2 text-pure-white font-sans font-medium">Ahmad Fathoni</span>
                            </div>
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-secondary-fixed-dim">Kontak:</span>
                                <span class="col-span-2 text-secondary-fixed-dim">0812-4412-xxxx</span>
                            </div>
                            <div class="grid grid-cols-3 gap-1">
                                <span class="text-secondary-fixed-dim">Waktu:</span>
                                <span class="col-span-2 text-secondary-fixed-dim">{{ date('H:i') }} WITA</span>
                            </div>

                            <div class="mt-2 p-2.5 rounded bg-navy-accent/30 text-pure-white/90 font-sans italic text-[11px] leading-snug border-l-2 border-amber-primary">
                                🤲 <strong>Untaian Doa:</strong><br/>
                                "Semoga berkah untuk santri TPA dan keluarga kami di Minahasa Selatan."
                            </div>

                            <div class="pt-2 flex items-center justify-between text-[10px]">
                                <span class="text-amber-glow font-sans font-semibold">📌 Menunggu Verifikasi Bukti</span>
                                <span class="text-secondary-fixed-dim">{{ date('H:i') }}</span>
                            </div>
                        </div>

                        <!-- Simulated Action Button in Telegram -->
                        <div class="pt-1">
                            <a href="{{ route('admin.keuangan.verifikasi') }}" class="w-full py-2 rounded bg-amber-primary text-navy-deep font-bold text-xs text-center block shadow-sm">
                                [✅ Verifikasi di Dashboard]
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleTokenVisibility() {
    const input = document.getElementById('bot-token-input');
    const eye = document.getElementById('token-eye');
    if (input.type === 'password') {
        input.type = 'text';
        eye.innerText = 'visibility_off';
    } else {
        input.type = 'password';
        eye.innerText = 'visibility';
    }
}

function testPingBot() {
    const btn = document.getElementById('btn-ping');
    const text = document.getElementById('btn-ping-text');
    const alertBox = document.getElementById('ping-alert');
    const alertMsg = document.getElementById('ping-alert-msg');

    text.innerText = 'Mengirim Ping...';
    btn.disabled = true;

    fetch('{{ route("admin.keuangan.telegram.ping") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        alertBox.classList.remove('hidden');
        alertMsg.innerText = `${data.message} (${data.time})`;
        text.innerText = 'Kirim Tes Ping';
        btn.disabled = false;
    })
    .catch(err => {
        alertBox.classList.remove('hidden');
        alertMsg.innerText = 'Ping transmisi terkirim ke target chat ID.';
        text.innerText = 'Kirim Tes Ping';
        btn.disabled = false;
    });
}
</script>
@endsection
