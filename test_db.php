<?php

// Load Laravel
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    // Test database connection
    DB::connection()->getPdo();
    echo "Database connection successful!\n";
    
    // Test if facilities table exists
    $tables = DB::select('SHOW TABLES');
    $tableNames = array_map(function($table) {
        return array_values((array)$table)[0];
    }, $tables);
    
    if (in_array('facilities', $tableNames)) {
        echo "Facilities table exists!\n";
        
        // Test query
        $count = DB::table('facilities')->count();
        echo "Facilities count: " . $count . "\n";
    } else {
        echo "Facilities table does not exist!\n";
    }
    
} catch (Exception $e) {
    echo "Database error: " . $e->getMessage() . "\n";
} 