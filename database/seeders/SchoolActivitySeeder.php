<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolActivity;
use Illuminate\Support\Str;

class SchoolActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'title' => 'Prestasi Gemilang Siswa dalam Olimpiade Matematika Nasional',
                'excerpt' => 'Siswa SMP Muhammadiyah Al Kautsar PK Kartasura meraih juara 2 dalam Olimpiade Matematika tingkat nasional, membanggakan sekolah dan orang tua.',
                'description' => 'Prestasi membanggakan kembali diraih oleh siswa SMP Muhammadiyah Al Kautsar PK Kartasura. Dalam ajang Olimpiade Matematika Nasional yang diselenggarakan di Jakarta, siswa kami berhasil meraih juara 2. Pencapaian ini merupakan hasil dari kerja keras, dedikasi, dan bimbingan intensif dari para guru.',
                'image' => 'activities/prestasi-matematika.jpg',
                'category' => 'Prestasi Akademik',
                'type' => 'prestasi',
                'author' => 'Tim Redaksi',
                'date' => '2024-01-15',
                'activity_date' => '2024-01-10',
                'activity_time' => '09:00:00',
                'location' => 'Jakarta Convention Center',
                'participants' => ['Ahmad Rizki', 'Siti Nurhaliza'],
                'is_active' => true,
                'order_index' => 1,
            ],
            [
                'title' => 'Juara 2 Kejuaraan Karate Pelajar Tingkat Provinsi',
                'excerpt' => 'Ananda Amir Zaki El S. berhasil meraih juara 2 dalam Kejuaraan Karate Pelajar, menunjukkan dedikasi dan latihan yang konsisten.',
                'description' => 'Selamat kepada Ananda Amir Zaki El S. yang telah mendapat JUARA 2 dalam Kejuaraan Karate Pelajar tingkat provinsi. Prestasi ini merupakan buah dari latihan rutin dan disiplin yang tinggi dalam mengikuti ekstrakurikuler karate di sekolah.',
                'image' => 'activities/karate-juara.jpg',
                'category' => 'Prestasi Akademik',
                'type' => 'prestasi',
                'author' => 'Guru Olahraga',
                'date' => '2024-01-10',
                'activity_date' => '2024-01-08',
                'activity_time' => '14:00:00',
                'location' => 'GOR Manahan Solo',
                'participants' => ['Amir Zaki El S.'],
                'is_active' => true,
                'order_index' => 2,
            ],
            [
                'title' => 'Kegiatan Ekstrakurikuler Robotika dan Programming',
                'excerpt' => 'Siswa mengembangkan kemampuan teknologi melalui kegiatan ekstrakurikuler robotika dan programming yang menarik dan edukatif.',
                'description' => 'Ekstrakurikuler robotika dan programming menjadi salah satu kegiatan favorit siswa. Dalam kegiatan ini, siswa belajar merancang, membangun, dan memprogram robot sederhana. Kegiatan ini bertujuan untuk mengembangkan kemampuan berpikir logis dan kreativitas siswa.',
                'image' => 'activities/robotika.jpg',
                'category' => 'Ekstrakurikuler',
                'type' => 'ekstrakurikuler',
                'author' => 'Pembina Ekskul',
                'date' => '2024-01-08',
                'activity_date' => '2024-01-05',
                'activity_time' => '15:30:00',
                'location' => 'Lab Komputer',
                'participants' => ['Kelas 7A', 'Kelas 7B', 'Kelas 8A'],
                'is_active' => true,
                'order_index' => 3,
            ],
            [
                'title' => 'Workshop Seni dan Kreativitas Siswa',
                'excerpt' => 'Kegiatan workshop seni yang mengembangkan kreativitas dan bakat seni siswa dalam berbagai bidang seperti lukis, musik, dan tari.',
                'description' => 'Workshop seni dan kreativitas diselenggarakan untuk mengembangkan bakat dan minat siswa di bidang seni. Kegiatan ini meliputi workshop melukis, musik, tari, dan kerajinan tangan. Siswa dapat mengekspresikan kreativitas mereka dengan bimbingan guru seni yang berpengalaman.',
                'image' => 'activities/workshop-seni.jpg',
                'category' => 'Ekstrakurikuler',
                'type' => 'ekstrakurikuler',
                'author' => 'Guru Seni',
                'date' => '2024-01-05',
                'activity_date' => '2024-01-03',
                'activity_time' => '13:00:00',
                'location' => 'Ruang Seni',
                'participants' => ['Semua Siswa'],
                'is_active' => true,
                'order_index' => 4,
            ],
            [
                'title' => 'Kegiatan Bakti Sosial dan Peduli Lingkungan',
                'excerpt' => 'Siswa berpartisipasi dalam kegiatan bakti sosial membersihkan lingkungan sekitar sekolah dan membantu masyarakat.',
                'description' => 'Kegiatan bakti sosial dan peduli lingkungan merupakan wujud kepedulian siswa terhadap lingkungan sekitar. Siswa bergotong royong membersihkan area sekolah, menanam pohon, dan membantu masyarakat sekitar. Kegiatan ini bertujuan untuk menumbuhkan rasa tanggung jawab sosial.',
                'image' => 'activities/bakti-sosial.jpg',
                'category' => 'Kegiatan Sosial',
                'type' => 'sosial',
                'author' => 'OSIS',
                'date' => '2024-01-03',
                'activity_date' => '2024-01-01',
                'activity_time' => '08:00:00',
                'location' => 'Lingkungan Sekolah',
                'participants' => ['OSIS', 'Pramuka', 'Semua Siswa'],
                'is_active' => true,
                'order_index' => 5,
            ],
            [
                'title' => 'Kompetisi Debat Bahasa Inggris Antar Sekolah',
                'excerpt' => 'Tim debat sekolah berhasil mencapai semifinal dalam kompetisi debat bahasa Inggris tingkat kabupaten.',
                'description' => 'Tim debat bahasa Inggris SMP Muhammadiyah Al Kautsar PK Kartasura berhasil mencapai semifinal dalam kompetisi debat tingkat kabupaten. Prestasi ini menunjukkan kemampuan berbahasa Inggris dan kemampuan berargumentasi siswa yang semakin baik.',
                'image' => 'activities/debat-english.jpg',
                'category' => 'Kompetisi',
                'type' => 'akademik',
                'author' => 'Guru Bahasa Inggris',
                'date' => '2023-12-28',
                'activity_date' => '2023-12-25',
                'activity_time' => '09:00:00',
                'location' => 'Aula Kabupaten',
                'participants' => ['Tim Debat Sekolah'],
                'is_active' => true,
                'order_index' => 6,
            ],
        ];

        foreach ($activities as $activity) {
            $activity['slug'] = Str::slug($activity['title']);
            SchoolActivity::create($activity);
        }
    }
}
