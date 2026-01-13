<?php
// test_ipm_complex_structure.php
// Script untuk testing struktur IPM yang kompleks

echo "=== TEST IPM COMPLEX STRUCTURE ===\n\n";

// Test API IPM Complete
echo "1. Testing IPM Complete API:\n";
$url = 'http://localhost:8000/api/v1/ipm/complete';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ IPM Complete API berhasil\n";
    
    if (isset($data['data']['settings'])) {
        echo "   - Settings: " . $data['data']['settings']['title'] . "\n";
    }
    
    if (isset($data['data']['pengurus'])) {
        echo "   - Pengurus: " . count($data['data']['pengurus']) . " data\n";
    }
    
    if (isset($data['data']['content'])) {
        echo "   - Content: " . count($data['data']['content']) . " section\n";
        
        foreach ($data['data']['content'] as $index => $section) {
            echo "     Section " . ($index + 1) . ": " . $section['title'] . "\n";
            
            if (isset($section['bidang_structure']) && is_array($section['bidang_structure'])) {
                echo "       - Bidang Structure: " . count($section['bidang_structure']) . " bidang\n";
                
                foreach ($section['bidang_structure'] as $bidangIndex => $bidang) {
                    echo "         Bidang " . ($bidangIndex + 1) . ": " . $bidang['bidang_name'] . "\n";
                    
                    if (isset($bidang['members']) && is_array($bidang['members'])) {
                        echo "           - Members: " . count($bidang['members']) . " anggota\n";
                        
                        foreach ($bidang['members'] as $memberIndex => $member) {
                            echo "             " . ($memberIndex + 1) . ". " . $member['name'];
                            if (isset($member['position']) && $member['position']) {
                                echo " (" . $member['position'] . ")";
                            }
                            echo "\n";
                        }
                    }
                }
            }
        }
    }
} else {
    echo "❌ IPM Complete API gagal\n";
    echo "   Response: " . $response . "\n";
}

echo "\n";

// Test IPM Content API
echo "2. Testing IPM Content API:\n";
$url = 'http://localhost:8000/api/v1/ipm-content';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ IPM Content API berhasil\n";
    echo "   - Total content: " . count($data['data']) . " data\n";
    
    foreach ($data['data'] as $index => $content) {
        echo "   Content " . ($index + 1) . ": " . $content['title'] . "\n";
        
        if (isset($content['bidang_structure']) && is_array($content['bidang_structure'])) {
            echo "     - Bidang Structure: " . count($content['bidang_structure']) . " bidang\n";
        }
        
        if (isset($content['list_items']) && is_array($content['list_items'])) {
            echo "     - List Items: " . count($content['list_items']) . " item\n";
        }
    }
} else {
    echo "❌ IPM Content API gagal\n";
    echo "   Response: " . $response . "\n";
}

echo "\n";

// Test IPM Pengurus API
echo "3. Testing IPM Pengurus API:\n";
$url = 'http://localhost:8000/api/v1/ipm';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ IPM Pengurus API berhasil\n";
    echo "   - Total pengurus: " . count($data['data']) . " data\n";
    
    foreach ($data['data'] as $index => $pengurus) {
        echo "   Pengurus " . ($index + 1) . ": " . $pengurus['position'] . " - " . $pengurus['name'] . "\n";
    }
} else {
    echo "❌ IPM Pengurus API gagal\n";
    echo "   Response: " . $response . "\n";
}

echo "\n";

// Test IPM Settings API
echo "4. Testing IPM Settings API:\n";
$url = 'http://localhost:8000/api/v1/ipm/settings';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    echo "✅ IPM Settings API berhasil\n";
    echo "   - Title: " . $data['data']['title'] . "\n";
    echo "   - Subtitle: " . $data['data']['subtitle'] . "\n";
    echo "   - Banner Desktop: " . ($data['data']['banner_desktop'] ? 'Ada' : 'Tidak ada') . "\n";
    echo "   - Banner Mobile: " . ($data['data']['banner_mobile'] ? 'Ada' : 'Tidak ada') . "\n";
} else {
    echo "❌ IPM Settings API gagal\n";
    echo "   Response: " . $response . "\n";
}

echo "\n=== TEST SELESAI ===\n";
?> 