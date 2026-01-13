<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all users in the system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->info("No users found in the system.");
            return 0;
        }

        $this->info("Users in the system:");
        $this->info("=====================");

        foreach ($users as $user) {
            $this->info("ID: {$user->id}");
            $this->info("Name: {$user->name}");
            $this->info("Email: {$user->email}");
            $this->info("Created: {$user->created_at}");
            $this->info("Updated: {$user->updated_at}");
            $this->info("---");
        }

        return 0;
    }
}
