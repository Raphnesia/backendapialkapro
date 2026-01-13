<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;
use App\Models\Teacher;

echo "=== Testing Storage Existence ===\n";

$teacher = Teacher::first();
if ($teacher && $teacher->guruData) {
    $guruData = $teacher->guruData;
    
    echo "Database banner_desktop: " . ($guruData['banner_desktop'] ?? 'null') . "\n";
    echo "Database banner_mobile: " . ($guruData['banner_mobile'] ?? 'null') . "\n";
    
    if (!empty($guruData['banner_desktop'])) {
        $path = $guruData['banner_desktop'];
        $exists = Storage::disk('public')->exists($path);
        echo "banner_desktop exists: " . ($exists ? 'YES' : 'NO') . "\n";
        echo "Full URL would be: " . asset('storage/' . $path) . "\n";
    }
    
    if (!empty($guruData['banner_mobile'])) {
        $path = $guruData['banner_mobile'];
        $exists = Storage::disk('public')->exists($path);
        echo "banner_mobile exists: " . ($exists ? 'YES' : 'NO') . "\n";
        echo "Full URL would be: " . asset('storage/' . $path) . "\n";
    }
} else {
    echo "No teacher data found\n";
}