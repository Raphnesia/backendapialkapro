<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfilSettings;

class ProfilSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilSettings::create([
            'title' => 'Profil SMP Muhammadiyah Al Kautsar PK Kartasura',
            'subtitle' => 'Informasi lengkap tentang sekolah kami',
            'banner_desktop' => null,
            'banner_mobile' => null,
            'description' => 'SMP Muhammadiyah Al Kautsar PK Kartasura merupakan lembaga pendidikan yang berkomitmen untuk mengembangkan potensi peserta didik secara holistik, menggabungkan keunggulan akademik dengan nilai-nilai keislaman dan karakter yang kuat.',
            'meta_description' => 'Profil lengkap SMP Muhammadiyah Al Kautsar PK Kartasura - sekolah unggulan yang menggabungkan akademik dengan nilai keislaman dan karakter kuat.',
            'meta_keywords' => 'profil, smp, muhammadiyah, al kautsar, kartasura, sekolah, pendidikan, islam',
            'is_active' => true,
        ]);
    }
}
