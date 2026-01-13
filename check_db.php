<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Teacher;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Checking Teacher Data ===\n";

$teacher = Teacher::first();

if ($teacher) {
    echo "Teacher found: ID " . $teacher->id . "\n";
    echo "Name: " . $teacher->name . "\n";
    echo "=== guruData contents ===\n";
    
    if ($teacher->guruData) {
        print_r($teacher->guruData);
    } else {
        echo "guruData is null or empty\n";
    }
} else {
    echo "No teacher found in database\n";
}

echo "\n=== Raw JSON ===\n";
if ($teacher && $teacher->guruData) {
    echo json_encode($teacher->guruData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
}