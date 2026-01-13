<?php

// Test API Sejarah Singkat
echo "=== TESTING SEJARAH SINGKAT API ===\n\n";

$baseUrl = 'http://localhost:8000/api/v1';

// Test 1: Complete data
echo "1. Testing /sejarah-singkat/complete\n";
$url = $baseUrl . '/sejarah-singkat/complete';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['success']) {
    echo "✅ Success: Complete data retrieved\n";
    echo "Settings Title: " . $data['data']['settings']['title'] . "\n";
    echo "Content Count: " . count($data['data']['content']) . "\n";
} else {
    echo "❌ Error: " . $data['message'] . "\n";
}

echo "\n";

// Test 2: Settings only
echo "2. Testing /sejarah-singkat/settings\n";
$url = $baseUrl . '/sejarah-singkat/settings';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['success']) {
    echo "✅ Success: Settings retrieved\n";
    echo "Title: " . $data['data']['title'] . "\n";
    echo "Subtitle: " . $data['data']['subtitle'] . "\n";
    echo "Title Panel Color: " . $data['data']['title_panel_bg_color'] . "\n";
} else {
    echo "❌ Error: " . $data['message'] . "\n";
}

echo "\n";

// Test 3: Content only
echo "3. Testing /sejarah-singkat\n";
$url = $baseUrl . '/sejarah-singkat';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['success']) {
    echo "✅ Success: Content retrieved\n";
    echo "Total Sections: " . count($data['data']) . "\n";
    
    foreach ($data['data'] as $section) {
        echo "- " . $section['title'] . " (Grid: " . $section['grid_type'] . ")\n";
    }
} else {
    echo "❌ Error: " . $data['message'] . "\n";
}

echo "\n";

// Test 4: Grid type filter
echo "4. Testing /sejarah-singkat/grid/grid-cols-2\n";
$url = $baseUrl . '/sejarah-singkat/grid/grid-cols-2';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['success']) {
    echo "✅ Success: Grid-cols-2 content retrieved\n";
    echo "Sections with grid-cols-2: " . count($data['data']) . "\n";
    
    foreach ($data['data'] as $section) {
        echo "- " . $section['title'] . "\n";
    }
} else {
    echo "❌ Error: " . $data['message'] . "\n";
}

echo "\n";

// Test 5: With list items
echo "5. Testing /sejarah-singkat/with-list-items\n";
$url = $baseUrl . '/sejarah-singkat/with-list-items';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['success']) {
    echo "✅ Success: Content with list items retrieved\n";
    echo "Sections with list items: " . count($data['data']) . "\n";
    
    foreach ($data['data'] as $section) {
        echo "- " . $section['title'] . " (Items: " . count($section['list_items']) . ")\n";
    }
} else {
    echo "❌ Error: " . $data['message'] . "\n";
}

echo "\n";

// Test 6: Single content by ID
echo "6. Testing /sejarah-singkat/1\n";
$url = $baseUrl . '/sejarah-singkat/1';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['success']) {
    echo "✅ Success: Single content retrieved\n";
    echo "Title: " . $data['data']['title'] . "\n";
    echo "Grid Type: " . $data['data']['grid_type'] . "\n";
    echo "Use List Disc: " . ($data['data']['use_list_disc'] ? 'Yes' : 'No') . "\n";
} else {
    echo "❌ Error: " . $data['message'] . "\n";
}

echo "\n=== API TESTING COMPLETE ===\n"; 