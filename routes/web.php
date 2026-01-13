<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\CustomImageUploadController; // REMOVED

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Custom Image Upload Routes (Bypass Filament) - REMOVED
// Route::prefix('admin/upload')->group(function () {
//     Route::post('/image', [CustomImageUploadController::class, 'upload'])->name('admin.upload.image');
//     Route::delete('/image', [CustomImageUploadController::class, 'delete'])->name('admin.upload.delete');
// });

// Debug route untuk cek direktori livewire-tmp
Route::get('/debug/livewire-tmp', function () {
    $disk = config('livewire.temporary_file_upload.disk', 'public');
    $dir = config('livewire.temporary_file_upload.directory', 'livewire-tmp');
    
    try {
        $exists = \Illuminate\Support\Facades\Storage::disk($disk)->exists($dir);
        $files = $exists ? \Illuminate\Support\Facades\Storage::disk($disk)->files($dir) : [];
        
        return response()->json([
            'disk' => $disk,
            'directory' => $dir,
            'exists' => $exists,
            'count' => count($files),
            'sample' => array_slice($files, 0, 5),
            'public_url' => config('filesystems.disks.public.url') ?? null,
        ]);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
      Route::get('/storage/{path}', function (string $path) {
          abort_unless(Storage::disk('public')->exists($path), 404);
          return response(Storage::disk('public')->get($path), 200)
              ->header('Content-Type', Storage::disk('public')->mimeType($path));
      })->where('path', '.*');
