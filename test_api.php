<?php
require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TESTING API RESPONSE ===\n";

// Test the API endpoint directly
$controller = new \App\Http\Controllers\Api\TeacherSettingController();
$response = $controller->index();
$data = $response->getData();

echo "API Response:\n";
echo "banner_desktop: " . ($data->data->banner_desktop ?? 'NULL') . "\n";
echo "banner_mobile: " . ($data->data->banner_mobile ?? 'NULL') . "\n";
echo "Full data: " . json_encode($data, JSON_PRETTY_PRINT) . "\n";