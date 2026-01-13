<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test upload file
echo "=== TESTING FILE UPLOAD ===\n\n";

// Test 1: Check if storage directory exists
echo "1. Checking storage directory...\n";
$storagePath = storage_path('app/public/sejarah-singkat');
if (is_dir($storagePath)) {
    echo "✅ Storage directory exists: $storagePath\n";
} else {
    echo "❌ Storage directory not found: $storagePath\n";
}

// Test 2: Check if public storage link exists
echo "\n2. Checking public storage link...\n";
$publicStoragePath = public_path('storage');
if (is_link($publicStoragePath)) {
    echo "✅ Public storage link exists: $publicStoragePath\n";
    $target = readlink($publicStoragePath);
    echo "   Target: $target\n";
} else {
    echo "❌ Public storage link not found: $publicStoragePath\n";
}

// Test 3: Check permissions
echo "\n3. Checking permissions...\n";
if (is_writable($storagePath)) {
    echo "✅ Storage directory is writable\n";
} else {
    echo "❌ Storage directory is not writable\n";
}

// Test 4: Check if we can create a test file
echo "\n4. Testing file creation...\n";
$testFile = $storagePath . '/test.txt';
if (file_put_contents($testFile, 'test')) {
    echo "✅ Test file created successfully\n";
    unlink($testFile); // Clean up
    echo "   Test file cleaned up\n";
} else {
    echo "❌ Failed to create test file\n";
}

// Test 5: Check current files in directory
echo "\n5. Current files in storage directory:\n";
$files = scandir($storagePath);
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        echo "   - $file\n";
    }
}

echo "\n=== UPLOAD TESTING COMPLETE ===\n"; 