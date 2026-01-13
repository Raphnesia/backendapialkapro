<?php
require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== FIXING TEACHER STATUS ===\n";

// Update first teacher to have active=true in guruData
$teacher = \App\Models\Teacher::first();
if ($teacher) {
    echo "Setting teacher ID {$teacher->id} to active\n";
    
    // Set guruData with active status
    $guruData = $teacher->guruData ?? [
        'title' => 'Guru & Staff',
        'subtitle' => 'Mengenal lebih dekat dengan para pengajar dan staf kami',
        'date' => 'Terbaru',
        'read_time' => '3 min',
        'author' => 'Admin',
    ];
    
    $guruData['active'] = true;
    $teacher->guruData = $guruData;
    $teacher->save();
    
    echo "Teacher updated successfully\n";
    echo "guruData: " . json_encode($teacher->guruData) . "\n";
    echo "banner_desktop: " . ($teacher->banner_desktop ?? 'NULL') . "\n";
    echo "banner_mobile: " . ($teacher->banner_mobile ?? 'NULL') . "\n";
}

echo "\n=== CHECKING STORAGE LINK DETAILS ===\n";
$publicPath = public_path('storage');
if (is_link($publicPath)) {
    echo "Storage link is a symlink: " . readlink($publicPath) . "\n";
} elseif (is_dir($publicPath)) {
    echo "Storage is a directory\n";
}

$bannerPath = $publicPath . '/guru-banners';
if (is_dir($bannerPath)) {
    $files = scandir($bannerPath);
    echo "Files in public/guru-banners: " . implode(', ', array_diff($files, ['.', '..'])) . "\n";
} else {
    echo "No guru-banners directory in public storage\n";
}