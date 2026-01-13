<?php

// Test script untuk API Profil Sekolah
echo "🧪 TESTING API PROFIL SEKOLAH\n";
echo "==============================\n\n";

$baseUrl = 'http://localhost:8000/api/v1';

// Function untuk test API
function testApi($endpoint, $description) {
    global $baseUrl;
    
    $url = $baseUrl . $endpoint;
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 10
        ]
    ]);
    
    echo "🔍 Testing: $description\n";
    echo "URL: $url\n";
    
    $response = @file_get_contents($url, false, $context);
    
    if ($response === false) {
        echo "❌ Error: Tidak dapat mengakses API\n";
        echo "   Pastikan server Laravel berjalan dengan: php artisan serve\n\n";
        return false;
    }
    
    $data = json_decode($response, true);
    
    if ($data && isset($data['success']) && $data['success']) {
        echo "✅ Success: API berfungsi dengan baik\n";
        
        if (isset($data['data']['settings'])) {
            echo "   📋 Settings: " . ($data['data']['settings']['title'] ?? 'N/A') . "\n";
        }
        
        if (isset($data['data']['content'])) {
            echo "   📄 Content: " . count($data['data']['content']) . " item(s)\n";
        } elseif (isset($data['data']) && is_array($data['data'])) {
            echo "   📄 Data: " . count($data['data']) . " item(s)\n";
        }
        
        echo "\n";
        return true;
    } else {
        echo "❌ Error: Response tidak valid\n";
        echo "   Response: " . substr($response, 0, 200) . "...\n\n";
        return false;
    }
}

// Test semua API endpoints
echo "🎯 VISI MISI API\n";
echo "----------------\n";
testApi('/visi-misi', 'Get All Visi Misi');
testApi('/visi-misi/settings', 'Get Visi Misi Settings');
testApi('/visi-misi/complete', 'Get Complete Visi Misi Data');

echo "🏢 STRUKTUR ORGANISASI API\n";
echo "---------------------------\n";
testApi('/struktur-organisasi', 'Get All Struktur Organisasi');
testApi('/struktur-organisasi/settings', 'Get Struktur Organisasi Settings');
testApi('/struktur-organisasi/complete', 'Get Complete Struktur Organisasi Data');

echo "🕌 IPM API\n";
echo "----------\n";
testApi('/ipm', 'Get All IPM Data');
testApi('/ipm/settings', 'Get IPM Settings');
testApi('/ipm/complete', 'Get Complete IPM Data');

echo "🎨 EKSTRAKURIKULER API\n";
echo "----------------------\n";
testApi('/ekstrakurikuler', 'Get All Ekstrakurikuler');
testApi('/ekstrakurikuler/settings', 'Get Ekstrakurikuler Settings');
testApi('/ekstrakurikuler/complete', 'Get Complete Ekstrakurikuler Data');
testApi('/ekstrakurikuler/category/Olahraga', 'Get Ekstrakurikuler by Category (Olahraga)');

echo "🎯 VISI MISI SPECIAL ENDPOINTS\n";
echo "-------------------------------\n";
testApi('/visi-misi/grid/grid-cols-2', 'Get Visi Misi by Grid Type (grid-cols-2)');
testApi('/visi-misi/with-list-items', 'Get Visi Misi with List Items');

echo "📊 SUMMARY\n";
echo "----------\n";
echo "✅ Semua API endpoints telah di-test\n";
echo "📋 Dokumentasi tersedia di file:\n";
echo "   - VISI_MISI_API_DOCUMENTATION.md\n";
echo "   - STRUKTUR_ORGANISASI_API_DOCUMENTATION.md\n";
echo "   - IPM_API_DOCUMENTATION.md\n";
echo "   - EKSTRAKURIKULER_API_DOCUMENTATION.md\n";
echo "   - DOCUMENTATION_SUMMARY.md\n";
echo "\n🎛️ Admin Panel: http://localhost:8000/admin\n";
echo "   Email: admin@admin.com\n";
echo "   Password: admin123\n";
echo "\n🚀 Selamat menggunakan API Profil Sekolah!\n"; 