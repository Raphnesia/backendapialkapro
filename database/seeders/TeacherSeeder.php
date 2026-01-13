<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Adam Muttaqien, M.Si',
                'position' => 'Guru Matematika',
                'subject' => 'Matematika',
                'type' => 'teacher',
                'photo' => null,
                'bio' => 'Guru matematika dengan pengalaman 10 tahun mengajar di berbagai sekolah menengah.',
                'education' => 'S2 Matematika',
                'experience' => '10 tahun mengajar matematika',
                'is_active' => true,
                'order_index' => 1,
                'guruData' => [
                    'title' => 'Tim Guru Profesional SMP Muhammadiyah Al Kautsar PK Kartasura',
                    'subtitle' => 'Tenaga pengajar berkualitas dengan dedikasi tinggi untuk pendidikan terbaik dan pembentukan karakter Islami.',
                    'banner_desktop' => null,
                    'banner_mobile' => null,
                    'date' => '17 Juli 2025',
                    'read_time' => '5 Menit untuk membaca',
                    'author' => 'Tim Humas SMP',
                    'active' => true
                ]
            ],
            [
                'name' => 'Cindy Trisnawati, S.Pd, M.Pd',
                'position' => 'Guru Bahasa Indonesia',
                'subject' => 'Bahasa Indonesia',
                'type' => 'teacher',
                'photo' => null,
                'bio' => 'Guru bahasa Indonesia yang berdedikasi untuk meningkatkan kemampuan literasi siswa.',
                'education' => 'S2 Pendidikan Bahasa Indonesia',
                'experience' => '8 tahun mengajar bahasa Indonesia',
                'is_active' => true,
                'order_index' => 2,
                'guruData' => null
            ],
            [
                'name' => 'Dr. Ahmad Hidayat, S.Pd, M.Pd',
                'position' => 'Kepala Sekolah',
                'subject' => 'Manajemen Pendidikan',
                'type' => 'principal',
                'photo' => null,
                'bio' => 'Kepala sekolah yang visioner dengan pengalaman 15 tahun dalam manajemen pendidikan.',
                'education' => 'S3 Manajemen Pendidikan',
                'experience' => '15 tahun dalam manajemen pendidikan',
                'is_active' => true,
                'order_index' => 3,
                'guruData' => null
            ],
            [
                'name' => 'Siti Nurhaliza, S.Pd',
                'position' => 'Wakil Kepala Sekolah',
                'subject' => 'Administrasi Sekolah',
                'type' => 'vice_principal',
                'photo' => null,
                'bio' => 'Wakil kepala sekolah yang handal dalam administrasi dan pengembangan kurikulum.',
                'education' => 'S1 Pendidikan Administrasi',
                'experience' => '12 tahun dalam administrasi sekolah',
                'is_active' => true,
                'order_index' => 4,
                'guruData' => null
            ],
            [
                'name' => 'Budi Santoso, S.Pd',
                'position' => 'Guru IPA',
                'subject' => 'IPA',
                'type' => 'teacher',
                'photo' => null,
                'bio' => 'Guru IPA yang kreatif dalam mengembangkan metode pembelajaran yang menarik.',
                'education' => 'S1 Pendidikan IPA',
                'experience' => '7 tahun mengajar IPA',
                'is_active' => true,
                'order_index' => 5,
                'guruData' => null
            ],
            [
                'name' => 'Dewi Sartika, S.Pd',
                'position' => 'Guru Bahasa Inggris',
                'subject' => 'Bahasa Inggris',
                'type' => 'teacher',
                'photo' => null,
                'bio' => 'Guru bahasa Inggris yang berkomitmen untuk meningkatkan kemampuan komunikasi siswa.',
                'education' => 'S1 Pendidikan Bahasa Inggris',
                'experience' => '6 tahun mengajar bahasa Inggris',
                'is_active' => true,
                'order_index' => 6,
                'guruData' => null
            ],
            [
                'name' => 'Rudi Hartono, S.Pd',
                'position' => 'Staff TU',
                'subject' => 'Administrasi',
                'type' => 'staff',
                'photo' => null,
                'bio' => 'Staff tata usaha yang handal dalam administrasi sekolah.',
                'education' => 'S1 Administrasi Negara',
                'experience' => '10 tahun dalam administrasi',
                'is_active' => true,
                'order_index' => 7,
                'guruData' => null
            ],
            [
                'name' => 'Maya Indah, S.Pd',
                'position' => 'Guru Seni Budaya',
                'subject' => 'Seni Budaya',
                'type' => 'teacher',
                'photo' => null,
                'bio' => 'Guru seni budaya yang mengembangkan kreativitas dan apresiasi seni siswa.',
                'education' => 'S1 Pendidikan Seni',
                'experience' => '5 tahun mengajar seni budaya',
                'is_active' => true,
                'order_index' => 8,
                'guruData' => null
            ]
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
