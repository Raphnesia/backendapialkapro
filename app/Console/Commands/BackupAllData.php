<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Teacher;
use App\Models\PimpinanSMP;
use App\Models\PimpinanSMPBox;
use App\Models\PimpinanSMPSettings;
use App\Models\User;
use Illuminate\Support\Facades\File;

class BackupAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:backup {action} {--file=all_data_backup.json}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup or restore all important data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        $filename = $this->option('file');

        if ($action === 'backup') {
            return $this->backup($filename);
        } elseif ($action === 'restore') {
            return $this->restore($filename);
        } else {
            $this->error('Action must be either "backup" or "restore"');
            return 1;
        }
    }

    private function backup($filename)
    {
        $data = [
            'teachers' => Teacher::all()->map(function ($teacher) {
                return [
                    'name' => $teacher->name,
                    'subject' => $teacher->subject,
                    'photo' => $teacher->photo,
                    'bio' => $teacher->bio,
                    'position' => $teacher->position,
                    'education' => $teacher->education,
                    'experience' => $teacher->experience,
                    'type' => $teacher->type,
                    'order_index' => $teacher->order_index,
                    'is_active' => $teacher->is_active,
                    'guruData' => $teacher->guruData,
                    'banner_desktop' => $teacher->banner_desktop,
                    'banner_mobile' => $teacher->banner_mobile,
                ];
            })->toArray(),
            
            'pimpinan_smp' => PimpinanSMP::all()->map(function ($pimpinan) {
                return [
                    'name' => $pimpinan->name,
                    'position' => $pimpinan->position,
                    'photo' => $pimpinan->photo,
                    'bio' => $pimpinan->bio,
                    'education' => $pimpinan->education,
                    'experience' => $pimpinan->experience,
                    'type' => $pimpinan->type,
                    'order_index' => $pimpinan->order_index,
                    'is_active' => $pimpinan->is_active,
                    'banner_desktop' => $pimpinan->banner_desktop,
                    'banner_mobile' => $pimpinan->banner_mobile,
                ];
            })->toArray(),
            
            'pimpinan_smp_boxes' => PimpinanSMPBox::all()->map(function ($box) {
                return [
                    'title' => $box->title,
                    'description' => $box->description,
                    'icon' => $box->icon,
                    'image' => $box->image,
                    'order_index' => $box->order_index,
                    'is_active' => $box->is_active,
                    'background_color' => $box->background_color,
                ];
            })->toArray(),
            
            'pimpinan_smp_settings' => PimpinanSMPSettings::all()->map(function ($setting) {
                return [
                    'title' => $setting->title,
                    'subtitle' => $setting->subtitle,
                    'banner_desktop' => $setting->banner_desktop,
                    'banner_mobile' => $setting->banner_mobile,
                    'keunggulan_title' => $setting->keunggulan_title,
                    'keunggulan_subtitle' => $setting->keunggulan_subtitle,
                    'is_active' => $setting->is_active,
                ];
            })->toArray(),
            
            'users' => User::all()->map(function ($user) {
                return [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => $user->password, // Note: This is hashed
                ];
            })->toArray(),
        ];

        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        File::put(storage_path($filename), $jsonData);

        $this->info("All data backed up successfully to {$filename}");
        $this->info("Teachers: " . count($data['teachers']));
        $this->info("Pimpinan SMP: " . count($data['pimpinan_smp']));
        $this->info("Pimpinan SMP Boxes: " . count($data['pimpinan_smp_boxes']));
        $this->info("Pimpinan SMP Settings: " . count($data['pimpinan_smp_settings']));
        $this->info("Users: " . count($data['users']));

        return 0;
    }

    private function restore($filename)
    {
        if (!File::exists(storage_path($filename))) {
            $this->error("Backup file {$filename} not found!");
            return 1;
        }

        $jsonData = File::get(storage_path($filename));
        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON data in backup file');
            return 1;
        }

        $count = 0;

        // Restore Teachers
        if (isset($data['teachers'])) {
            foreach ($data['teachers'] as $teacherData) {
                Teacher::create($teacherData);
                $count++;
            }
            $this->info("Restored " . count($data['teachers']) . " teachers");
        }

        // Restore Pimpinan SMP
        if (isset($data['pimpinan_smp'])) {
            foreach ($data['pimpinan_smp'] as $pimpinanData) {
                PimpinanSMP::create($pimpinanData);
                $count++;
            }
            $this->info("Restored " . count($data['pimpinan_smp']) . " pimpinan SMP");
        }

        // Restore Pimpinan SMP Boxes
        if (isset($data['pimpinan_smp_boxes'])) {
            foreach ($data['pimpinan_smp_boxes'] as $boxData) {
                PimpinanSMPBox::create($boxData);
                $count++;
            }
            $this->info("Restored " . count($data['pimpinan_smp_boxes']) . " pimpinan SMP boxes");
        }

        // Restore Pimpinan SMP Settings
        if (isset($data['pimpinan_smp_settings'])) {
            foreach ($data['pimpinan_smp_settings'] as $settingData) {
                PimpinanSMPSettings::create($settingData);
                $count++;
            }
            $this->info("Restored " . count($data['pimpinan_smp_settings']) . " pimpinan SMP settings");
        }

        // Restore Users (optional, usually we don't restore users)
        if (isset($data['users']) && $this->confirm('Do you want to restore users? (This might overwrite existing users)')) {
            foreach ($data['users'] as $userData) {
                User::create($userData);
                $count++;
            }
            $this->info("Restored " . count($data['users']) . " users");
        }

        $this->info("All data restored successfully from {$filename}");
        $this->info("Total records restored: {$count}");

        return 0;
    }
}
