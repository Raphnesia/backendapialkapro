<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetUserPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset-password {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset password for existing user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Find user
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }

        // Update password
        $user->update([
            'password' => Hash::make($password),
        ]);

        $this->info("Password reset successfully!");
        $this->info("Email: {$email}");
        $this->info("New Password: {$password}");
        $this->info("You can now login to Filament admin panel at: http://localhost:8000/admin");

        return 0;
    }
}
