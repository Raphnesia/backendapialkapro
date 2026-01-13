<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramKhususPage;
use App\Models\ProgramKhususType;

class ProgramKhususSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create ProgramKhususPage
        ProgramKhususPage::create([
            'hero_title' => 'Program Khusus',
            'hero_subtitle' => 'Program unggulan SMP Muhammadiyah Al Kautsar PK Kartasura yang dirancang untuk mengembangkan potensi siswa secara optimal',
            'hero_image_desktop' => '/storage/program-khusus/hero-desktop.jpg',
            'hero_image_mobile' => '/storage/program-khusus/hero-mobile.jpg',
            'overview_title' => 'Program Unggulan Kami',
            'overview_subtitle' => 'Kami menawarkan dua program khusus yang dirancang untuk mengembangkan potensi akademik dan spiritual siswa',
            'programs' => [
                [
                    'id' => 'tahfidz',
                    'title' => 'Program Tahfidz Al-Quran',
                    'subtitle' => 'Membentuk generasi Qurani melalui hafalan Al-Quran dengan metode pembelajaran yang menyenangkan dan efektif.',
                    'description' => 'Program Tahfidz Al-Quran di sekolah kami menggunakan metode pembelajaran yang telah terbukti efektif dalam membantu siswa menghafal Al-Quran dengan mudah dan menyenangkan.',
                    'image' => '/storage/program-khusus/tahfidz-program.jpg',
                    'color' => 'green',
                    'href' => '/program-khusus/tahfidz',
                    'features' => [
                        'Metode pembelajaran terbukti efektif',
                        'Ustadz dan ustadzah berpengalaman',
                        'Fasilitas ruang tahfidz yang nyaman',
                        'Lingkungan Islami yang mendukung'
                    ]
                ],
                [
                    'id' => 'ict',
                    'title' => 'Program ICT (Information and Communication Technology)',
                    'subtitle' => 'Mempersiapkan siswa menghadapi era digital dengan pembelajaran teknologi informasi dan komunikasi yang komprehensif.',
                    'description' => 'Program ICT dirancang untuk memberikan pemahaman mendalam tentang teknologi informasi dan komunikasi yang relevan dengan perkembangan zaman.',
                    'image' => '/storage/program-khusus/ict-program.jpg',
                    'color' => 'blue',
                    'href' => '/program-khusus/ict',
                    'features' => [
                        'Kurikulum ICT terkini',
                        'Laboratorium komputer modern',
                        'Pembelajaran praktis dan project-based',
                        'Sertifikasi internasional'
                    ]
                ]
            ],
            'reasons_title' => 'Mengapa Memilih Program Khusus Kami?',
            'reasons_subtitle' => 'Program khusus kami dirancang dengan pendekatan holistik untuk mengembangkan potensi siswa secara optimal, menggabungkan keahlian akademik dengan pembentukan karakter',
            'reasons' => [
                [
                    'icon' => '🎯',
                    'title' => 'Fokus Spesifik',
                    'description' => 'Setiap program dirancang dengan kurikulum yang fokus dan mendalam sesuai dengan bidang yang dipilih, memastikan penguasaan kompetensi secara komprehensif'
                ],
                [
                    'icon' => '👨‍🏫',
                    'title' => 'Pengajar Ahli',
                    'description' => 'Dibimbing oleh pengajar yang berpengalaman dan ahli di bidangnya masing-masing, dengan sertifikasi profesional dan pengalaman praktik yang luas'
                ],
                [
                    'icon' => '🏆',
                    'title' => 'Prestasi Terbukti',
                    'description' => 'Program kami telah menghasilkan siswa-siswa berprestasi di berbagai kompetisi nasional dan internasional, dengan track record yang konsisten'
                ]
            ],
            'cta_title' => 'Siap Bergabung dengan Program Khusus Kami?',
            'cta_subtitle' => 'Pilih program yang sesuai dengan minat dan bakat Anda untuk mengembangkan potensi secara optimal',
            'cta_primary_label' => 'Program Tahfidz',
            'cta_primary_url' => '/program-khusus/tahfidz',
            'cta_secondary_label' => 'Program ICT',
            'cta_secondary_url' => '/program-khusus/ict',
            'is_active' => true,
        ]);

        // Create ProgramKhususType for ICT
        ProgramKhususType::create([
            'slug' => 'ict',
            'title' => 'Program ICT',
            'subtitle' => 'Program unggulan yang memadukan pendidikan akademik dengan teknologi informasi dan komunikasi',
            'banner_desktop' => '/storage/program-khusus/ict-banner-desktop.jpg',
            'banner_mobile' => '/storage/program-khusus/ict-banner-mobile.jpg',
            'intro_badge' => 'Pendidikan Digital',
            'intro_title' => 'Menggabungkan Akademik & Digital',
            'intro_subtitle' => 'Program ICT di SMP Muhammadiyah Al Kautsar PK Kartasura dirancang khusus untuk siswa yang ingin menguasai teknologi informasi dan komunikasi sambil tetap mengikuti kurikulum akademik nasional dengan metode pembelajaran yang telah terbukti efektif.',
            'featured_image' => '/storage/program-khusus/ict-featured.jpg',
            'featured_overlay_title' => 'Suasana Pembelajaran',
            'featured_overlay_desc' => 'Lingkungan yang kondusif untuk belajar teknologi dengan fasilitas modern',
            'featured_badge' => 'Program Unggulan',
            'key_points' => [
                [
                    'icon' => '🖥️',
                    'title' => 'Teknologi Terkini',
                    'description' => 'Menggunakan perangkat dan software terbaru untuk pembelajaran ICT yang optimal, termasuk hardware kelas enterprise dan software development tools modern.'
                ],
                [
                    'icon' => '👥',
                    'title' => 'Instruktur Ahli',
                    'description' => 'Dibimbing oleh instruktur berpengalaman di bidang teknologi informasi dan programming dengan sertifikasi profesional dan pengalaman industri yang luas.'
                ]
            ],
            'features_title' => 'Mengapa Memilih Program Kami',
            'features_subtitle' => 'Alasan kuat untuk memilih program ICT kami yang telah terbukti menghasilkan lulusan berkualitas',
            'features_image' => '/storage/program-khusus/ict-features.jpg',
            'features_items' => [
                [
                    'icon' => '📚',
                    'title' => 'Metode Pembelajaran',
                    'description' => 'Menggunakan metode project-based learning dan hands-on training yang terbukti efektif dalam menguasai ICT'
                ],
                [
                    'icon' => '👥',
                    'title' => 'Bimbingan Personal',
                    'description' => 'Setiap siswa dibimbing secara individual oleh instruktur berpengalaman di bidang teknologi'
                ],
                [
                    'icon' => '🎯',
                    'title' => 'Target Skill',
                    'description' => 'Target disesuaikan kemampuan: programming, design grafis, dan digital marketing sesuai minat siswa'
                ],
                [
                    'icon' => '🏆',
                    'title' => 'Evaluasi Berkala',
                    'description' => 'Sistem monitoring dan evaluasi terstruktur untuk memastikan progress optimal dalam penguasaan skill digital'
                ]
            ],
            'benefits_badge' => 'Tiga Kompetensi Utama',
            'benefits_title' => 'Dampak Positif Program ICT',
            'benefits_subtitle' => 'Program ICT memberikan dampak positif komprehensif melalui tiga kompetensi utama',
            'benefits_items' => [
                [
                    'badge_label' => 'Kompetensi 1',
                    'title' => 'Programming & Development',
                    'description' => 'Pembelajaran programming yang komprehensif meliputi Web Development (HTML, CSS, JavaScript), Mobile Development, dan Database Management untuk membentuk developer handal yang siap bersaing di era digital.',
                    'image' => '/storage/program-khusus/ict-benefit-1.jpg',
                    'layout' => 'imageLeft'
                ],
                [
                    'badge_label' => 'Kompetensi 2',
                    'title' => 'Digital Design',
                    'description' => 'Kurikulum design grafis yang terukur dan sistematis untuk membentuk kreativitas digital, mencakup UI/UX design, graphic design, dan multimedia production.',
                    'image' => '/storage/program-khusus/ict-benefit-2.jpg',
                    'layout' => 'imageRight'
                ],
                [
                    'badge_label' => 'Kompetensi 3',
                    'title' => 'Digital Marketing',
                    'description' => 'Pengenalan digital marketing secara intensif yang mencakup social media marketing, SEO optimization, dan content creation untuk membekali siswa dengan skill marketing digital.',
                    'image' => '/storage/program-khusus/ict-benefit-3.jpg',
                    'layout' => 'imageLeft'
                ]
            ],
            'gallery_title' => 'Galeri Pembelajaran',
            'gallery_subtitle' => 'Suasana pembelajaran yang kondusif dan inspiratif dengan fasilitas modern',
            'gallery_items' => [
                [
                    'src' => '/storage/program-khusus/ict-gallery-1.jpg',
                    'title' => 'Lab Programming',
                    'desc' => 'Laboratorium komputer dengan perangkat modern',
                    'color_gradient' => 'from-blue-500 to-cyan-500'
                ],
                [
                    'src' => '/storage/program-khusus/ict-gallery-2.jpg',
                    'title' => 'Design Studio',
                    'desc' => 'Studio design dengan software terkini',
                    'color_gradient' => 'from-purple-500 to-indigo-500'
                ],
                [
                    'src' => '/storage/program-khusus/ict-gallery-3.jpg',
                    'title' => 'Digital Workshop',
                    'desc' => 'Workshop digital dengan proyek nyata',
                    'color_gradient' => 'from-cyan-500 to-teal-500'
                ]
            ],
            'cta_background' => '/storage/program-khusus/ict-cta-bg.jpg',
            'cta_badge' => 'Bergabung Sekarang',
            'cta_title' => 'Siap Menjadi Bagian dari Generasi Digital?',
            'cta_description' => 'Bergabunglah dengan Program ICT SMP Muhammadiyah Al Kautsar PK Kartasura dan jadilah bagian dari generasi digital yang unggul dalam skill teknologi dan berprestasi akademik. Program ini tidak hanya membentuk developer handal, tetapi juga pribadi yang kreatif dan inovatif.',
            'cta_primary_label' => 'Lihat Program Lainnya',
            'cta_primary_url' => '/program-khusus',
            'cta_secondary_label' => 'Tentang Sekolah',
            'cta_secondary_url' => '/profil',
            'is_active' => true,
        ]);

        // Create ProgramKhususType for Tahfidz
        ProgramKhususType::create([
            'slug' => 'tahfidz',
            'title' => 'Program Tahfidz Al-Quran',
            'subtitle' => 'Program unggulan yang memadukan pendidikan akademik dengan penghafalan Al-Quran',
            'banner_desktop' => '/storage/program-khusus/tahfidz-banner-desktop.jpg',
            'banner_mobile' => '/storage/program-khusus/tahfidz-banner-mobile.jpg',
            'intro_badge' => 'Pendidikan Berkualitas',
            'intro_title' => 'Menggabungkan Akademik & Spiritual',
            'intro_subtitle' => 'Program Tahfidz Al-Quran di SMP Muhammadiyah Al Kautsar PK Kartasura dirancang khusus untuk siswa yang ingin mendalami Al-Quran sambil tetap mengikuti kurikulum akademik nasional dengan metode pembelajaran yang telah terbukti efektif.',
            'featured_image' => '/storage/program-khusus/tahfidz-featured.jpg',
            'featured_overlay_title' => 'Suasana Pembelajaran',
            'featured_overlay_desc' => 'Lingkungan yang kondusif untuk menghafal Al-Quran dengan suasana spiritual yang mendalam',
            'featured_badge' => 'Program Unggulan',
            'key_points' => [
                [
                    'icon' => '📖',
                    'title' => 'Metode Terpadu',
                    'description' => 'Setiap siswa mendapatkan target hafalan yang disesuaikan dengan kemampuan individual, mulai dari Juz 30 (Juz Amma) hingga target yang lebih tinggi dengan bimbingan personal.'
                ],
                [
                    'icon' => '🎯',
                    'title' => 'Evaluasi Berkala',
                    'description' => 'Sistem evaluasi berkala memastikan progress hafalan siswa dan memberikan feedback yang konstruktif untuk perbaikan dan pengembangan yang optimal.'
                ]
            ],
            'features_title' => 'Keunggulan Program Kami',
            'features_subtitle' => 'Metode pembelajaran yang komprehensif dan terintegrasi untuk hasil optimal',
            'features_image' => '/storage/program-khusus/tahfidz-features.jpg',
            'features_items' => [
                [
                    'icon' => '📚',
                    'title' => 'Metode Pembelajaran',
                    'description' => 'Menggunakan metode talaqqi dan muraja\'ah yang terbukti efektif dalam menghafal Al-Quran'
                ],
                [
                    'icon' => '👥',
                    'title' => 'Bimbingan Personal',
                    'description' => 'Setiap siswa dibimbing secara individual oleh ustadz/ustadzah berpengalaman'
                ],
                [
                    'icon' => '🎯',
                    'title' => 'Target Hafalan',
                    'description' => 'Target disesuaikan kemampuan: Juz 30, Juz 1-5, dan juz-juz pilihan lainnya'
                ],
                [
                    'icon' => '🏆',
                    'title' => 'Evaluasi Berkala',
                    'description' => 'Sistem monitoring dan evaluasi terstruktur untuk memastikan progress optimal'
                ]
            ],
            'benefits_badge' => 'Empat Kemampuan Utama',
            'benefits_title' => 'Dampak Positif Program Tahfidz',
            'benefits_subtitle' => 'Program Tahfidz memberikan dampak positif komprehensif melalui empat kemampuan utama',
            'benefits_items' => [
                [
                    'badge_label' => 'Kemampuan 1',
                    'title' => 'Al-Qur\'an Learning',
                    'description' => 'Pembelajaran Al-Qur\'an yang komprehensif meliputi Tahsin (bacaan yang benar), Tahfidz (penghafalan), dan Tafsir (pemahaman makna) untuk membentuk generasi Qurani yang unggul dalam ilmu dan amal.',
                    'image' => '/storage/program-khusus/tahfidz-benefit-1.jpg',
                    'layout' => 'imageLeft'
                ],
                [
                    'badge_label' => 'Kemampuan 2',
                    'title' => 'Courtesy',
                    'description' => 'Kurikulum adab yang terukur dan sistematis untuk membentuk karakter mulia, sopan santun, dan akhlak Qurani dalam kehidupan sehari-hari.',
                    'image' => '/storage/program-khusus/tahfidz-benefit-2.jpg',
                    'layout' => 'imageRight'
                ],
                [
                    'badge_label' => 'Kemampuan 3',
                    'title' => 'Ulama\' Program',
                    'description' => 'Kajian kitab secara intensif yang dikupas oleh para masayikh untuk memperdalam pemahaman agama dan membentuk generasi yang berilmu dan beramal.',
                    'image' => '/storage/program-khusus/tahfidz-benefit-3.jpg',
                    'layout' => 'imageLeft'
                ],
                [
                    'badge_label' => 'Kemampuan 4',
                    'title' => 'Professional Program',
                    'description' => 'Pengenalan berbagai macam profesi secara terjadwal dan terintegrasi dalam kurikulum untuk membekali siswa dengan wawasan karier dan kesiapan menghadapi masa depan.',
                    'image' => '/storage/program-khusus/tahfidz-benefit-4.jpg',
                    'layout' => 'imageRight'
                ]
            ],
            'gallery_title' => 'Galeri Pembelajaran',
            'gallery_subtitle' => 'Suasana pembelajaran yang kondusif dan inspiratif',
            'gallery_items' => [
                [
                    'src' => '/storage/program-khusus/tahfidz-gallery-1.jpg',
                    'title' => 'Ruang Tahfidz',
                    'desc' => 'Lingkungan belajar yang nyaman',
                    'color_gradient' => 'from-emerald-500 to-blue-500'
                ],
                [
                    'src' => '/storage/program-khusus/tahfidz-gallery-2.jpg',
                    'title' => 'Pembelajaran Aktif',
                    'desc' => 'Metode pembelajaran interaktif',
                    'color_gradient' => 'from-purple-500 to-pink-500'
                ],
                [
                    'src' => '/storage/program-khusus/tahfidz-gallery-3.jpg',
                    'title' => 'Bimbingan Personal',
                    'desc' => 'Pendampingan individual',
                    'color_gradient' => 'from-orange-500 to-red-500'
                ]
            ],
            'cta_background' => '/storage/program-khusus/tahfidz-cta-bg.jpg',
            'cta_badge' => 'Bergabung Sekarang',
            'cta_title' => 'Siap Menjadi Bagian dari Generasi Qurani?',
            'cta_description' => 'Bergabunglah dengan Program Tahfidz Al-Quran SMP Muhammadiyah Al Kautsar PK Kartasura dan jadilah bagian dari generasi Qurani yang unggul dalam ilmu dan amal. Program ini tidak hanya membentuk hafidz Al-Quran, tetapi juga pribadi yang berakhlak mulia dan berprestasi akademik.',
            'cta_primary_label' => 'Lihat Program Lainnya',
            'cta_primary_url' => '/program-khusus',
            'cta_secondary_label' => 'Tentang Sekolah',
            'cta_secondary_url' => '/profil',
            'is_active' => true,
        ]);
    }
}
