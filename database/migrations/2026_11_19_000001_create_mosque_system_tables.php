<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add role, title, phone to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('dakwah')->after('email'); // superadmin, dakwah, keuangan
            $table->string('title')->nullable()->after('role'); // e.g. "Sekretaris & Humas", "Bendahara Umum BKM"
            $table->string('phone')->nullable()->after('title');
            $table->text('avatar')->nullable()->after('phone');
        });

        // 1. Settings & Mosque Profile
        Schema::create('mosque_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Masjid Al-Fattah');
            $table->string('slug')->default('masjid-al-fattah-ongkaw-3');
            $table->string('village')->default('Desa Ongkaw 3');
            $table->string('sub_district')->default('Kecamatan Sinonsayang');
            $table->string('regency')->default('Kabupaten Minahasa Selatan');
            $table->string('province')->default('Sulawesi Utara');
            $table->string('address')->default('Jl. Trans Sulawesi, Desa Ongkaw 3, Kec. Sinonsayang, Minahasa Selatan, Sulawesi Utara');
            $table->decimal('latitude', 10, 7)->default(0.9120000);
            $table->decimal('longitude', 10, 7)->default(124.3650000);
            $table->integer('elevation')->default(18);
            $table->string('timezone')->default('WITA (UTC+8)');
            $table->string('qibla_direction')->default('291.4° Barat Laut');
            $table->text('history')->nullable();
            $table->text('vision')->nullable();
            $table->json('missions')->nullable();
            $table->string('phone')->default('+62 812-3456-7890');
            $table->string('email')->default('sekretariat@alfattah-ongkaw3.id');
            $table->string('rekening_bsi')->default('718-2938-192');
            $table->string('rekening_bsi_an')->default('BKM Al-Fattah Ongkaw 3');
            $table->string('rekening_sulutgo')->default('012-3456-789');
            $table->string('rekening_sulutgo_an')->default('Masjid Al-Fattah Ongkaw 3');
            $table->text('qris_image_path')->nullable();
            $table->integer('capacity_jamaah')->default(400);
            $table->integer('santri_count')->default(65);
            $table->integer('founded_year')->default(1989);
            $table->json('feature_toggles')->nullable(); // on/off for hero, prayer_widget, programs, donation_form, gallery, etc.
            $table->timestamps();
        });

        // 2. Prayer Settings & TV Display
        Schema::create('prayer_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('ikhtiyat_minutes')->default(2);
            $table->integer('iqamah_subuh')->default(10);
            $table->integer('iqamah_dzuhur')->default(7);
            $table->integer('iqamah_ashar')->default(7);
            $table->integer('iqamah_maghrib')->default(5);
            $table->integer('iqamah_isya')->default(10);
            $table->boolean('buzzer_active')->default(true);
            $table->boolean('tv_display_enabled')->default(true);
            $table->text('tv_running_text')->default('Luruskan dan rapatkan shaf, matikan atau heningkan nada dering ponsel demi kenyamanan dan kekhusyukan ibadah.');
            $table->string('tv_marquee_speed')->default('normal'); // lambat, normal, cepat
            $table->boolean('auto_dim_salat')->default(true);
            $table->timestamps();
        });

        // 3. Monthly/Daily Prayer Schedules
        Schema::create('prayer_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->string('day_name');
            $table->string('hijri_date');
            $table->string('subuh');
            $table->string('syuruq');
            $table->string('dzuhur');
            $table->string('ashar');
            $table->string('maghrib');
            $table->string('isya');
            $table->timestamps();
        });

        // 4. Friday Officers (Roster Petugas Jumat)
        Schema::create('friday_officers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('khatib_name');
            $table->string('khatib_title')->nullable();
            $table->string('khatib_phone')->nullable();
            $table->string('imam_name');
            $table->string('bilal_name');
            $table->string('khutbah_title')->nullable();
            $table->string('status_wa')->default('terkonfirmasi'); // terkonfirmasi, menunggu, batal
            $table->text('khutbah_pdf_path')->nullable();
            $table->boolean('is_badal')->default(false);
            $table->string('original_khatib_name')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 5. Standby Badal Khatib (Badal Darurat)
        Schema::create('standby_khatibs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('status')->default('siaga'); // siaga, ditugaskan, cuti
            $table->timestamps();
        });

        // 6. Routine Programs (Apa yang Kami Lakukan / Layanan Unggulan)
        Schema::create('routine_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('category')->default('rutin'); // rutin, keunggulan, sosial
            $table->text('short_description');
            $table->text('description')->nullable();
            $table->string('icon')->default('menu_book');
            $table->text('image')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 7. Donation Programs (Program Sedekah & Infaq Pilihan)
        Schema::create('donation_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('pendidikan'); // pendidikan, operasional, sosial, darurat
            $table->decimal('target_amount', 14, 2)->default(0);
            $table->decimal('collected_amount', 14, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        // 8. Donations (Sedekah Masuk)
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->unique();
            $table->foreignId('donation_program_id')->nullable()->constrained('donation_programs')->nullOnDelete();
            $table->string('donor_name');
            $table->boolean('is_anonymous')->default(false);
            $table->string('phone_wa')->nullable();
            $table->decimal('amount', 14, 2);
            $table->string('frequency')->default('sekali'); // sekali, harian, bulanan
            $table->string('payment_method')->default('qris'); // qris, transfer_bsi, transfer_sulutgo, tunai_kotak
            $table->text('proof_image_path')->nullable();
            $table->text('donor_prayer')->nullable();
            $table->string('status')->default('pending'); // pending, verified, rejected
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });

        // 9. Cash Mutations (Buku Kas Umum Digital)
        Schema::create('cash_mutations', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->string('type'); // masuk, keluar
            $table->string('source_account')->default('bsi'); // bsi, sulutgo, tunai_brankas
            $table->string('category'); // infaq_jamaah, kotak_jumat, qris_online, operasional_listrik, bisyarah_guru_tpa, renovasi_material, santunan_dhuafa
            $table->decimal('amount', 14, 2);
            $table->text('description');
            $table->text('proof_image_path')->nullable();
            $table->foreignId('donation_id')->nullable()->constrained('donations')->nullOnDelete();
            $table->foreignId('recorded_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('transaction_date');
            $table->timestamps();
        });

        // 10. Agendas & Majelis Dakwah
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('category')->default('kajian_rutin'); // kajian_rutin, tpa, phbi, tabligh_akbar
            $table->dateTime('date_time');
            $table->dateTime('end_time')->nullable();
            $table->string('location')->default('Ruang Shalat Utama');
            $table->string('speaker_name')->nullable();
            $table->string('speaker_title')->nullable();
            $table->text('description')->nullable();
            $table->text('poster_image')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->string('status')->default('published'); // published, draft
            $table->timestamps();
        });

        // 11. News & Announcements (Warta & Pengumuman BKM)
        Schema::create('news_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('warta');
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->text('image')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->string('status')->default('published');
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 12. Board Members (Susunan Pengurus BKM)
        Schema::create('board_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title_degree')->nullable();
            $table->string('position'); // Penasihat, Ketua, Sekretaris, Bendahara, Imam Rawatib, Bilal
            $table->string('division')->default('harian'); // pembina, harian, imam_muadzin, dakwah, pembangunan, risma
            $table->string('period')->default('2024–2029');
            $table->string('phone')->nullable();
            $table->text('photo')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        // 13. Gallery Albums & Photos
        Schema::create('gallery_albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('cover_image')->nullable();
            $table->date('event_date')->nullable();
            $table->timestamps();
        });

        Schema::create('gallery_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->nullable()->constrained('gallery_albums')->nullOnDelete();
            $table->text('photo_path');
            $table->string('caption')->nullable();
            $table->string('category')->default('ibadah_akbar'); // ibadah_akbar, ramadhan_berkah, aksi_kebersihan, bakti_sosial, prestasi_santri, tabligh_akbar
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        // 14. Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role_title'); // Wali Santri, Tokoh Masyarakat, Ketua Risma
            $table->text('content');
            $table->integer('rating')->default(5);
            $table->text('avatar')->nullable();
            $table->boolean('is_featured')->default(false); // center highlighted card
            $table->boolean('is_active')->default(true);
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        // 15. Inbox Messages (Pesan Jamaah & Pelayanan)
        Schema::create('inbox_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('category')->default('pertanyaan'); // pertanyaan, doa, pinjam_aula, pendaftaran_tpa, pengaduan
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('replied_at')->nullable();
            $table->text('reply_text')->nullable();
            $table->timestamps();
        });

        // 16. Telegram Settings & Integration
        Schema::create('telegram_settings', function (Blueprint $table) {
            $table->id();
            $table->string('bot_token')->default('7928374928:AAHq_bXYZ9812_sample_alfattah');
            $table->string('bot_username')->default('@AlFattahOngkawBot');
            $table->string('webhook_url')->default('https://ongkaw.test/api/telegram/webhook');
            $table->boolean('is_active')->default(true);
            $table->boolean('notify_on_donation')->default(true);
            $table->boolean('notify_daily_recap')->default(true);
            $table->string('daily_recap_time')->default('21:00');
            $table->json('admin_chat_ids')->nullable(); // [{"name":"Zulkifli Mamonto (Bendahara)", "chat_id":"68291029"}, ...]
            $table->timestamp('last_ping_at')->nullable();
            $table->string('last_ping_status')->nullable();
            $table->timestamps();
        });

        // 17. Audit Logs
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('user_name')->nullable();
            $table->string('action');
            $table->string('module');
            $table->text('details')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('telegram_settings');
        Schema::dropIfExists('inbox_messages');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('gallery_photos');
        Schema::dropIfExists('gallery_albums');
        Schema::dropIfExists('board_members');
        Schema::dropIfExists('news_announcements');
        Schema::dropIfExists('agendas');
        Schema::dropIfExists('cash_mutations');
        Schema::dropIfExists('donations');
        Schema::dropIfExists('donation_programs');
        Schema::dropIfExists('routine_programs');
        Schema::dropIfExists('standby_khatibs');
        Schema::dropIfExists('friday_officers');
        Schema::dropIfExists('prayer_schedules');
        Schema::dropIfExists('prayer_settings');
        Schema::dropIfExists('mosque_profiles');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'title', 'phone', 'avatar']);
        });
    }
};
