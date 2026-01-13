<?php

echo "=== ALKAPRO LIBRARY FILAMENT DIAGNOSTIC ===\n\n";

// Check if files exist
$files_to_check = [
    'app/Models/AlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/ListAlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/CreateAlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/EditAlkaproLibrarySettings.php',
    'database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php'
];

echo "1. CHECKING FILE EXISTENCE:\n";
foreach ($files_to_check as $file) {
    $exists = file_exists($file);
    echo "   " . ($exists ? "✅" : "❌") . " $file\n";
}

echo "\n2. CHECKING PHP SYNTAX:\n";
$php_files = [
    'app/Models/AlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/ListAlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/CreateAlkaproLibrarySettings.php',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages/EditAlkaproLibrarySettings.php'
];

foreach ($php_files as $file) {
    if (file_exists($file)) {
        $output = [];
        $return_var = 0;
        exec("php -l \"$file\" 2>&1", $output, $return_var);
        
        if ($return_var === 0) {
            echo "   ✅ $file - Syntax OK\n";
        } else {
            echo "   ❌ $file - Syntax Error:\n";
            foreach ($output as $line) {
                echo "      $line\n";
            }
        }
    }
}

echo "\n3. CHECKING FILAMENT RESOURCE REGISTRATION:\n";

// Check if the resource is properly namespaced
if (file_exists('app/Filament/Resources/AlkaproLibrarySettingsResource.php')) {
    $content = file_get_contents('app/Filament/Resources/AlkaproLibrarySettingsResource.php');
    
    // Check namespace
    if (preg_match('/namespace\s+App\\\\Filament\\\\Resources;/', $content)) {
        echo "   ✅ Namespace is correct\n";
    } else {
        echo "   ❌ Namespace issue detected\n";
    }
    
    // Check class name
    if (preg_match('/class\s+AlkaproLibrarySettingsResource\s+extends\s+Resource/', $content)) {
        echo "   ✅ Class extends Resource correctly\n";
    } else {
        echo "   ❌ Class definition issue\n";
    }
    
    // Check model reference
    if (preg_match('/protected\s+static\s+\?\s*string\s+\$model\s*=\s*AlkaproLibrarySettings::class;/', $content)) {
        echo "   ✅ Model reference is correct\n";
    } else {
        echo "   ❌ Model reference issue\n";
    }
    
    // Check navigation settings
    if (preg_match('/protected\s+static\s+\?\s*string\s+\$navigationGroup\s*=\s*[\'"]Perpustakaan[\'"];/', $content)) {
        echo "   ✅ Navigation group is set\n";
    } else {
        echo "   ❌ Navigation group not found\n";
    }
}

echo "\n4. CHECKING MIGRATION FILE:\n";
if (file_exists('database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php')) {
    $migration_content = file_get_contents('database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php');
    
    if (strpos($migration_content, 'create_alkapro_library_settings_table') !== false) {
        echo "   ✅ Migration file looks correct\n";
    } else {
        echo "   ❌ Migration file has issues\n";
    }
    
    if (strpos($migration_content, "Schema::create('alkapro_library_settings'") !== false) {
        echo "   ✅ Table creation syntax is correct\n";
    } else {
        echo "   ❌ Table creation syntax issue\n";
    }
} else {
    echo "   ❌ Migration file not found\n";
}

echo "\n5. POSSIBLE SOLUTIONS:\n";
echo "   1. Run migration: php artisan migrate\n";
echo "   2. Clear caches: php artisan optimize:clear\n";
echo "   3. Check database connection in .env file\n";
echo "   4. Restart web server\n";
echo "   5. Check Filament panel configuration\n";

echo "\n6. TROUBLESHOOTING COMMANDS:\n";
echo "   # Clear all caches\n";
echo "   php artisan optimize:clear\n\n";
echo "   # Check if migration exists in database\n";
echo "   php artisan migrate:status\n\n";
echo "   # Run specific migration\n";
echo "   php artisan migrate --path=database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php\n\n";
echo "   # Check Filament resources\n";
echo "   php artisan filament:list-resources\n\n";

echo "=== END DIAGNOSTIC ===\n";
