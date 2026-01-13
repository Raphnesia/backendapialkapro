<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user for Filament';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Check if user already exists
        $existingUser = User::where('email', $email)->first();
        
        if ($existingUser) {
            $this->error("User with email {$email} already exists!");
            return 1;
        }

        // Create new user
        $user = User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Admin user created successfully!");
        $this->info("Email: {$email}");
        $this->info("Password: {$password}");
        $this->info("You can now login to Filament admin panel at: http://localhost:8000/admin");

        return 0;
    }
}
