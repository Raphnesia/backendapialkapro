<?php
require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CHECKING TEACHER DATA ===\n";

$teacher = \App\Models\Teacher::where('status', 'active')->first();

if ($teacher) {
    echo "ID: {$teacher->id}\n";
    echo "Name: {$teacher->name}\n";
    echo "banner_desktop: " . ($teacher->banner_desktop ?? 'NULL') . "\n";
    echo "banner_mobile: " . ($teacher->banner_mobile ?? 'NULL') . "\n";
    echo "guruData: " . json_encode($teacher->guruData) . "\n";
    
    echo "\n=== CHECKING STORAGE DIRECTORY ===\n";
    $storagePath = storage_path('app/public/guru-banners');
    if (is_dir($storagePath)) {
        $files = scandir($storagePath);
        echo "Files in guru-banners: " . implode(', ', array_diff($files, ['.', '..'])) . "\n";
    } else {
        echo "Directory not found: {$storagePath}\n";
    }
} else {
    echo "No active teacher found\n";
    
    echo "\n=== ALL TEACHERS ===\n";
    $teachers = \App\Models\Teacher::all();
    foreach ($teachers as $t) {
        echo "ID: {$t->id}, Name: {$t->name}, Status: {$t->status}\n";
    }
}

echo "\n=== CHECKING PUBLIC STORAGE LINK ===\n";
$publicPath = public_path('storage');
echo "Public storage link: " . (is_link($publicPath) ? 'EXISTS' : 'NOT FOUND') . "\n";
if (is_dir($publicPath)) {
    echo "Storage directory exists\n";
}