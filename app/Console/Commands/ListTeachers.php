<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Teacher;

class ListTeachers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teachers:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all teachers and staff';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $teachers = Teacher::all();

        if ($teachers->isEmpty()) {
            $this->info("No teachers/staff found in the system.");
            return 0;
        }

        $this->info("Teachers and Staff in the system:");
        $this->info("=================================");

        foreach ($teachers as $teacher) {
            $this->info("ID: {$teacher->id}");
            $this->info("Name: {$teacher->name}");
            $this->info("Position: {$teacher->position}");
            $this->info("Subject: {$teacher->subject}");
            $this->info("Type: {$teacher->type}");
            $this->info("Status: " . ($teacher->is_active ? 'Active' : 'Inactive'));
            $this->info("Order: {$teacher->order_index}");
            $this->info("---");
        }

        $this->info("Total teachers/staff: " . $teachers->count());

        return 0;
    }
}
