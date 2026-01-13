<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SejarahSingkat;
use App\Models\SejarahSingkatSettings;

class SejarahSingkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Sejarah Singkat Settings
        SejarahSingkatSettings::create([
            'title' => 'Sejarah SMP Muhammadiyah Al Kautsar PK Kartasura',
            'subtitle' => 'Perjalanan panjang sekolah dalam membentuk generasi Islam berkualitas',
            'banner_desktop' => null,
            'banner_mobile' => null,
            'title_panel_bg_color' => 'bg-green-500',
            'subtitle_panel_bg_color' => 'bg-green-700',
            'mobile_panel_bg_color' => 'bg-green-600',
            'is_active' => true,
        ]);

        // Create Sejarah Singkat Content - Section 1
        SejarahSingkat::create([
            'title' => 'Sejarah Pendirian SMP Muhammadiyah Al Kautsar PK Kartasura',
            'content' => '<p>SMP Muhammadiyah Al Kautsar Kartasura didirikan pada tahun 2008 sebagai wujud kepedulian Muhammadiyah terhadap pendidikan Islam berkualitas di wilayah Kartasura dan sekitarnya. Sekolah ini merupakan pengembangan dari visi Muhammadiyah untuk menciptakan generasi Islam yang unggul dalam ilmu pengetahuan dan akhlak mulia.</p><p>Pada awal berdirinya, SMP Muhammadiyah Al Kautsar Kartasura hanya memiliki beberapa ruang kelas dengan jumlah siswa yang terbatas. Namun, berkat dedikasi para pendiri dan dukungan dari masyarakat, sekolah ini terus berkembang hingga menjadi salah satu lembaga pendidikan Islam terkemuka di Kabupaten Sukoharjo.</p><p>Nama "Al Kautsar" diambil dari salah satu surat dalam Al-Qur\'an yang bermakna "nikmat yang berlimpah". Hal ini mencerminkan harapan bahwa sekolah ini akan menjadi sumber keberkahan ilmu dan memberikan manfaat yang berlimpah bagi masyarakat.</p>',
            'grid_type' => 'grid-cols-1',
            'use_list_disc' => false,
            'list_items' => null,
            'background_color' => 'bg-white',
            'border_color' => 'border-gray-100',
            'order_index' => 1,
            'is_active' => true,
        ]);

        // Create Sejarah Singkat Content - Section 2 (with list)
        SejarahSingkat::create([
            'title' => 'Tonggak Sejarah',
            'content' => '<p>Berikut adalah tonggak-tonggak penting dalam perjalanan SMP Muhammadiyah Al Kautsar PK Kartasura:</p>',
            'grid_type' => 'grid-cols-1',
            'use_list_disc' => true,
            'list_items' => [
                ['item' => '2008 - Pendirian SMP Muhammadiyah Al Kautsar Kartasura'],
                ['item' => '2010 - Kelulusan angkatan pertama dengan prestasi gemilang'],
                ['item' => '2012 - Perluasan gedung dan fasilitas sekolah'],
                ['item' => '2015 - Pengembangan program unggulan'],
                ['item' => '2018 - Perayaan 10 tahun dengan berbagai pencapaian'],
                ['item' => '2020 - Adaptasi pembelajaran di era pandemi'],
                ['item' => '2023 - Pengembangan kurikulum terintegrasi'],
            ],
            'background_color' => 'bg-gray-50',
            'border_color' => 'border-gray-200',
            'order_index' => 2,
            'is_active' => true,
        ]);

        // Create Sejarah Singkat Content - Section 3
        SejarahSingkat::create([
            'title' => 'Perkembangan dan Pencapaian',
            'content' => '<p>Sejak didirikan, SMP Muhammadiyah Al Kautsar PK Kartasura telah mengalami berbagai perkembangan signifikan, baik dari segi infrastruktur, kualitas pendidikan, maupun prestasi yang diraih. Beberapa pencapaian penting dalam perjalanan sekolah kami antara lain:</p>',
            'grid_type' => 'grid-cols-1',
            'use_list_disc' => false,
            'list_items' => null,
            'background_color' => 'bg-white',
            'border_color' => 'border-gray-100',
            'order_index' => 3,
            'is_active' => true,
        ]);

        // Create Sejarah Singkat Content - Section 4 (2 columns)
        SejarahSingkat::create([
            'title' => 'Bidang Akademik',
            'content' => '<p>Pencapaian dalam bidang akademik yang telah diraih sekolah:</p>',
            'grid_type' => 'grid-cols-2',
            'use_list_disc' => true,
            'list_items' => [
                ['item' => 'Peningkatan nilai rata-rata ujian nasional setiap tahun'],
                ['item' => 'Berbagai prestasi dalam olimpiade sains tingkat kabupaten, provinsi, dan nasional'],
                ['item' => 'Pengembangan program literasi dan penelitian siswa'],
                ['item' => 'Kerjasama dengan berbagai institusi pendidikan tinggi'],
            ],
            'background_color' => 'bg-blue-50',
            'border_color' => 'border-blue-200',
            'order_index' => 4,
            'is_active' => true,
        ]);

        // Create Sejarah Singkat Content - Section 5 (2 columns)
        SejarahSingkat::create([
            'title' => 'Bidang Keislaman',
            'content' => '<p>Pencapaian dalam bidang keislaman yang telah diraih sekolah:</p>',
            'grid_type' => 'grid-cols-2',
            'use_list_disc' => true,
            'list_items' => [
                ['item' => 'Pengembangan program tahfidz Al-Qur\'an'],
                ['item' => 'Pembinaan karakter Islami melalui berbagai kegiatan'],
                ['item' => 'Prestasi dalam MTQ dan kompetisi keislaman lainnya'],
                ['item' => 'Pengembangan kurikulum terintegrasi nilai-nilai Islam'],
            ],
            'background_color' => 'bg-green-50',
            'border_color' => 'border-green-200',
            'order_index' => 5,
            'is_active' => true,
        ]);

        // Create Sejarah Singkat Content - Section 6
        SejarahSingkat::create([
            'title' => 'Komitmen Masa Depan',
            'content' => '<p>Dalam perjalanannya, SMP Muhammadiyah Al Kautsar PK Kartasura terus berkomitmen untuk mengembangkan pendidikan berkualitas yang mengintegrasikan keunggulan akademik dengan nilai-nilai keislaman, sehingga dapat melahirkan generasi yang tidak hanya cerdas secara intelektual, tetapi juga memiliki akhlak mulia dan kepedulian sosial yang tinggi.</p>',
            'grid_type' => 'grid-cols-1',
            'use_list_disc' => false,
            'list_items' => null,
            'background_color' => 'bg-white',
            'border_color' => 'border-gray-100',
            'order_index' => 6,
            'is_active' => true,
        ]);
    }
}
