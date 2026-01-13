<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Teacher;

echo "=== Checking Active Status ===\n";

// Check all teachers with their active status
$teachers = Teacher::all();

foreach ($teachers as $teacher) {
    echo "Teacher ID: " . $teacher->id . "\n";
    echo "Name: " . $teacher->name . "\n";
    echo "guruData active: " . ($teacher->guruData['active'] ?? 'null') . "\n";
    echo "---\n";
}

// Check if any teacher has active=true
$activeTeacher = Teacher::whereJsonContains('guruData->active', true)->first();
if ($activeTeacher) {
    echo "Found active teacher: " . $activeTeacher->name . "\n";
} else {
    echo "No teacher with active=true found\n";
}