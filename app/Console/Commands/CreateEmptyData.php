<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Teacher;
use App\Models\PimpinanSMP;
use App\Models\PimpinanSMPBox;
use App\Models\PimpinanSMPSettings;

class CreateEmptyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:create-empty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create empty data structure for teachers, pimpinan SMP, and settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating empty data structure...');

        // Create empty teacher with guruData structure
        $teacher = Teacher::create([
            'name' => '',
            'subject' => '',
            'photo' => null,
            'bio' => '',
            'position' => '',
            'education' => '',
            'experience' => '',
            'type' => 'teacher',
            'order_index' => 1,
            'is_active' => true,
            'guruData' => [
                'title' => 'Guru & Staff',
                'subtitle' => 'Mengenal lebih dekat dengan para pengajar dan staf kami',
                'date' => 'Terbaru',
                'read_time' => '3 min',
                'author' => 'Admin',
                'active' => true,
            ],
            'banner_desktop' => null,
            'banner_mobile' => null,
        ]);

        $this->info('✅ Created empty teacher with guruData structure');

        // Create empty Pimpinan SMP Settings
        $settings = PimpinanSMPSettings::create([
            'title' => 'Pimpinan SMP',
            'subtitle' => 'Mengenal para pimpinan SMP Muhammadiyah Al Kautsar PK Kartasura',
            'banner_desktop' => null,
            'banner_mobile' => null,
            'keunggulan_title' => 'Keunggulan Kepemimpinan',
            'keunggulan_subtitle' => 'Keunggulan kepemimpinan yang membedakan kami',
            'is_active' => true,
        ]);

        $this->info('✅ Created empty Pimpinan SMP Settings');

        // Create empty Pimpinan SMP Boxes (6 boxes)
        for ($i = 1; $i <= 6; $i++) {
            PimpinanSMPBox::create([
                'title' => "Keunggulan {$i}",
                'description' => "Deskripsi keunggulan kepemimpinan {$i}",
                'icon' => '⭐',
                'image' => null,
                'order_index' => $i,
                'is_active' => true,
                'background_color' => 'green-600',
            ]);
        }

        $this->info('✅ Created 6 empty Pimpinan SMP Boxes');

        $this->info('');
        $this->info('🎉 Empty data structure created successfully!');
        $this->info('');
        $this->info('📋 What you can do now:');
        $this->info('1. Login to admin panel: http://localhost:8000/admin');
        $this->info('2. Add your real teacher & staff data');
        $this->info('3. Add your real pimpinan SMP data');
        $this->info('4. Customize the settings and boxes');
        $this->info('');
        $this->info('🔐 Admin credentials:');
        $this->info('Email: admin@admin.com');
        $this->info('Password: admin123');

        return 0;
    }
}
