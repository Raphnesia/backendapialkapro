<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrestasiSettings;

class PrestasiSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ada
        PrestasiSettings::truncate();
        
        // Buat data baru
        PrestasiSettings::create([
            'main_heading' => 'Prestasi membanggakan dari Siswa Siswi SMP Muhammadiyah Al-Kautsar PK Kartasura',
            'hero_subtitle' => 'Siswa berprestasi dengan pencapaian luar biasa dan aktivasi instan bikin prestasi akademik dan non-akademik siap jalan bebas hambatan',
            'badge_text' => 'SMP Muhammadiyah Al Kautsar',
            'hero_background_color' => '#1e40af',
            'hero_text_color' => '#ffffff',
            'floating_elements_bg_color' => '#fbbf24',
            'floating_elements_text_color' => '#ffffff',
            'feature_lists' => [
                'Prestasi Akademik Tinggi',
                'Juara Olimpiade Nasional', 
                'Prestasi up to 150+ Penghargaan',
                'Pengembangan Bakat Terpadu'
            ]
        ]);
    }
}
