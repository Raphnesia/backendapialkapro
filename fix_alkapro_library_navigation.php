<?php

echo "🔧 Fixing Alkapro Library Navigation Issue...\n\n";

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

// 1. Check if Filament is properly installed
try {
    $filamentVersion = \Composer\InstalledVersions::getVersion('filament/filament');
    echo "✅ Filament version: {$filamentVersion}\n";
} catch (Exception $e) {
    echo "❌ Filament not found: " . $e->getMessage() . "\n";
}

// 2. Check Filament configuration
$filamentConfig = config('filament');
if ($filamentConfig) {
    echo "✅ Filament config loaded\n";
} else {
    echo "❌ Filament config not found\n";
}

// 3. Check if our resource class exists and can be loaded
try {
    if (class_exists('App\\Filament\\Resources\\AlkaproLibrarySettingsResource')) {
        echo "✅ AlkaproLibrarySettingsResource class exists\n";
        
        $reflection = new ReflectionClass('App\\Filament\\Resources\\AlkaproLibrarySettingsResource');
        echo "✅ Resource file: " . $reflection->getFileName() . "\n";
        
        // Check navigation properties
        $navigationIcon = $reflection->getStaticPropertyValue('navigationIcon');
        $navigationGroup = $reflection->getStaticPropertyValue('navigationGroup');
        $navigationLabel = $reflection->getStaticPropertyValue('navigationLabel');
        
        echo "📋 Navigation Icon: {$navigationIcon}\n";
        echo "📋 Navigation Group: {$navigationGroup}\n";
        echo "📋 Navigation Label: {$navigationLabel}\n";
        
    } else {
        echo "❌ AlkaproLibrarySettingsResource class not found\n";
    }
} catch (Exception $e) {
    echo "❌ Error checking resource: " . $e->getMessage() . "\n";
}

// 4. Check if model exists and table is accessible
try {
    if (class_exists('App\\Models\\AlkaproLibrarySettings')) {
        echo "✅ AlkaproLibrarySettings model exists\n";
        
        $model = new App\Models\AlkaproLibrarySettings();
        $tableName = $model->getTable();
        echo "✅ Model table: {$tableName}\n";
        
        // Try to access the table
        $count = App\Models\AlkaproLibrarySettings::count();
        echo "✅ Table accessible, records: {$count}\n";
        
    } else {
        echo "❌ AlkaproLibrarySettings model not found\n";
    }
} catch (Exception $e) {
    echo "❌ Error checking model: " . $e->getMessage() . "\n";
}

// 5. Check Filament panels
try {
    $panels = \Filament\Facades\Filament::getPanels();
    echo "✅ Filament panels found: " . count($panels) . "\n";
    
    foreach ($panels as $panelId => $panel) {
        echo "  - Panel: {$panelId}\n";
    }
} catch (Exception $e) {
    echo "❌ Error checking panels: " . $e->getMessage() . "\n";
}

echo "\n🛠️  RECOMMENDED FIXES:\n";
echo "1. Clear all caches: php artisan cache:clear\n";
echo "2. Clear Filament cache: php artisan filament:clear-cached-components\n";
echo "3. Refresh autoload: composer dump-autoload\n";
echo "4. Check if resource is in correct namespace\n";
echo "5. Try moving resource to main navigation (remove navigationGroup)\n";

echo "\n✅ Diagnostic complete!\n";
