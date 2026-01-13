<?php
// test_pimpinan_smp_api.php
// File untuk testing API Pimpinan SMP

$baseUrl = 'http://localhost:8000/api/v1';

echo "=== Testing Pimpinan SMP API ===\n\n";

// Test 1: Get complete data
echo "1. Testing GET /pimpinan-smp/complete\n";
$url = $baseUrl . '/pimpinan-smp/complete';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success: Complete data retrieved\n";
    echo "   - Settings: " . (isset($data['data']['settings']) ? 'Available' : 'Not available') . "\n";
    echo "   - Pimpinan count: " . (isset($data['data']['pimpinan']) ? count($data['data']['pimpinan']) : 0) . "\n";
    echo "   - Boxes count: " . (isset($data['data']['boxes']) ? count($data['data']['boxes']) : 0) . "\n";
} else {
    echo "❌ Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error') . "\n";
}

echo "\n";

// Test 2: Get settings
echo "2. Testing GET /pimpinan-smp/settings\n";
$url = $baseUrl . '/pimpinan-smp/settings';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success: Settings retrieved\n";
    echo "   - Title: " . $data['data']['title'] . "\n";
    echo "   - Subtitle: " . substr($data['data']['subtitle'], 0, 50) . "...\n";
} else {
    echo "❌ Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error') . "\n";
}

echo "\n";

// Test 3: Get all pimpinan
echo "3. Testing GET /pimpinan-smp\n";
$url = $baseUrl . '/pimpinan-smp';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success: Pimpinan data retrieved\n";
    echo "   - Total pimpinan: " . count($data['data']) . "\n";
    
    foreach ($data['data'] as $pimpinan) {
        echo "   - " . $pimpinan['name'] . " (" . $pimpinan['type'] . ")\n";
    }
} else {
    echo "❌ Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error') . "\n";
}

echo "\n";

// Test 4: Get kepala sekolah
echo "4. Testing GET /pimpinan-smp/kepala-sekolah\n";
$url = $baseUrl . '/pimpinan-smp/kepala-sekolah';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success: Kepala sekolah data retrieved\n";
    if (count($data['data']) > 0) {
        echo "   - Name: " . $data['data'][0]['name'] . "\n";
        echo "   - Position: " . $data['data'][0]['position'] . "\n";
    } else {
        echo "   - No kepala sekolah found\n";
    }
} else {
    echo "❌ Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error') . "\n";
}

echo "\n";

// Test 5: Get wakil kepala sekolah
echo "5. Testing GET /pimpinan-smp/wakil-kepala-sekolah\n";
$url = $baseUrl . '/pimpinan-smp/wakil-kepala-sekolah';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success: Wakil kepala sekolah data retrieved\n";
    echo "   - Total wakil kepala sekolah: " . count($data['data']) . "\n";
    
    foreach ($data['data'] as $wakil) {
        echo "   - " . $wakil['name'] . " (" . $wakil['type'] . ")\n";
    }
} else {
    echo "❌ Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error') . "\n";
}

echo "\n";

// Test 6: Get boxes
echo "6. Testing GET /pimpinan-smp/boxes\n";
$url = $baseUrl . '/pimpinan-smp/boxes';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success: Boxes data retrieved\n";
    echo "   - Total boxes: " . count($data['data']) . "\n";
    
    foreach ($data['data'] as $box) {
        echo "   - " . $box['title'] . " (" . $box['icon'] . ")\n";
    }
} else {
    echo "❌ Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error') . "\n";
}

echo "\n";

// Test 7: Get pimpinan by type
echo "7. Testing GET /pimpinan-smp/type/kepala_sekolah\n";
$url = $baseUrl . '/pimpinan-smp/type/kepala_sekolah';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ Success: Pimpinan by type retrieved\n";
    echo "   - Total kepala sekolah: " . count($data['data']) . "\n";
} else {
    echo "❌ Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error') . "\n";
}

echo "\n";

echo "=== Testing Complete ===\n";
echo "Jika semua test berhasil, API Pimpinan SMP sudah siap digunakan!\n";
echo "Untuk mengakses admin panel, buka: http://localhost:8000/admin\n";
echo "Untuk dokumentasi lengkap, lihat: PIMPINAN_SMP_API_DOCUMENTATION.md\n";
?> 