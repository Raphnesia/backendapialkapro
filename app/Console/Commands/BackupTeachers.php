<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Teacher;
use Illuminate\Support\Facades\File;

class BackupTeachers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teachers:backup {action} {--file=teachers_backup.json}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup or restore teachers data';

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
        $teachers = Teacher::all();
        
        if ($teachers->isEmpty()) {
            $this->warn('No teachers data to backup');
            return 0;
        }

        $data = $teachers->map(function ($teacher) {
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
        })->toArray();

        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        File::put(storage_path($filename), $jsonData);

        $this->info("Teachers data backed up successfully to {$filename}");
        $this->info("Total teachers backed up: " . count($data));

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
        foreach ($data as $teacherData) {
            Teacher::create($teacherData);
            $count++;
        }

        $this->info("Teachers data restored successfully from {$filename}");
        $this->info("Total teachers restored: {$count}");

        return 0;
    }
}
