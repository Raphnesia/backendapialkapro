<?php

echo "🔍 Checking Alkapro Library Setup...\n\n";

// Check if we're in Laravel environment
if (!file_exists('artisan')) {
    echo "❌ Error: Not in Laravel root directory\n";
    exit(1);
}

// Load Laravel
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "✅ Laravel loaded successfully\n\n";

// 1. Check migration file exists
$migrationFile = 'database/migrations/2025_01_15_000000_create_alkapro_library_settings_table.php';
if (file_exists($migrationFile)) {
    echo "✅ Migration file exists: {$migrationFile}\n";
} else {
    echo "❌ Migration file missing: {$migrationFile}\n";
}

// 2. Check model exists
$modelFile = 'app/Models/AlkaproLibrarySettings.php';
if (file_exists($modelFile)) {
    echo "✅ Model file exists: {$modelFile}\n";
} else {
    echo "❌ Model file missing: {$modelFile}\n";
}

// 3. Check Filament resource exists
$resourceFile = 'app/Filament/Resources/AlkaproLibrarySettingsResource.php';
if (file_exists($resourceFile)) {
    echo "✅ Filament resource exists: {$resourceFile}\n";
} else {
    echo "❌ Filament resource missing: {$resourceFile}\n";
}

// 4. Check controller exists
$controllerFile = 'app/Http/Controllers/Api/AlkaproLibraryController.php';
if (file_exists($controllerFile)) {
    echo "✅ API controller exists: {$controllerFile}\n";
} else {
    echo "❌ API controller missing: {$controllerFile}\n";
}

echo "\n";

// 5. Check database connection
try {
    $pdo = DB::connection()->getPdo();
    echo "✅ Database connection successful\n";
    
    // Check if table exists
    $tableExists = DB::select("SHOW TABLES LIKE 'alkapro_library_settings'");
    if (!empty($tableExists)) {
        echo "✅ Table 'alkapro_library_settings' exists\n";
        
        // Check table structure
        $columns = DB::select("DESCRIBE alkapro_library_settings");
        echo "📋 Table has " . count($columns) . " columns\n";
        
        // Check if there's any data
        $count = DB::table('alkapro_library_settings')->count();
        echo "📊 Table has {$count} records\n";
        
    } else {
        echo "❌ Table 'alkapro_library_settings' does not exist\n";
        echo "🔧 Run: php artisan migrate\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}

echo "\n";

// 6. Check if Filament can discover the resource
try {
    if (class_exists('App\\Filament\\Resources\\AlkaproLibrarySettingsResource')) {
        echo "✅ Filament resource class can be loaded\n";
        
        $resource = new App\Filament\Resources\AlkaproLibrarySettingsResource();
        echo "✅ Filament resource can be instantiated\n";
        
    } else {
        echo "❌ Filament resource class not found\n";
        echo "🔧 Run: composer dump-autoload\n";
    }
} catch (Exception $e) {
    echo "❌ Error loading Filament resource: " . $e->getMessage() . "\n";
}

echo "\n";

// 7. Provide solutions
echo "🛠️  SOLUTIONS IF ISSUES FOUND:\n";
echo "1. Run migration: php artisan migrate\n";
echo "2. Clear caches: php artisan cache:clear && php artisan config:clear\n";
echo "3. Refresh autoload: composer dump-autoload\n";
echo "4. Clear Filament cache: php artisan filament:clear-cached-components\n";
echo "5. Restart web server if needed\n";

echo "\n✅ Check complete!\n";
