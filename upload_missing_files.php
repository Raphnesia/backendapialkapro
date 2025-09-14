<?php

echo "=== UPLOAD MISSING ALKAPRO LIBRARY FILES ===\n\n";

echo "MASALAH TERIDENTIFIKASI:\n";
echo "File AlkaproLibrarySettings.php tidak ada di hosting server.\n";
echo "Ini berarti git pull tidak berhasil mengambil semua file.\n\n";

echo "SOLUSI:\n";
echo "1. Manual upload file yang hilang\n";
echo "2. Atau force git pull dengan reset\n\n";

// Check which files are missing
$required_files = [
    'app/Models/AlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/ListAlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/CreateAlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/EditAlkaproLibrarySettings.php',
    'database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php',
    'app/Http/Controllers/Api/AlkaproLibraryController.php'
];

echo "CHECKING FILES ON HOSTING:\n";
$missing_files = [];
foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "✅ $file\n";
    } else {
        echo "❌ $file - MISSING!\n";
        $missing_files[] = $file;
    }
}

if (!empty($missing_files)) {
    echo "\n❌ CRITICAL: " . count($missing_files) . " files are missing!\n\n";
    
    echo "MISSING FILES:\n";
    foreach ($missing_files as $file) {
        echo "   - $file\n";
    }
    
    echo "\nSOLUSI YANG HARUS DILAKUKAN:\n\n";
    
    echo "OPSI 1: FORCE GIT PULL\n";
    echo "git fetch origin\n";
    echo "git reset --hard origin/main\n";
    echo "git pull origin main\n\n";
    
    echo "OPSI 2: MANUAL UPLOAD\n";
    echo "Upload file-file yang hilang secara manual melalui:\n";
    echo "- cPanel File Manager\n";
    echo "- FTP/SFTP\n";
    echo "- SSH dan scp\n\n";
    
    echo "OPSI 3: RE-CREATE FILES\n";
    echo "Jalankan script ini untuk membuat ulang file yang hilang:\n";
    echo "php recreate_alkapro_files.php\n\n";
    
} else {
    echo "\n✅ All files are present!\n";
    echo "The issue might be elsewhere. Run the main fix script:\n";
    echo "php fix_hosting_alkapro_library.php\n";
}

echo "=== END CHECK ===\n";
