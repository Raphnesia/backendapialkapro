<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Ensure livewire-tmp directory exists
        $disk = config('livewire.temporary_file_upload.disk', 'local');
        $directory = config('livewire.temporary_file_upload.directory', 'livewire-tmp');
        
        try {
            if (!Storage::disk($disk)->exists($directory)) {
                Storage::disk($disk)->makeDirectory($directory);
            }
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
