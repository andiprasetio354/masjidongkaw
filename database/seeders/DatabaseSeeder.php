<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $password = Hash::make('BKM@Ongkaw3#2024');

        $superadmin = User::create([
            'name' => 'H. Ismail Paputungan',
            'email' => 'admin@alfattah-ongkaw3.id',
            'role' => 'superadmin',
            'title' => 'Ketua BKM / IT',
            'phone' => '+62 812-3456-7890',
            'password' => $password,
        ]);

        $humas = User::create([
            'name' => 'Muh. Ridwan Gobel, S.Pd.',
            'email' => 'humas@alfattah.id',
            'role' => 'dakwah',
            'title' => 'Sekretaris & Divisi Humas/Syiar',
            'phone' => '+62 813-9876-5432',
            'password' => $password,
        ]);

        // Alternative email for humas
        User::create([
            'name' => 'Muh. Ridwan Gobel, S.Pd.',
            'email' => 'humas@alfattah-ongkaw3.id',
            'role' => 'dakwah',
            'title' => 'Sekretaris & Divisi Humas/Syiar',
            'phone' => '+62 813-9876-5432',
            'password' => $password,
        ]);

        $bendahara = User::create([
            'name' => 'Zulkifli Mamonto, S.E.',
            'email' => 'kasir@alfattah.id',
            'role' => 'keuangan',
            'title' => 'Bendahara Umum BKM',
            'phone' => '+62 821-5544-3322',
            'password' => $password,
        ]);

        User::create([
            'name' => 'Zulkifli Mamonto, S.E.',
            'email' => 'bendahara@alfattah-ongkaw3.id',
            'role' => 'keuangan',
            'title' => 'Bendahara Umum BKM',
            'phone' => '+62 821-5544-3322',
            'password' => $password,
        ]);

        // 2. Mosque Profile
        DB::table('mosque_profiles')->insert([
            'name' => 'Masjid Al-Fattah',
            'slug' => 'masjid-al-fattah-ongkaw-3',
            'village' => 'Desa Ongkaw 3',
            'sub_district' => 'Kecamatan Sinonsayang',
            'regency' => 'Kabupaten Minahasa Selatan',
            'province' => 'Sulawesi Utara',
            'address' => 'Jl. Trans Sulawesi, Desa Ongkaw 3, Kec. Sinonsayang, Minahasa Selatan, Sulawesi Utara',
            'latitude' => 0.9120000,
            'longitude' => 124.3650000,
            'elevation' => 18,
            'timezone' => 'WITA (UTC+8)',
            'qibla_direction' => '291.4° Barat Laut',
            'history' => "Masjid Al-Fattah berawal dari swadaya para perantau dan warga lokal Muslim di Desa Ongkaw 3 yang mengidamkan tempat sujud berjamaah sejak tahun 1989. Dengan semangat gotong royong lintas generasi dan dukungan tokoh masyarakat Minahasa Selatan, bangunan kini telah berdiri kokoh di poros Trans Sulawesi, menampung lebih dari 400 jamaah, menyelenggarakan pendidikan Al-Qur'an anak-anak, serta aktif membina keharmonisan antarwarga.",
            'vision' => "Terwujudnya Masjid Al-Fattah sebagai pusat ibadah yang makmur, mandiri, berkeadaban, dan menebarkan rahmat bagi semesta alam di Minahasa Selatan.",
            'missions' => json_encode([
                "Menyelenggarakan ibadah salat fardhu berjamaah dan kajian dakwah Islamiyah yang sejuk, inklusif, dan mencerahkan.",
                "Mengembangkan pembinaan generasi Qur'ani melalui TPA Al-Fattah dan wadah kreatifitas Remaja Islam Masjid (RISMA).",
                "Mengelola infaq, sedekah, dan wakaf umat secara transparan, akuntabel, dan berbasis laporan digital terbuka.",
                "Menjaga kebersihan, keasrian, serta kelengkapan sarana ibadah yang ramah bagi lansia, musafir, dan penyandang disabilitas."
            ]),
            'phone' => '+62 812-3456-7890',
            'email' => 'sekretariat@alfattah-ongkaw3.id',
            'rekening_bsi' => '718-2938-192',
            'rekening_bsi_an' => 'BKM Al-Fattah Ongkaw 3',
            'rekening_sulutgo' => '012-3456-789',
            'rekening_sulutgo_an' => 'Masjid Al-Fattah Ongkaw 3',
            'qris_image_path' => 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=00020101021126580014ID.LINKAJA.WWW01189360091800000000000215ID10200210000015204581253033605802ID5920BKM%20AL%20FATTAH%20ONGKAW%2036015MINAHASA%20SELATAN61059535362070703A016304',
            'capacity_jamaah' => 400,
            'santri_count' => 65,
            'founded_year' => 1989,
            'feature_toggles' => json_encode([
                'hero_banner' => true,
                'jadwal_salat' => true,
                'program_unggulan' => true,
                'form_sedekah' => true,
                'galeri_kegiatan' => true,
                'testimoni' => true,
                'lokasi' => true,
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Prayer Settings
        DB::table('prayer_settings')->insert([
            'ikhtiyat_minutes' => 2,
            'iqamah_subuh' => 10,
            'iqamah_dzuhur' => 7,
            'iqamah_ashar' => 7,
            'iqamah_maghrib' => 5,
            'iqamah_isya' => 10,
            'buzzer_active' => true,
            'tv_display_enabled' => true,
            'tv_running_text' => 'Luruskan dan rapatkan shaf, matikan atau heningkan nada dering ponsel demi kenyamanan dan kekhusyukan ibadah bersama.',
            'tv_marquee_speed' => 'normal',
            'auto_dim_salat' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Prayer Schedules (November 2026 for Sinonsayang, Minahasa Selatan)
        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $baseDate = \Carbon\Carbon::create(2026, 11, 1);
        for ($i = 0; $i < 30; $i++) {
            $current = $baseDate->copy()->addDays($i);
            $dayOfWeek = $days[$current->dayOfWeek];
            $hijriDay = $i + 1; // Approx 1 - 30 Jumadil Awwal 1448 H

            DB::table('prayer_schedules')->insert([
                'date' => $current->toDateString(),
                'day_name' => $dayOfWeek,
                'hijri_date' => $hijriDay . " Jumadil Awwal 1448 H",
                'subuh' => '04:18',
                'syuruq' => '05:34',
                'dzuhur' => '11:46',
                'ashar' => '15:08',
                'maghrib' => '17:48',
                'isya' => '19:00',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 5. Friday Officers (Roster Petugas Jum'at 4 Pekan)
        $fridays = [
            [
                'date' => '2026-11-06',
                'khatib_name' => 'Ust. Drs. Hi. Lukman Mokodompit',
                'khatib_title' => 'Muballigh Kemenag Minsel',
                'khatib_phone' => '+62 813-4455-6677',
                'imam_name' => 'Ustadz Ahmad Fauzi, Lc.',
                'bilal_name' => 'Bilal Karim',
                'khutbah_title' => 'Urgensi Menjaga Kerukunan dan Ukhuwah di Era Modern',
                'status_wa' => 'terkonfirmasi',
                'khutbah_pdf_path' => '/documents/khutbah-2026-11-06.pdf',
                'is_badal' => false,
            ],
            [
                'date' => '2026-11-13',
                'khatib_name' => 'Ust. Harun Mokodompis, S.Ag.',
                'khatib_title' => 'Penyuluh Agama Islam Sinonsayang',
                'khatib_phone' => '+62 822-9988-7711',
                'imam_name' => 'Ustadz Ahmad Fauzi, Lc.',
                'bilal_name' => 'Rahmat Gobel',
                'khutbah_title' => 'Meneladani Keikhlasan Sedekah Kaum Muhajirin & Anshar',
                'status_wa' => 'terkonfirmasi',
                'khutbah_pdf_path' => '/documents/khutbah-2026-11-13.pdf',
                'is_badal' => false,
            ],
            [
                'date' => '2026-11-20',
                'khatib_name' => 'Ust. Ahmad Fauzi, Lc.',
                'khatib_title' => 'Imam Rawatib Masjid Al-Fattah',
                'khatib_phone' => '+62 811-2233-4455',
                'imam_name' => 'Ustadz Bilal Karim',
                'bilal_name' => 'Rifqi Pratama',
                'khutbah_title' => 'Memakmurkan Rumah Allah sebagai Bentuk Kesyukuran Hakiki',
                'status_wa' => 'terkonfirmasi',
                'khutbah_pdf_path' => '/documents/khutbah-2026-11-20.pdf',
                'is_badal' => false,
            ],
            [
                'date' => '2026-11-27',
                'khatib_name' => 'Ust. Dr. Muhammad Syarif, M.Pd.I.',
                'khatib_title' => 'Dosen FTIK IAIN Manado',
                'khatib_phone' => '+62 852-7788-9900',
                'imam_name' => 'Ustadz Ahmad Fauzi, Lc.',
                'bilal_name' => 'Bilal Karim',
                'khutbah_title' => 'Mencetak Generasi Robbani yang Tangguh dan Berakhlak Karimah',
                'status_wa' => 'terkonfirmasi',
                'khutbah_pdf_path' => '/documents/khutbah-2026-11-27.pdf',
                'is_badal' => false,
            ],
        ];

        foreach ($fridays as $f) {
            DB::table('friday_officers')->insert(array_merge($f, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 6. Standby Khatib (Cadangan Badal Khutbah Darurat)
        DB::table('standby_khatibs')->insert([
            ['name' => 'Ust. M. Ridwan Gobel, S.Pd.', 'phone' => '+62 813-9876-5432', 'address' => 'Ongkaw 3 Dusun 2', 'status' => 'siaga', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ust. H. Kasim Paputungan', 'phone' => '+62 812-7766-5544', 'address' => 'Ongkaw 3 Dusun 1', 'status' => 'siaga', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ust. Bilal Karim', 'phone' => '+62 853-4433-2211', 'address' => 'Kompleks Masjid Al-Fattah', 'status' => 'siaga', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 7. Routine Programs
        $routines = [
            [
                'title' => 'Salat Fardhu Berjamaah',
                'slug' => 'salat-fardhu-berjamaah',
                'category' => 'rutin',
                'short_description' => "Menegakkan salat lima waktu dengan imam rawatib tetap, kultum ba'da Subuh dan Maghrib, serta dzikir ma'tsurat bersama jamaah.",
                'description' => "Ibadah salat berjamaah dilaksanakan secara istiqomah 5 waktu setiap hari, dipandu oleh imam rawatib tetap. Dilengkapi kultum singkat ba'da Subuh dan Maghrib.",
                'icon' => 'mosque',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDVubQYxXTnQQIdNvrlWyeo4JvYOOmvgSeSFYL9C40DC1j_FUUSb2UHY-dIyQjCiSwyKJCQhGf9XDzF31kq51CL0j_7yUuUdL53g7CG57WxovqB6ouM_d2ih4Bf9Po7HHh-AsksHHicrqaXA7weX9hgterpy2aLGvlaovMcRpkHLld1dk3rb4s_fzoevAfgpLenFNjhX09Lw34wq393zEGHWepQimWqU5YYPV_4Tw',
                'order_index' => 1,
            ],
            [
                'title' => 'TPA & Pembinaan Generasi',
                'slug' => 'tpa-pembinaan-generasi',
                'category' => 'rutin',
                'short_description' => "Pendidikan Al-Qur'an terstruktur metode Tilawati untuk anak-anak desa Ongkaw 3 setiap Senin sampai Kamis sore.",
                'description' => "Pembinaan santri usia 5-15 tahun dalam membaca, menghafal juz amma, tahsin, serta doa harian dan tata cara wudhu serta salat fardhu.",
                'icon' => 'school',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDJ5qx5ryIfXW_piIAocva0GXXigxwxE64PDshMFYQ2FkZWy_FrC-2HYYTJPSrskWW4avb-9el64uNOLXxZ-YTVAe9mjbN55RSQxn7qC8RKJfUzoPuJCCZO3CPSflO05l0aRg6H28M-op9zBOPj8LbzpkHGCpGbIVfHZb45HDEoIUvuUx9DpM26-dh5vjnp2s7GyQv2bWzmKyEuRBSiuzN8mP5XdrWYGzJwm2-XBw',
                'order_index' => 2,
            ],
            [
                'title' => 'Kajian Tematik & Fiqih',
                'slug' => 'kajian-tematik-fiqih',
                'category' => 'rutin',
                'short_description' => "Majelis Taklim rutin malam Kamis ba'da Maghrib mengupas fiqih ibadah sehari-hari serta kajian Subuh Ahad berseri.",
                'description' => "Membahas kitab-kitab fiqih ibadah praktis, sirah nabawiyah, dan pembinaan keharmonisan rumah tangga islami bersama ustadz tamu.",
                'icon' => 'menu_book',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDeaan5v_ITEJ5oo7GLNamaTM1i1aajGh1nwjiUcDOCwY3Dx0DQ0UQvj0fOvQSTOmyEAlycSqUpElSw6gndzrEUgCtmjSkMd_QdfpC4ueHiu4Kwjq13Gb7Tt4CNTyVHR8tJHmmfZB9xK2v6s74AjqWH-XTr_96nfMMAgzusjbaR0Nx34QMvz9UZD7exQwyWH_dO1gvPiaZrslIYaeyLPcV2rsK5KURGryU9nqcsyg',
                'order_index' => 3,
            ],
            [
                'title' => 'Santunan Yatim & Dhuafa',
                'slug' => 'santunan-yatim-dhuafa',
                'category' => 'sosial',
                'short_description' => "Penyaluran amanah zakat, infaq beras bulanan, serta santunan pendidikan bagi puluhan keluarga pra-sejahtera di Ongkaw.",
                'description' => "Program perlindungan sosial BKM Al-Fattah yang menyalurkan paket sembako, santunan biaya sekolah anak yatim piatu, dan tanggap darurat musibah.",
                'icon' => 'volunteer_activism',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDrVUQDJeFsQjtenceHCaJRDJZGNO0FR5dlugYnAKbIN9NeSQc-5yuD0zqNQmsQZUigBi-DpiqHOt0xizXmQPVkx5obEwF5Bzz1ZxbOEzQE1JvQvhG-t7wZep7XuJKCaTRKEQR-wvon9s8OcWG9DEss_k2-TMu4lWo0fBLRXtRQSFCEsHwcIJlUi9aCl69O0KVCQJnxZpzRuc8oB4HfEqqhKO68JWC4n9YL5XuFHw',
                'order_index' => 4,
            ],
        ];

        foreach ($routines as $r) {
            DB::table('routine_programs')->insert(array_merge($r, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 8. Donation Programs
        $donationPrograms = [
            [
                'id' => 1,
                'title' => 'Pembangunan Ruang Belajar Santri TPA',
                'slug' => 'pembangunan-ruang-belajar-santri-tpa',
                'category' => 'pendidikan',
                'target_amount' => 75000000.00,
                'collected_amount' => 38500000.00,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAXLcztuR7QA6V50k1F5ANNoGpZ8jNfm5x8AHYyT0TLP7_uhs5IPlSOfx8RtW5X6coBBn-b9G37_A3Tv2PqPDnV1kS0Gx7x5exPHebqnwivYIY5YtsYcOx0PHFii5N9sdt4XTjnAoQ7fOXT_1QlbtKLV33il8YVpgqILFG_5Be5C_56GOgvmbZ1vdpIO6rVhcL8zJbe-G_XgEZ4HRtq6hCAycb8BgjjhlLIS1qWtw',
                'description' => 'Membantu pengadaan 2 ruang kelas baru santri tahfidz dan perlengkapan sarana belajar mengajar di Ongkaw 3.',
                'is_active' => true,
                'is_featured' => true,
                'order_index' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Operasional Listrik & Kebersihan Masjid',
                'slug' => 'operasional-listrik-kebersihan-masjid',
                'category' => 'operasional',
                'target_amount' => 15000000.00,
                'collected_amount' => 11200000.00,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBWEnZ-aix2USfTBd4Ft2y9pJ2_mXkp_DaSnf4QowwbYwK_MW6nk5RcMDGwn27kJ9oOVX2aQfiElcCLM_3ZxQoPlocspfpehpjp7aU-QjQp_LnrHHViXiwLfFrpbZpWI1W40HqIUtnSQj8dmwboxJMCPPeIXTfh2NhIcyX9EZuBQWBP7UrxFWxfPe6REYep7dFcClov67m5YbQHzdiP2brMQKPIzgZRFhyzqwqCVA',
                'description' => 'Menjaga kenyamanan ibadah melalui pasokan listrik pendingin AC, air wudhu jernih, dan kebersihan karpet masjid setiap hari.',
                'is_active' => true,
                'is_featured' => false,
                'order_index' => 2,
            ],
            [
                'id' => 3,
                'title' => 'Santunan Rutin Yatim & Dhuafa',
                'slug' => 'santunan-rutin-yatim-dhuafa',
                'category' => 'sosial',
                'target_amount' => 20000000.00,
                'collected_amount' => 14500000.00,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDrVUQDJeFsQjtenceHCaJRDJZGNO0FR5dlugYnAKbIN9NeSQc-5yuD0zqNQmsQZUigBi-DpiqHOt0xizXmQPVkx5obEwF5Bzz1ZxbOEzQE1JvQvhG-t7wZep7XuJKCaTRKEQR-wvon9s8OcWG9DEss_k2-TMu4lWo0fBLRXtRQSFCEsHwcIJlUi9aCl69O0KVCQJnxZpzRuc8oB4HfEqqhKO68JWC4n9YL5XuFHw',
                'description' => 'Pemberian beasiswa SPP bulanan untuk 18 santri yatim serta beras 10kg bagi 45 kepala keluarga janda lansia di Sinonsayang.',
                'is_active' => true,
                'is_featured' => false,
                'order_index' => 3,
            ],
            [
                'id' => 4,
                'title' => 'Dana Darurat & Layanan Ambulans Desa',
                'slug' => 'dana-darurat-layanan-ambulans-desa',
                'category' => 'darurat',
                'target_amount' => 30000000.00,
                'collected_amount' => 8450000.00,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDIzyUrsbZ-e7qSw53nwzfXDDg1uPne-1TTyInprSaQenEmxuCcYOQ3_uydftabj6p6_aj-4Fw_FKUzjIe0sUEpFby9kFzCljaln4Z74nVE7eK2g9wGclh08XbP8Bl0TEvvPZ7YAIbR5LNCYnB6FvdduzCS5rAZ4g-XyBn_Nfq2e3K4hAVpPwYisBftVzB92Q-kiy3U87GLLdmVmeSEtyh76XfMp21vDKEmDi1gyw',
                'description' => 'Pemeliharaan armada operasional medis, perlengkapan kain kafan pemulasaraan jenazah gratis bagi warga yang membutuhkan.',
                'is_active' => true,
                'is_featured' => false,
                'order_index' => 4,
            ],
        ];

        foreach ($donationPrograms as $dp) {
            DB::table('donation_programs')->insert(array_merge($dp, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 9. Donations & Verification Queue (Includes 4 pending validations as in the dashboard design!)
        $donations = [
            // 4 Pending Donations waiting for Bendahara verification
            [
                'reference_code' => 'ALF-20261119-0091',
                'donation_program_id' => 1,
                'donor_name' => 'dr. H. Irfan Paputungan',
                'is_anonymous' => false,
                'phone_wa' => '+62 813-8899-7700',
                'amount' => 1000000.00,
                'frequency' => 'sekali',
                'payment_method' => 'transfer_bsi',
                'proof_image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKaW5ksffmuV4CgWAEL3b7s_JlSE7AuwouIjDpPGjI4rzhnG6HCIDIsh2n4moKu6FaHBCw_qGCW2duPt4MNjrKZAq9q5czZoT4Gxb7HLBqxTwUnGNhW2zWSr3BW8F_yKJXTl6pEu9IzHcgwEf3wDIM419xK0BkMKuvCS9x-Cr7NoLaboMBb5m8kf1s06MJMbpCrJVzKHXVOzKb9dq6nQNK8tUKB6l9hvU2yfaMow',
                'donor_prayer' => 'Bismillah, semoga pembangunan TPA berjalan lancar dan menjadi amal jariyah almarhum orang tua kami.',
                'status' => 'pending',
                'verified_at' => null,
                'verified_by_user_id' => null,
                'rejection_reason' => null,
                'created_at' => now()->subMinutes(12),
                'updated_at' => now()->subMinutes(12),
            ],
            [
                'reference_code' => 'ALF-20261119-0092',
                'donation_program_id' => 1,
                'donor_name' => 'Ibu Rahmawati Mokodompit',
                'is_anonymous' => false,
                'phone_wa' => '+62 821-4433-2211',
                'amount' => 250000.00,
                'frequency' => 'bulanan',
                'payment_method' => 'qris',
                'proof_image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKaW5ksffmuV4CgWAEL3b7s_JlSE7AuwouIjDpPGjI4rzhnG6HCIDIsh2n4moKu6FaHBCw_qGCW2duPt4MNjrKZAq9q5czZoT4Gxb7HLBqxTwUnGNhW2zWSr3BW8F_yKJXTl6pEu9IzHcgwEf3wDIM419xK0BkMKuvCS9x-Cr7NoLaboMBb5m8kf1s06MJMbpCrJVzKHXVOzKb9dq6nQNK8tUKB6l9hvU2yfaMow',
                'donor_prayer' => 'Infaq rutin untuk anak-anak santri mengaji. Semoga berkah.',
                'status' => 'pending',
                'verified_at' => null,
                'verified_by_user_id' => null,
                'rejection_reason' => null,
                'created_at' => now()->subMinutes(45),
                'updated_at' => now()->subMinutes(45),
            ],
            [
                'reference_code' => 'ALF-20261119-0093',
                'donation_program_id' => 3,
                'donor_name' => 'Hamba Allah',
                'is_anonymous' => true,
                'phone_wa' => '+62 852-9900-1122',
                'amount' => 500000.00,
                'frequency' => 'sekali',
                'payment_method' => 'transfer_sulutgo',
                'proof_image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKaW5ksffmuV4CgWAEL3b7s_JlSE7AuwouIjDpPGjI4rzhnG6HCIDIsh2n4moKu6FaHBCw_qGCW2duPt4MNjrKZAq9q5czZoT4Gxb7HLBqxTwUnGNhW2zWSr3BW8F_yKJXTl6pEu9IzHcgwEf3wDIM419xK0BkMKuvCS9x-Cr7NoLaboMBb5m8kf1s06MJMbpCrJVzKHXVOzKb9dq6nQNK8tUKB6l9hvU2yfaMow',
                'donor_prayer' => 'Semoga dimudahkan dalam setiap urusan umat dan anak-anak yatim.',
                'status' => 'pending',
                'verified_at' => null,
                'verified_by_user_id' => null,
                'rejection_reason' => null,
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'reference_code' => 'ALF-20261119-0094',
                'donation_program_id' => 2,
                'donor_name' => 'Keluarga Bpk. H. Syamsuddin',
                'is_anonymous' => false,
                'phone_wa' => '+62 811-9988-7766',
                'amount' => 500000.00,
                'frequency' => 'bulanan',
                'payment_method' => 'transfer_bsi',
                'proof_image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKaW5ksffmuV4CgWAEL3b7s_JlSE7AuwouIjDpPGjI4rzhnG6HCIDIsh2n4moKu6FaHBCw_qGCW2duPt4MNjrKZAq9q5czZoT4Gxb7HLBqxTwUnGNhW2zWSr3BW8F_yKJXTl6pEu9IzHcgwEf3wDIM419xK0BkMKuvCS9x-Cr7NoLaboMBb5m8kf1s06MJMbpCrJVzKHXVOzKb9dq6nQNK8tUKB6l9hvU2yfaMow',
                'donor_prayer' => 'Infaq listrik operasional masjid bulan berjalan.',
                'status' => 'pending',
                'verified_at' => null,
                'verified_by_user_id' => null,
                'rejection_reason' => null,
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3),
            ],
            // Verified Donations
            [
                'reference_code' => 'ALF-20261118-0089',
                'donation_program_id' => 1,
                'donor_name' => 'Bpk. Ahmad Subarjo',
                'is_anonymous' => false,
                'phone_wa' => '+62 813-1122-3344',
                'amount' => 500000.00,
                'frequency' => 'sekali',
                'payment_method' => 'qris',
                'proof_image_path' => null,
                'donor_prayer' => 'Alhamdulillah, semoga barokah.',
                'status' => 'verified',
                'verified_at' => now()->subDay(),
                'verified_by_user_id' => $bendahara->id,
                'rejection_reason' => null,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'reference_code' => 'ALF-20261117-0085',
                'donation_program_id' => 3,
                'donor_name' => 'Hamba Allah',
                'is_anonymous' => true,
                'phone_wa' => '+62 812-9911-2233',
                'amount' => 1000000.00,
                'frequency' => 'sekali',
                'payment_method' => 'transfer_bsi',
                'proof_image_path' => null,
                'donor_prayer' => 'Pahalanya untuk kedua orang tua kami.',
                'status' => 'verified',
                'verified_at' => now()->subDays(2),
                'verified_by_user_id' => $bendahara->id,
                'rejection_reason' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        foreach ($donations as $d) {
            DB::table('donations')->insert($d);
        }

        // 10. Cash Mutations (Buku Kas Umum Digital)
        $mutations = [
            // Pemasukan
            [
                'transaction_code' => 'KAS-IN-20261119-01',
                'type' => 'masuk',
                'source_account' => 'tunai_brankas',
                'category' => 'kotak_jumat',
                'amount' => 4850000.00,
                'description' => "Hasil penghitungan kotak amal infaq Jum'at jamaah pekan ke-2 November 2026",
                'proof_image_path' => null,
                'donation_id' => null,
                'recorded_by_user_id' => $bendahara->id,
                'transaction_date' => '2026-11-13',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'transaction_code' => 'KAS-IN-20261118-02',
                'type' => 'masuk',
                'source_account' => 'bsi',
                'category' => 'qris_online',
                'amount' => 12500000.00,
                'description' => 'Rekonsiliasi penerimaan donasi QRIS Nasional & Transfer BSI periode 1-15 November',
                'proof_image_path' => null,
                'donation_id' => null,
                'recorded_by_user_id' => $bendahara->id,
                'transaction_date' => '2026-11-15',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'transaction_code' => 'KAS-IN-20261117-03',
                'type' => 'masuk',
                'source_account' => 'sulutgo',
                'category' => 'infaq_jamaah',
                'amount' => 7500000.00,
                'description' => 'Infaq berkala dari Paguyuban Warga Muslim Sinonsayang di Manado',
                'proof_image_path' => null,
                'donation_id' => null,
                'recorded_by_user_id' => $bendahara->id,
                'transaction_date' => '2026-11-17',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            // Pengeluaran
            [
                'transaction_code' => 'KAS-OUT-20261110-01',
                'type' => 'keluar',
                'source_account' => 'bsi',
                'category' => 'renovasi_material',
                'amount' => 7800000.00,
                'description' => 'Pembelian semen, pasir, dan keramik ruang kelas santri TPA tahap II',
                'proof_image_path' => null,
                'donation_id' => null,
                'recorded_by_user_id' => $bendahara->id,
                'transaction_date' => '2026-11-10',
                'created_at' => now()->subDays(9),
                'updated_at' => now()->subDays(9),
            ],
            [
                'transaction_code' => 'KAS-OUT-20261105-02',
                'type' => 'keluar',
                'source_account' => 'bsi',
                'category' => 'operasional_listrik',
                'amount' => 1650000.00,
                'description' => 'Pembayaran tagihan listrik PLN daya 5500VA dan token pompa air wudhu',
                'proof_image_path' => null,
                'donation_id' => null,
                'recorded_by_user_id' => $bendahara->id,
                'transaction_date' => '2026-11-05',
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],
            [
                'transaction_code' => 'KAS-OUT-20261102-03',
                'type' => 'keluar',
                'source_account' => 'tunai_brankas',
                'category' => 'bisyarah_guru_tpa',
                'amount' => 3750000.00,
                'description' => 'Kafalah / bisyarah 5 orang asatidz & ustadzah TPA Al-Fattah bulan berjalan',
                'proof_image_path' => null,
                'donation_id' => null,
                'recorded_by_user_id' => $bendahara->id,
                'transaction_date' => '2026-11-02',
                'created_at' => now()->subDays(17),
                'updated_at' => now()->subDays(17),
            ],
            [
                'transaction_code' => 'KAS-OUT-20261101-04',
                'type' => 'keluar',
                'source_account' => 'sulutgo',
                'category' => 'santunan_dhuafa',
                'amount' => 3000000.00,
                'description' => 'Penyaluran santunan paket pangan dhuafa untuk 30 mustahik Desa Ongkaw 3',
                'proof_image_path' => null,
                'donation_id' => null,
                'recorded_by_user_id' => $bendahara->id,
                'transaction_date' => '2026-11-01',
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],
        ];

        foreach ($mutations as $m) {
            DB::table('cash_mutations')->insert($m);
        }

        // 11. Agendas
        $agendas = [
            [
                'title' => "Kajian Fiqih Ibadah Praktis & Fiqih Muamalah",
                'slug' => 'kajian-fiqih-ibadah-praktis',
                'category' => 'kajian_rutin',
                'date_time' => '2026-11-19 18:30:00',
                'end_time' => '2026-11-19 20:00:00',
                'location' => 'Ruang Sholat Utama Masjid Al-Fattah',
                'speaker_name' => 'Ustadz Ahmad Fauzi, Lc.',
                'speaker_title' => 'Alumni Univ. Al-Azhar Kairo / Imam Rawatib',
                'description' => "Kajian rutin setiap malam Jum'at ba'da Maghrib mengupas tuntas bab Thaharah, shalat sunnah, dan fiqih muamalah kontemporer.",
                'poster_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDeaan5v_ITEJ5oo7GLNamaTM1i1aajGh1nwjiUcDOCwY3Dx0DQ0UQvj0fOvQSTOmyEAlycSqUpElSw6gndzrEUgCtmjSkMd_QdfpC4ueHiu4Kwjq13Gb7Tt4CNTyVHR8tJHmmfZB9xK2v6s74AjqWH-XTr_96nfMMAgzusjbaR0Nx34QMvz9UZD7exQwyWH_dO1gvPiaZrslIYaeyLPcV2rsK5KURGryU9nqcsyg',
                'is_pinned' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Kajian Subuh Berkah & Sarapan Ukhuwah',
                'slug' => 'kajian-subuh-berkah',
                'category' => 'kajian_rutin',
                'date_time' => '2026-11-22 05:00:00',
                'end_time' => '2026-11-22 06:30:00',
                'location' => 'Serambi Utama Masjid Al-Fattah',
                'speaker_name' => 'Ust. Harun Mokodompis, S.Ag.',
                'speaker_title' => 'Penyuluh Agama Islam Kemenag Sinonsayang',
                'description' => "Menikmati fajar dengan untaian nasihat tadabbur juz amma dilanjutkan dengan ramah tamah sarapan bubur manado bersama jamaah.",
                'poster_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCpPpe_P-7arUP48FVmCf5sVMnTMsw75xavoWMBKVRYjDUjKIoY1oyOT08_kwu_RmxrwRdVelXBRPEIpwZuhML96T3gghFbpdXL76XTJ0mYIFTILDmEtUMLybaSRTufU3yhJqe87VL0wOmQuJ156KciuJO3kJAhz20EYdrwlSMiOXsjItFuoj1wUiXmAENEWXOXyzKp1XZ45fGTF8HsXzHA4TFWLDtfmma885rIVw',
                'is_pinned' => false,
                'status' => 'published',
            ],
            [
                'title' => "Wisuda & Khataman Santri TPA Al-Fattah Angkatan VIII",
                'slug' => 'wisuda-khataman-santri-tpa-angkatan-viii',
                'category' => 'tpa',
                'date_time' => '2026-12-13 08:30:00',
                'end_time' => '2026-12-13 12:00:00',
                'location' => 'Aula Serbaguna Masjid Al-Fattah',
                'speaker_name' => 'Kepala Kantor Kemenag Minahasa Selatan',
                'speaker_title' => 'Tamu Kehormatan & Penguji Tilawati',
                'description' => "Pelepasan 28 santri yang telah menyelesaikan khatam 30 juz Al-Qur'an dan ujian munaqasyah metode Tilawati tahun ajaran 2026.",
                'poster_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCYXBWE-9BUbMIP0YH9YyrqBFlCOwkuYfSTg2oAUln4RmU4uGQvw_ASpBkFC1RPPmMU499745n9YrI0k9uVqXNsO2elKcv3p6HlJO7z70lXJTgTdxMQsHXBB-txz9sAL35q5OHudTO6hcaUHyT_XUIsQ8Q2wkQwXoN0zpGvMMD0w7ecRA05MsoTMkSW0U_x9EVfGlTv7BX7j56SrQVq6Ob4-3aeJ3XfL-G8NK1iDw',
                'is_pinned' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Tabligh Akbar Menyambut Bulan Suci Ramadhan 1448 H',
                'slug' => 'tabligh-akbar-ramadhan-1448h',
                'category' => 'phbi',
                'date_time' => '2026-12-28 19:30:00',
                'end_time' => '2026-12-28 22:00:00',
                'location' => 'Halaman Terbuka Masjid Al-Fattah',
                'speaker_name' => 'Habib Ali Bin Abdurrahman Al-Jufri',
                'speaker_title' => 'Dai Nasional & Pimpinan Majelis Khidmah',
                'description' => "Kajian akbar menyongsong kedatangan bulan suci Ramadhan, dihadiri jamaah lintas kecamatan se-Minahasa Selatan.",
                'poster_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCpPpe_P-7arUP48FVmCf5sVMnTMsw75xavoWMBKVRYjDUjKIoY1oyOT08_kwu_RmxrwRdVelXBRPEIpwZuhML96T3gghFbpdXL76XTJ0mYIFTILDmEtUMLybaSRTufU3yhJqe87VL0wOmQuJ156KciuJO3kJAhz20EYdrwlSMiOXsjItFuoj1wUiXmAENEWXOXyzKp1XZ45fGTF8HsXzHA4TFWLDtfmma885rIVw',
                'is_pinned' => true,
                'status' => 'published',
            ],
        ];

        foreach ($agendas as $a) {
            DB::table('agendas')->insert(array_merge($a, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 12. News & Announcements
        $news = [
            [
                'title' => 'Laporan Rekapitulasi Kas & Transparansi Keuangan BKM Bulan Oktober 2026',
                'slug' => 'laporan-rekapitulasi-kas-oktober-2026',
                'category' => 'warta',
                'excerpt' => 'Badan Kemakmuran Masjid (BKM) Al-Fattah merilis rincian penerimaan dan penyaluran dana infaq umat periode Oktober 2026.',
                'content' => "Alhamdulillah, segala puji bagi Allah Subhanahu wa Ta'ala. BKM Masjid Al-Fattah Ongkaw 3 menyampaikan laporan pertanggungjawaban kas umat secara transparan. Pada bulan Oktober 2026, total infaq yang dihimpun dari jamaah melalui transfer BSI, QRIS, dan kotak amal fisik berjumlah Rp24.850.000 dengan serapan penyaluran Rp16.200.000 untuk kelanjutan renovasi TPA, operasional listrik, dan kafalah guru ngaji. Sisa saldo kas terjaga per awal November adalah Rp48.650.000 yang tersimpan aman di rekening bank dan brankas fisik.",
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKaW5ksffmuV4CgWAEL3b7s_JlSE7AuwouIjDpPGjI4rzhnG6HCIDIsh2n4moKu6FaHBCw_qGCW2duPt4MNjrKZAq9q5czZoT4Gxb7HLBqxTwUnGNhW2zWSr3BW8F_yKJXTl6pEu9IzHcgwEf3wDIM419xK0BkMKuvCS9x-Cr7NoLaboMBb5m8kf1s06MJMbpCrJVzKHXVOzKb9dq6nQNK8tUKB6l9hvU2yfaMow',
                'published_at' => now()->subDays(5),
                'is_pinned' => true,
                'status' => 'published',
                'author_id' => $humas->id,
            ],
            [
                'title' => 'Pendaftaran Santri Baru TPA Al-Fattah Semester Genap Telah Dibuka',
                'slug' => 'pendaftaran-santri-baru-tpa-semester-genap',
                'category' => 'pengumuman',
                'excerpt' => 'Bagi para orang tua yang ingin mendaftarkan putra-putrinya belajar Al-Qur’an metode Tilawati, formulir online kini dapat diakses.',
                'content' => "Pendidikan Al-Qur'an usia dini merupakan pondasi utama karakter generasi muda. TPA Al-Fattah membuka kesempatan bagi 30 santri baru untuk kelas Iqro/Tilawati dan kelas Tahfidz Juz 30. Jadwal belajar setiap Senin hingga Kamis pukul 15.30 - 17.00 WITA. Pendaftaran bebas biaya untuk warga dhuafa.",
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDJ5qx5ryIfXW_piIAocva0GXXigxwxE64PDshMFYQ2FkZWy_FrC-2HYYTJPSrskWW4avb-9el64uNOLXxZ-YTVAe9mjbN55RSQxn7qC8RKJfUzoPuJCCZO3CPSflO05l0aRg6H28M-op9zBOPj8LbzpkHGCpGbIVfHZb45HDEoIUvuUx9DpM26-dh5vjnp2s7GyQv2bWzmKyEuRBSiuzN8mP5XdrWYGzJwm2-XBw',
                'published_at' => now()->subDays(10),
                'is_pinned' => false,
                'status' => 'published',
                'author_id' => $humas->id,
            ],
            [
                'title' => 'Aksi Gotong Royong Kebersihan Serambi Masjid Menjelang Jumat Berkah',
                'slug' => 'aksi-gotong-royong-kebersihan-serambi-masjid',
                'category' => 'warta',
                'excerpt' => 'Puluhan pengurus bersama Remaja Islam Masjid (RISMA) membersihkan karpet, area wudhu, dan halaman masjid.',
                'content' => "Kebersihan adalah sebagian dari iman. Remaja masjid dan para sesepuh bergotong royong mencuci sajadah panjang, membersihkan kran air wudhu, dan merapikan perpustakaan mini masjid. Kegiatan rutin ini bertujuan memberikan kenyamanan maksimal bagi para jamaah salat Jumat dan musafir di jalan Trans Sulawesi.",
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBWEnZ-aix2USfTBd4Ft2y9pJ2_mXkp_DaSnf4QowwbYwK_MW6nk5RcMDGwn27kJ9oOVX2aQfiElcCLM_3ZxQoPlocspfpehpjp7aU-QjQp_LnrHHViXiwLfFrpbZpWI1W40HqIUtnSQj8dmwboxJMCPPeIXTfh2NhIcyX9EZuBQWBP7UrxFWxfPe6REYep7dFcClov67m5YbQHzdiP2brMQKPIzgZRFhyzqwqCVA',
                'published_at' => now()->subDays(15),
                'is_pinned' => false,
                'status' => 'published',
                'author_id' => $humas->id,
            ],
        ];

        foreach ($news as $n) {
            DB::table('news_announcements')->insert(array_merge($n, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 13. Board Members (Susunan Pengurus BKM 2024-2029)
        $board = [
            [
                'name' => "H. Mas'ud Mokoginta",
                'title_degree' => 'Sesepuh / Tokoh Masyarakat Sinonsayang',
                'position' => 'Penasihat Utama & Pembina BKM',
                'division' => 'pembina',
                'period' => '2024–2029',
                'phone' => '+62 812-1111-2222',
                'photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCWVC_hgmOuZCWiRPRbNQFQJ-ha6s3PjFKvGOmALm7zevyGMGujbuBwxj58nyHie8wy8IVxdmlYNwHHcu-ocFAYrj-RNMZGx9WkeCNikomxs029-T2HfKOJal50h1Zo9W-PeCR0urhTVb7LYrdGUGTfCuvFmsb_gGhgCaWa-78MZimS04DHoqv36cEvDUBKSUsaD6KWXiHQaF9QSRsCwMVZpm6TE4stxEzruD1kYQ',
                'order_index' => 1,
            ],
            [
                'name' => 'H. Ismail Paputungan',
                'title_degree' => 'Ketua Umum BKM',
                'position' => 'Ketua Badan Kemakmuran Masjid',
                'division' => 'harian',
                'period' => '2024–2029',
                'phone' => '+62 812-3456-7890',
                'photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDDRYAoXqkdk0GzUMVm3YDfLdAwb6NJbj-EBVPZtyhX5aRZ88X8a8_6A-bxtXNIocp-46zRK9qw9ZNviLEcyFNf4YtHnRnVgswn5MlrkTvxI0mPfpDe_pwFGnOvn7nhddVSB3r2yiAcxV6gRrcl7vmtSTIY6TAZeSH9E7AoiRz8xGWo2KBET8mObGyYqeRvX7NT0EK396dhpmC4RjaxcM5T7ytigpSk_KxxPpkXSw',
                'order_index' => 2,
            ],
            [
                'name' => 'Muh. Ridwan Gobel, S.Pd.',
                'title_degree' => 'Sekretaris Umum',
                'position' => 'Sekretaris & Divisi Humas/Syiar Dakwah',
                'division' => 'harian',
                'period' => '2024–2029',
                'phone' => '+62 813-9876-5432',
                'photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAY5N9cPki_vMAGcXkh2KAqOS4g-e1NVUPCgX9MrsqWKeQ2ca3ewcCwAxSj31ktxBhVDl3rDiL7ILPQ5ilLWMPkfygHTfF2Prfpfk2AAOjFxmDchCPl5_azZdosO7DE4flmlMuEXmtGxNa-j-WZBiE-kgJQuXSk5N9acuQruv3QJi8yldI7Nr9HWGHyL2btA62Q2QCEJIxxquuKILulKx8PRyEpIZPYHZZGc8LiuQ',
                'order_index' => 3,
            ],
            [
                'name' => 'Zulkifli Mamonto, S.E.',
                'title_degree' => 'Bendahara Umum',
                'position' => 'Bendahara & Tata Kelola Kas Masjid',
                'division' => 'harian',
                'period' => '2024–2029',
                'phone' => '+62 821-5544-3322',
                'photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBFx70OuSWM3yB-9_TeNu0to6sgXxR7_VzIG14kzV-OdoTWGO2zomOunEKfQK0zd2FsCZLIQqiZEzj5BvSjflug326gh5XNEGArBIpnQctoFcBtfPddHiHJhs7jgKQz6tInvQ1OmLe6oN_W_fvf4aeZ1h4SnVtfPGO93s83l43L7ae1bxbd6-4uqVNm3yyG1KsVCq25c0WUOsynOUZe9Qg1asF083S6rHtA-QpkqA',
                'order_index' => 4,
            ],
            [
                'name' => 'Ustadz Ahmad Fauzi, Lc.',
                'title_degree' => 'Imam Rawatib',
                'position' => 'Koordinator Bidang Peribadatan & Dakwah',
                'division' => 'imam_muadzin',
                'period' => '2024–2029',
                'phone' => '+62 811-2233-4455',
                'photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCWVC_hgmOuZCWiRPRbNQFQJ-ha6s3PjFKvGOmALm7zevyGMGujbuBwxj58nyHie8wy8IVxdmlYNwHHcu-ocFAYrj-RNMZGx9WkeCNikomxs029-T2HfKOJal50h1Zo9W-PeCR0urhTVb7LYrdGUGTfCuvFmsb_gGhgCaWa-78MZimS04DHoqv36cEvDUBKSUsaD6KWXiHQaF9QSRsCwMVZpm6TE4stxEzruD1kYQ',
                'order_index' => 5,
            ],
            [
                'name' => 'Bilal Karim',
                'title_degree' => 'Muadzin Tetap',
                'position' => 'Bilal & Penanggung Jawab Sound System / TV',
                'division' => 'imam_muadzin',
                'period' => '2024–2029',
                'phone' => '+62 853-4433-2211',
                'photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAY5N9cPki_vMAGcXkh2KAqOS4g-e1NVUPCgX9MrsqWKeQ2ca3ewcCwAxSj31ktxBhVDl3rDiL7ILPQ5ilLWMPkfygHTfF2Prfpfk2AAOjFxmDchCPl5_azZdosO7DE4flmlMuEXmtGxNa-j-WZBiE-kgJQuXSk5N9acuQruv3QJi8yldI7Nr9HWGHyL2btA62Q2QCEJIxxquuKILulKx8PRyEpIZPYHZZGc8LiuQ',
                'order_index' => 6,
            ],
            [
                'name' => 'Rifqi Pratama',
                'title_degree' => 'Ketua RISMA',
                'position' => 'Koordinator Remaja Islam Masjid Al-Fattah',
                'division' => 'risma',
                'period' => '2024–2029',
                'phone' => '+62 895-6677-8899',
                'photo' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAY5N9cPki_vMAGcXkh2KAqOS4g-e1NVUPCgX9MrsqWKeQ2ca3ewcCwAxSj31ktxBhVDl3rDiL7ILPQ5ilLWMPkfygHTfF2Prfpfk2AAOjFxmDchCPl5_azZdosO7DE4flmlMuEXmtGxNa-j-WZBiE-kgJQuXSk5N9acuQruv3QJi8yldI7Nr9HWGHyL2btA62Q2QCEJIxxquuKILulKx8PRyEpIZPYHZZGc8LiuQ',
                'order_index' => 7,
            ],
        ];

        foreach ($board as $b) {
            DB::table('board_members')->insert(array_merge($b, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 14. Gallery Albums & Photos (Matching the 3x2 grid from reference)
        $albumId = DB::table('gallery_albums')->insertGetId([
            'title' => 'Dokumentasi Syiar & Ibadah Umat 2026',
            'slug' => 'dokumentasi-syiar-ibadah-2026',
            'description' => 'Merekam jejak kebersamaan, gotong royong, dan kegiatan peribadatan di Masjid Al-Fattah Ongkaw 3.',
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAk3h93DpJv3kS7gFs3HJJ0XvUOjg9VhQTBFDeMdRUL5ZsxzSzFWdNitRznhrVcQhJi7Y3O07uizNe9h2A8z1zSAx6Id-dXDkOcPSXKoSKY1IZO-TCCoS2yk9H2tMflsuSZNbzyW--5Y4kFiVsKKYRU0fbgQEGBPYGyOfz_Cz0jaeH557hLsTMDP3IF8JtbzPbaOKuTX654dmyu4XGb-nVhHowb78Xj6ffrL-w2hw',
            'event_date' => '2026-11-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $photos = [
            [
                'album_id' => $albumId,
                'photo_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAk3h93DpJv3kS7gFs3HJJ0XvUOjg9VhQTBFDeMdRUL5ZsxzSzFWdNitRznhrVcQhJi7Y3O07uizNe9h2A8z1zSAx6Id-dXDkOcPSXKoSKY1IZO-TCCoS2yk9H2tMflsuSZNbzyW--5Y4kFiVsKKYRU0fbgQEGBPYGyOfz_Cz0jaeH557hLsTMDP3IF8JtbzPbaOKuTX654dmyu4XGb-nVhHowb78Xj6ffrL-w2hw',
                'caption' => 'Salat Idul Fitri Berjamaah di halaman terbuka masjid (420 Jamaah)',
                'category' => 'ibadah_akbar',
                'order_index' => 1,
            ],
            [
                'album_id' => $albumId,
                'photo_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAKeXEOObcUz_UMOVd9jLZZJEFrsxYvZePPeNvHD-b1wnFxh_B8XExXOr2RwuCI234sk69WiOAEOwFkijRn9LIkPoxuzxpVVoTIEhKbiNddSY_8W1Ro_qziy5yx_d_Y3tBymlHiTZPubesFpaVS5OX14Mr_nFWg5AUNDudP_wQIh2qQGzmuzP5Y91yY3QCHCcCIxbiGMx5ZJQI6-TJWjBWsmtvvRiPwBZxjOpmArA',
                'caption' => 'Buka Puasa Bersama & Sholat Tarawih Setiap Hari Ramadhan',
                'category' => 'ramadhan_berkah',
                'order_index' => 2,
            ],
            [
                'album_id' => $albumId,
                'photo_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBWEnZ-aix2USfTBd4Ft2y9pJ2_mXkp_DaSnf4QowwbYwK_MW6nk5RcMDGwn27kJ9oOVX2aQfiElcCLM_3ZxQoPlocspfpehpjp7aU-QjQp_LnrHHViXiwLfFrpbZpWI1W40HqIUtnSQj8dmwboxJMCPPeIXTfh2NhIcyX9EZuBQWBP7UrxFWxfPe6REYep7dFcClov67m5YbQHzdiP2brMQKPIzgZRFhyzqwqCVA',
                'caption' => 'Gotong Royong Bersih Masjid Bersama Remaja & Warga Ahad Pagi',
                'category' => 'aksi_kebersihan',
                'order_index' => 3,
            ],
            [
                'album_id' => $albumId,
                'photo_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAxcJ7NsOR54b-RMhaEHO7OCrPgcLnI50DE4PllPaFHpINisUZq0aAF_-ZMPAVF0bYEagFaZYjIUoDPWwEsOaPt4poRA2shTJhSYSCsYP0dEmmqfvd6xx1nU8RTxYteBTgTYKy16ACJ13Np2nGlhezbi0_swG1xzu5LpPliQUIO6iJqU5rLcIWBuMYgMxG39OiIokyRUXRrWctxQhRaUXs4XJLcB9TV96estIjLgw',
                'caption' => 'Penyaluran Paket Sembako Amanah Muzakki untuk Warga Dhuafa',
                'category' => 'bakti_sosial',
                'order_index' => 4,
            ],
            [
                'album_id' => $albumId,
                'photo_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCYXBWE-9BUbMIP0YH9YyrqBFlCOwkuYfSTg2oAUln4RmU4uGQvw_ASpBkFC1RPPmMU499745n9YrI0k9uVqXNsO2elKcv3p6HlJO7z70lXJTgTdxMQsHXBB-txz9sAL35q5OHudTO6hcaUHyT_XUIsQ8Q2wkQwXoN0zpGvMMD0w7ecRA05MsoTMkSW0U_x9EVfGlTv7BX7j56SrQVq6Ob4-3aeJ3XfL-G8NK1iDw',
                'caption' => 'Khataman & Wisuda Santri TPA Al-Fattah Angkatan VII',
                'category' => 'prestasi_santri',
                'order_index' => 5,
            ],
            [
                'album_id' => $albumId,
                'photo_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCpPpe_P-7arUP48FVmCf5sVMnTMsw75xavoWMBKVRYjDUjKIoY1oyOT08_kwu_RmxrwRdVelXBRPEIpwZuhML96T3gghFbpdXL76XTJ0mYIFTILDmEtUMLybaSRTufU3yhJqe87VL0wOmQuJ156KciuJO3kJAhz20EYdrwlSMiOXsjItFuoj1wUiXmAENEWXOXyzKp1XZ45fGTF8HsXzHA4TFWLDtfmma885rIVw',
                'caption' => 'Tabligh Akbar Syiar Ukhuwah Bersama Dai Kondang Provinsi',
                'category' => 'tabligh_akbar',
                'order_index' => 6,
            ],
        ];

        foreach ($photos as $p) {
            DB::table('gallery_photos')->insert(array_merge($p, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 15. Testimonials
        $testimonials = [
            [
                'name' => "H. Mas'ud Mokoginta",
                'role_title' => 'Tokoh Masyarakat Sinonsayang',
                'content' => "Kenyamanan ibadah di Al-Fattah luar biasa. Area wudhu dan toilet selalu kering dan wangi, pendingin ruangan sejuk, dan jamaah ramah menyambut musafir yang melintas di jalan Trans Sulawesi.",
                'rating' => 5,
                'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCWVC_hgmOuZCWiRPRbNQFQJ-ha6s3PjFKvGOmALm7zevyGMGujbuBwxj58nyHie8wy8IVxdmlYNwHHcu-ocFAYrj-RNMZGx9WkeCNikomxs029-T2HfKOJal50h1Zo9W-PeCR0urhTVb7LYrdGUGTfCuvFmsb_gGhgCaWa-78MZimS04DHoqv36cEvDUBKSUsaD6KWXiHQaF9QSRsCwMVZpm6TE4stxEzruD1kYQ',
                'is_featured' => false,
                'is_active' => true,
                'order_index' => 1,
            ],
            [
                'name' => 'Ibu Siti Nurhaliza',
                'role_title' => 'Wali Santri TPA Al-Fattah',
                'content' => "Sistem pencatatan sedekah digital dan laporan keuangan yang dipublikasikan secara rutin memberikan ketenangan hati bagi kami para donatur. Dana pembangunan santri TPA benar-benar terealisasi cepat dan transparan.",
                'rating' => 5,
                'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA563yhHYb3jTHEXMsHKSUwHXrRg8R2mkZ_gGmJ81jCKoxlNFlMvKDaDXFULIZWN_kMI0RoecjQRd3JtqmXr0ssx_Wx4MQaYpGi1-qa15PHD1lO2JpMWsjqML-pgSoqvA1FTsUxOYhNjYq2eH9g0qQGkYS4eD07WxPqeja1uyas0RN8guzGQYNLUunveQZJOZRhDw5fdo-PvdSRmu6YWnO-vBufHbmliSCvYDXGhg',
                'is_featured' => true, // Featured navy card!
                'is_active' => true,
                'order_index' => 2,
            ],
            [
                'name' => 'Rifqi Pratama',
                'role_title' => 'Ketua Remaja Masjid Ongkaw 3',
                'content' => "Anak-anak muda karang taruna di desa sangat terbantu dengan adanya bimbingan rohani dan pembinaan karakter remaja di masjid. Masjid bukan hanya tempat salat, tapi pusat kerukunan desa.",
                'rating' => 5,
                'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAY5N9cPki_vMAGcXkh2KAqOS4g-e1NVUPCgX9MrsqWKeQ2ca3ewcCwAxSj31ktxBhVDl3rDiL7ILPQ5ilLWMPkfygHTfF2Prfpfk2AAOjFxmDchCPl5_azZdosO7DE4flmlMuEXmtGxNa-j-WZBiE-kgJQuXSk5N9acuQruv3QJi8yldI7Nr9HWGHyL2btA62Q2QCEJIxxquuKILulKx8PRyEpIZPYHZZGc8LiuQ',
                'is_featured' => false,
                'is_active' => true,
                'order_index' => 3,
            ],
        ];

        foreach ($testimonials as $t) {
            DB::table('testimonials')->insert(array_merge($t, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 16. Inbox Messages (5 Unread Messages as shown in Content Dashboard)
        $messages = [
            [
                'name' => 'Faisal Paputungan',
                'email' => 'faisal.p@gmail.com',
                'phone' => '+62 813-2233-4455',
                'category' => 'pinjam_aula',
                'message' => 'Assalamu’alaikum pengurus BKM, kami ingin mengajukan izin peminjaman aula serbaguna masjid untuk acara aqiqah keluarga pada hari Sabtu tanggal 28 November 2026 ba’da Ashar. Mohon info syarat dan ketentuannya. Terima kasih.',
                'is_read' => false,
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'name' => 'Ibu Nurul Hidayah',
                'email' => 'nurul.h@yahoo.com',
                'phone' => '+62 852-1122-3344',
                'category' => 'pendaftaran_tpa',
                'message' => 'Assalamu’alaikum, apakah santri pindahan dari luar kota bisa langsung masuk kelas Tilawati jilid 3? Anak kami usia 8 tahun baru pindah ke Ongkaw 3. Syukron.',
                'is_read' => false,
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ],
            [
                'name' => 'H. Dahlan Sumantri',
                'email' => 'dahlan.s@gmail.com',
                'phone' => '+62 812-7788-9900',
                'category' => 'doa',
                'message' => 'Mohon titip doa untuk kesembuhan ibunda kami yang sedang dirawat di RS Kalooran Amurang, semoga Allah angkat penyakitnya dan lekas sehat wal afiat.',
                'is_read' => false,
                'created_at' => now()->subHours(9),
                'updated_at' => now()->subHours(9),
            ],
            [
                'name' => 'Irwan Manoppo',
                'email' => 'irwan.manoppo@gmail.com',
                'phone' => '+62 821-3344-5566',
                'category' => 'pertanyaan',
                'message' => 'Apakah Masjid Al-Fattah menyediakan layanan jemput jenazah dengan mobil ambulans untuk wilayah Sinonsayang? Dan nomor darurat siapa yang bisa dihubungi saat malam hari?',
                'is_read' => false,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'name' => 'Siti Aisyah Pontoh',
                'email' => 'siti.pontoh@gmail.com',
                'phone' => '+62 853-9988-7766',
                'category' => 'pengaduan',
                'message' => 'Air kran wudhu di bagian sayap kiri wanita sedikit mengecil saat menjelang salat Maghrib, mohon dicek pipa pompanya pengurus. Jazakumullahu khair.',
                'is_read' => false,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        foreach ($messages as $msg) {
            DB::table('inbox_messages')->insert($msg);
        }

        // 17. Telegram Settings
        DB::table('telegram_settings')->insert([
            'bot_token' => '7928374928:AAHq_bXYZ9812_sample_alfattah',
            'bot_username' => '@AlFattahOngkawBot',
            'webhook_url' => 'http://ongkaw.test/api/telegram/webhook',
            'is_active' => true,
            'notify_on_donation' => true,
            'notify_daily_recap' => true,
            'daily_recap_time' => '21:00',
            'admin_chat_ids' => json_encode([
                ['name' => 'Zulkifli Mamonto (Bendahara)', 'chat_id' => '682910291', 'role' => 'Bendahara'],
                ['name' => 'H. Ismail Paputungan (Ketua)', 'chat_id' => '102938475', 'role' => 'Ketua BKM'],
                ['name' => 'Grup Forum Inti BKM Al-Fattah', 'chat_id' => '-100192837465', 'role' => 'Kanal Broadcast'],
            ]),
            'last_ping_at' => now()->subMinutes(15),
            'last_ping_status' => '200 OK (Latensi 128ms)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 18. Audit Logs
        $logs = [
            [
                'user_id' => $bendahara->id,
                'user_name' => 'Zulkifli Mamonto, S.E.',
                'action' => 'Verifikasi Donasi Masuk',
                'module' => 'Keuangan',
                'details' => 'Memverifikasi donasi Rp500.000 (Ref: ALF-20261118-0089) via QRIS',
                'ip_address' => '192.168.1.45',
                'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64)',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'user_id' => $humas->id,
                'user_name' => 'Muh. Ridwan Gobel, S.Pd.',
                'action' => 'Pembaruan Jadwal Khatib',
                'module' => 'Konten',
                'details' => 'Memperbarui konfirmasi kehadiran Khatib Jumat 20 Nov: Ust. Ahmad Fauzi, Lc.',
                'ip_address' => '192.168.1.12',
                'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64)',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'user_id' => $superadmin->id,
                'user_name' => 'H. Ismail Paputungan',
                'action' => 'Kalibrasi Display TV LED',
                'module' => 'Sistem',
                'details' => 'Mengatur kecepatan running text TV masjid menjadi normal dan mengaktifkan auto-dim salat.',
                'ip_address' => '192.168.1.10',
                'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64)',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
        ];

        foreach ($logs as $log) {
            DB::table('audit_logs')->insert($log);
        }
    }
}
