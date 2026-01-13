<?php

echo "=== ALKAPRO LIBRARY HOSTING FIX SCRIPT ===\n\n";

// Step 1: Check if files exist
echo "STEP 1: CHECKING FILES ON HOSTING SERVER\n";
$required_files = [
    'app/Models/AlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/ListAlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/CreateAlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/EditAlkaproLibrarySettings.php',
    'database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php'
];

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
    echo "\n❌ CRITICAL: Some files are missing! Git pull might not have worked properly.\n";
    echo "Missing files:\n";
    foreach ($missing_files as $file) {
        echo "   - $file\n";
    }
    echo "\nPlease check your git pull and ensure all files are uploaded.\n";
    exit(1);
}

echo "\n✅ All required files are present!\n\n";

// Step 2: Check database connection
echo "STEP 2: TESTING DATABASE CONNECTION\n";
try {
    // Try to get PDO connection
    $pdo = DB::connection()->getPdo();
    echo "✅ Database connection successful!\n";
    
    // Check if migrations table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'migrations'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Migrations table exists\n";
    } else {
        echo "❌ Migrations table not found\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "Please check your .env database settings on hosting server.\n\n";
    
    echo "MANUAL FIX REQUIRED:\n";
    echo "1. Check .env file on hosting server\n";
    echo "2. Verify database credentials\n";
    echo "3. Ensure database server is accessible\n";
    exit(1);
}

// Step 3: Check if migration has been run
echo "\nSTEP 3: CHECKING MIGRATION STATUS\n";
try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'alkapro_library_settings'");
    if ($stmt->rowCount() > 0) {
        echo "✅ alkapro_library_settings table exists\n";
    } else {
        echo "❌ alkapro_library_settings table NOT found\n";
        echo "RUNNING MIGRATION NOW...\n";
        
        // Try to run migration
        $output = shell_exec('php artisan migrate --path=database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php 2>&1');
        echo "Migration output: $output\n";
        
        // Check again
        $stmt = $pdo->query("SHOW TABLES LIKE 'alkapro_library_settings'");
        if ($stmt->rowCount() > 0) {
            echo "✅ Migration successful! Table created.\n";
        } else {
            echo "❌ Migration failed. Please run manually: php artisan migrate\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Error checking migration: " . $e->getMessage() . "\n";
}

// Step 4: Clear caches
echo "\nSTEP 4: CLEARING CACHES\n";
$cache_commands = [
    'php artisan config:clear',
    'php artisan route:clear',
    'php artisan view:clear'
];

foreach ($cache_commands as $command) {
    echo "Running: $command\n";
    $output = shell_exec("$command 2>&1");
    if (strpos($output, 'cleared') !== false || strpos($output, 'DONE') !== false) {
        echo "✅ Success\n";
    } else {
        echo "⚠️  Output: $output\n";
    }
}

// Step 5: Manual cache clearing
echo "\nSTEP 5: MANUAL CACHE CLEARING\n";
$cache_dirs = [
    'bootstrap/cache',
    'storage/framework/cache/data',
    'storage/framework/views'
];

foreach ($cache_dirs as $dir) {
    if (is_dir($dir)) {
        $files = glob("$dir/*");
        $deleted = 0;
        foreach ($files as $file) {
            if (is_file($file) && unlink($file)) {
                $deleted++;
            }
        }
        echo "✅ Cleared $deleted files from $dir\n";
    } else {
        echo "⚠️  Directory $dir not found\n";
    }
}

// Step 6: Check Filament resource registration
echo "\nSTEP 6: CHECKING FILAMENT RESOURCE\n";
if (class_exists('App\\Filament\\Resources\\AlkaproLibrarySettingsResource')) {
    echo "✅ AlkaproLibrarySettingsResource class exists\n";
    
    // Check if model exists
    if (class_exists('App\\Models\\AlkaproLibrarySettings')) {
        echo "✅ AlkaproLibrarySettings model exists\n";
    } else {
        echo "❌ AlkaproLibrarySettings model not found\n";
    }
} else {
    echo "❌ AlkaproLibrarySettingsResource class not found\n";
    echo "This might be an autoloader issue.\n";
}

// Step 7: Try to optimize autoloader
echo "\nSTEP 7: OPTIMIZING AUTOLOADER\n";
$optimize_commands = [
    'composer dump-autoload',
    'php artisan optimize'
];

foreach ($optimize_commands as $command) {
    echo "Running: $command\n";
    $output = shell_exec("$command 2>&1");
    echo "Output: " . substr($output, 0, 200) . "...\n";
}

// Step 8: Final check
echo "\nSTEP 8: FINAL VERIFICATION\n";
echo "Please check your Filament admin panel now.\n";
echo "You should see:\n";
echo "- Navigation Group: 'Perpustakaan'\n";
echo "- Menu Item: 'Pengaturan Alkapro Library'\n\n";

echo "If still not visible, try:\n";
echo "1. Restart your web server\n";
echo "2. Clear browser cache\n";
echo "3. Check if you're logged in as admin user\n";
echo "4. Run: php artisan filament:optimize\n\n";

echo "=== SCRIPT COMPLETED ===\n";
echo "If the menu still doesn't appear, please share the output of this script.\n";
