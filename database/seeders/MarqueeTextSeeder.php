<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MarqueeText;

class MarqueeTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marqueeTexts = [
            [
                'text' => 'Mendidik dengan Hati, Membentuk Karakter Islami',
                'order_index' => 0,
                'is_active' => true,
                'color' => '#ffffff',
                'speed' => 'normal',
            ],
            [
                'text' => 'Portal Informasi Terdepan untuk Masa Depan Cemerlang',
                'order_index' => 1,
                'is_active' => true,
                'color' => '#ffffff',
                'speed' => 'normal',
            ],
            [
                'text' => 'Selamat datang di SMP Al-Kautsar',
                'order_index' => 2,
                'is_active' => true,
                'color' => '#ffffff',
                'speed' => 'normal',
            ],
        ];

        foreach ($marqueeTexts as $marquee) {
            MarqueeText::create($marquee);
        }
    }
} 