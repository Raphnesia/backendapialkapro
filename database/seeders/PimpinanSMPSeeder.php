<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PimpinanSMP;
use App\Models\PimpinanSMPBox;
use App\Models\PimpinanSMPSettings;

class PimpinanSMPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Pimpinan SMP Settings
        PimpinanSMPSettings::create([
            'title' => 'Pimpinan SMP Muhammadiyah Al Kautsar PK Kartasura',
            'subtitle' => 'Kepemimpinan yang visioner dan berpengalaman dalam mengembangkan pendidikan berkualitas dengan nilai-nilai Islami.',
            'keunggulan_title' => 'Keunggulan Kepemimpinan SMP Muhammadiyah Al Kautsar PK Kartasura',
            'keunggulan_subtitle' => 'Tim pimpinan yang handal dan berpengalaman dalam mengelola sekolah',
            'is_active' => true,
        ]);

        // Create Pimpinan SMP Data
        $pimpinanData = [
            [
                'name' => 'Muhammad Rifqi Nugroho, M.Pd.',
                'position' => 'Kepala Sekolah SMP Muhammadiyah Al Kautsar PK Kartasura',
                'type' => 'Kepala Sekolah',
                'bio' => 'Kepala Sekolah yang visioner dan berpengalaman dalam mengembangkan pendidikan berkualitas.',
                'education' => 'S2 Pendidikan',
                'experience' => 'Lebih dari 10 tahun pengalaman di bidang pendidikan dan manajemen sekolah.',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Irma Rachmawati, S.Pd.',
                'position' => 'Wakil Kepala Sekolah Bidang Kurikulum SMP Muhammadiyah Al Kautsar PK Kartasura',
                'type' => 'Wakil Kepala Sekolah Kurikulum',
                'bio' => 'Wakil Kepala Sekolah yang fokus pada pengembangan kurikulum dan pembelajaran.',
                'education' => 'S1 Pendidikan',
                'experience' => 'Pengalaman dalam pengembangan kurikulum dan evaluasi pembelajaran.',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Rochmad Wahyu Saputro, S.Sos.',
                'position' => 'Wakil Kepala Sekolah Bidang SDM dan Humas SMP Muhammadiyah Al Kautsar PK Kartasura',
                'type' => 'Wakil Kepala Sekolah SDM & Humas',
                'bio' => 'Wakil Kepala Sekolah yang mengelola sumber daya manusia dan hubungan masyarakat.',
                'education' => 'S1 Ilmu Sosial',
                'experience' => 'Pengalaman dalam pengelolaan SDM dan hubungan masyarakat.',
                'order_index' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Wahyu Purnama Putra, S.Pd.',
                'position' => 'Wakil Kepala Sekolah Bidang Kesiswaan SMP Muhammadiyah Al Kautsar PK Kartasura',
                'type' => 'Wakil Kepala Sekolah Kesiswaan',
                'bio' => 'Wakil Kepala Sekolah yang mengelola kegiatan kesiswaan dan pengembangan karakter.',
                'education' => 'S1 Pendidikan',
                'experience' => 'Pengalaman dalam pengelolaan kesiswaan dan pengembangan karakter siswa.',
                'order_index' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Nur Afif Lutifiati, S.Ak.',
                'position' => 'Wakil Kepala Sekolah Bidang AIK SMP Muhammadiyah Al Kautsar PK Kartasura',
                'type' => 'Wakil Kepala Sekolah AIK',
                'bio' => 'Wakil Kepala Sekolah yang mengelola aset, investasi, dan keuangan sekolah.',
                'education' => 'S1 Akuntansi',
                'experience' => 'Pengalaman dalam pengelolaan keuangan dan aset sekolah.',
                'order_index' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Wiyono, S.E.',
                'position' => 'Wakil Kepala Sekolah Bidang Sarana dan Prasarana SMP Muhammadiyah Al Kautsar PK Kartasura',
                'type' => 'Wakil Kepala Sekolah Sarana Prasarana',
                'bio' => 'Wakil Kepala Sekolah yang mengelola sarana dan prasarana sekolah.',
                'education' => 'S1 Ekonomi',
                'experience' => 'Pengalaman dalam pengelolaan sarana dan prasarana pendidikan.',
                'order_index' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($pimpinanData as $data) {
            PimpinanSMP::create($data);
        }

        // Create Box Keunggulan Data
        $boxData = [
            [
                'title' => 'Kepemimpinan Visioner',
                'description' => 'Memiliki visi jangka panjang untuk mengembangkan sekolah menjadi institusi pendidikan terdepan.',
                'icon' => '👨‍💼',
                'background_color' => 'green-600',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Berpengalaman',
                'description' => 'Tim pimpinan dengan pengalaman puluhan tahun di bidang pendidikan dan manajemen sekolah.',
                'icon' => '🎓',
                'background_color' => 'green-600',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Kolaboratif',
                'description' => 'Menerapkan gaya kepemimpinan kolaboratif yang melibatkan seluruh stakeholder sekolah.',
                'icon' => '🤝',
                'background_color' => 'green-700',
                'order_index' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Inovatif',
                'description' => 'Selalu mencari cara baru untuk meningkatkan kualitas pendidikan dan layanan sekolah.',
                'icon' => '💡',
                'background_color' => 'green-600',
                'order_index' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Transparan',
                'description' => 'Menerapkan prinsip transparansi dalam pengelolaan sekolah dan pengambilan keputusan.',
                'icon' => '🔍',
                'background_color' => 'green-700',
                'order_index' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Berorientasi Mutu',
                'description' => 'Fokus pada peningkatan mutu pendidikan dan layanan kepada siswa dan orang tua.',
                'icon' => '⭐',
                'background_color' => 'green-600',
                'order_index' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($boxData as $data) {
            PimpinanSMPBox::create($data);
        }
    }
}
