<?php

echo "=== RECREATE MISSING ALKAPRO LIBRARY FILES ===\n\n";

// Create directories if they don't exist
$directories = [
    'app/Models',
    'app/Filament/Resources',
    'app/Filament/Resources/AlkaproLibrarySettingsResource/Pages',
    'app/Http/Controllers/Api',
    'database/migrations'
];

echo "CREATING DIRECTORIES:\n";
foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0755, true)) {
            echo "✅ Created: $dir\n";
        } else {
            echo "❌ Failed to create: $dir\n";
        }
    } else {
        echo "✅ Exists: $dir\n";
    }
}

echo "\nCREATING FILES:\n";

// 1. Create AlkaproLibrarySettings Model
$model_content = '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlkaproLibrarySettings extends Model
{
    use HasFactory;

    protected $table = \'alkapro_library_settings\';

    protected $fillable = [
        // Basic Page Settings
        \'title\',
        \'subtitle\',
        \'banner_desktop\',
        \'banner_mobile\',
        
        // Hero Section Settings
        \'hero_title\',
        \'hero_subtitle\',
        \'hero_image\',
        
        // Introduction Section
        \'intro_badge_text\',
        \'intro_title\',
        \'intro_description\',
        \'intro_featured_image\',
        
        // Library Gallery Settings
        \'library_gallery\',
        \'gallery_auto_slide\',
        \'gallery_slide_interval\',
        
        // Library Pamphlets Settings
        \'library_pamphlets\',
        \'pamphlet_auto_slide\',
        \'pamphlet_slide_interval\',
        
        // Service Hours Settings
        \'service_hours_title\',
        \'weekday_hours\',
        \'weekend_hours\',
        \'service_hours_note\',
        
        // Social Media Settings
        \'instagram_username\',
        \'instagram_url\',
        \'facebook_url\',
        \'twitter_url\',
        \'youtube_url\',
        
        // Call to Action Settings
        \'cta_title\',
        \'cta_description\',
        \'cta_background_image\',
        \'cta_primary_button_text\',
        \'cta_primary_button_url\',
        \'cta_secondary_button_text\',
        \'cta_secondary_button_url\',
        
        // Features Section
        \'features_title\',
        \'collection_features\',
        \'facility_features\',
        
        // Programs Section
        \'programs_title\',
        \'programs_description\',
        \'reading_club_title\',
        \'reading_club_description\',
        \'reading_club_image\',
        \'digital_library_title\',
        \'digital_library_description\',
        \'digital_library_image\',
        
        // Additional Services Section
        \'services_title\',
        \'services_description\',
        \'additional_services\',
        
        // SEO Settings
        \'meta_title\',
        \'meta_description\',
        \'meta_keywords\',
        
        // Display Settings
        \'show_gallery\',
        \'show_pamphlets\',
        \'show_service_hours\',
        \'show_social_media\',
        \'show_programs\',
        \'show_additional_services\',
        \'show_cta_section\',
        
        // Status
        \'is_active\'
    ];

    protected $casts = [
        \'library_gallery\' => \'array\',
        \'library_pamphlets\' => \'array\',
        \'collection_features\' => \'array\',
        \'facility_features\' => \'array\',
        \'additional_services\' => \'array\',
        \'gallery_auto_slide\' => \'boolean\',
        \'pamphlet_auto_slide\' => \'boolean\',
        \'show_gallery\' => \'boolean\',
        \'show_pamphlets\' => \'boolean\',
        \'show_service_hours\' => \'boolean\',
        \'show_social_media\' => \'boolean\',
        \'show_programs\' => \'boolean\',
        \'show_additional_services\' => \'boolean\',
        \'show_cta_section\' => \'boolean\',
        \'is_active\' => \'boolean\',
        \'gallery_slide_interval\' => \'integer\',
        \'pamphlet_slide_interval\' => \'integer\'
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where(\'is_active\', true);
    }

    // Helper method untuk mendapatkan default collection features
    public static function getDefaultCollectionFeatures()
    {
        return [
            \'Buku pelajaran kurikulum terbaru\',
            \'Koleksi buku referensi dan ensiklopedia\',
            \'Majalah dan jurnal ilmiah\',
            \'E-book dan sumber digital\'
        ];
    }

    // Helper method untuk mendapatkan default facility features
    public static function getDefaultFacilityFeatures()
    {
        return [
            \'Area baca yang nyaman dan tenang\',
            \'Komputer dan akses internet gratis\',
            \'Ruang diskusi kelompok\',
            \'Sistem katalog digital\'
        ];
    }

    // Helper method untuk mendapatkan default additional services
    public static function getDefaultAdditionalServices()
    {
        return [
            [
                \'title\' => \'Layanan Referensi\',
                \'description\' => \'Bantuan pustakawan dalam mencari informasi dan referensi untuk tugas dan penelitian siswa\',
                \'icon\' => \'search\'
            ],
            [
                \'title\' => \'Pelatihan Literasi Digital\',
                \'description\' => \'Workshop dan pelatihan penggunaan database digital, e-journal, dan sumber informasi online\',
                \'icon\' => \'monitor\'
            ],
            [
                \'title\' => \'Ruang Belajar Kelompok\',
                \'description\' => \'Fasilitas ruang diskusi untuk kegiatan belajar kelompok dan presentasi siswa\',
                \'icon\' => \'users\'
            ],
            [
                \'title\' => \'Layanan Fotokopi & Print\',
                \'description\' => \'Fasilitas fotokopi dan print untuk kebutuhan akademik siswa dengan harga terjangkau\',
                \'icon\' => \'file-text\'
            ]
        ];
    }
}
';

if (file_put_contents('app/Models/AlkaproLibrarySettings.php', $model_content)) {
    echo "✅ Created: app/Models/AlkaproLibrarySettings.php\n";
} else {
    echo "❌ Failed to create: app/Models/AlkaproLibrarySettings.php\n";
}

// 2. Create API Controller
$controller_content = '<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlkaproLibrarySettings;
use Illuminate\Http\Request;

class AlkaproLibraryController extends Controller
{
    /**
     * Get Alkapro Library settings
     */
    public function index()
    {
        try {
            // Get active settings
            $settings = AlkaproLibrarySettings::active()->first();
            
            if (!$settings) {
                // Return default structure if no settings found
                return response()->json([
                    \'success\' => true,
                    \'message\' => \'Alkapro Library settings retrieved successfully\',
                    \'data\' => [
                        \'title\' => \'Alkapro Library\',
                        \'subtitle\' => \'Perpustakaan Modern SMP Muhammadiyah Al Kautsar PK Kartasura\',
                        \'hero_title\' => \'Alkapro Library\',
                        \'hero_subtitle\' => \'Perpustakaan Modern SMP Muhammadiyah Al Kautsar PK Kartasura\',
                        \'intro_title\' => \'Selamat Datang di Alkapro Library\',
                        \'features_title\' => \'Koleksi Lengkap & Fasilitas Modern\',
                        \'collection_features\' => AlkaproLibrarySettings::getDefaultCollectionFeatures(),
                        \'facility_features\' => AlkaproLibrarySettings::getDefaultFacilityFeatures(),
                        \'additional_services\' => AlkaproLibrarySettings::getDefaultAdditionalServices(),
                        \'service_hours_title\' => \'Jam Layanan Perpustakaan Sekolah\',
                        \'weekday_hours\' => \'07.30 - 14.30 WIB\',
                        \'weekend_hours\' => \'07.30 - 11.00 WIB\',
                        \'cta_title\' => \'Siap Menjelajahi Dunia Pengetahuan di Alkapro Library?\',
                        \'is_active\' => true,
                        \'show_gallery\' => true,
                        \'show_programs\' => true,
                        \'show_service_hours\' => true,
                        \'show_social_media\' => true,
                        \'show_additional_services\' => true,
                        \'show_cta_section\' => true
                    ]
                ], 200);
            }
            
            return response()->json([
                \'success\' => true,
                \'message\' => \'Alkapro Library settings retrieved successfully\',
                \'data\' => $settings
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                \'success\' => false,
                \'message\' => \'Failed to retrieve Alkapro Library settings\',
                \'error\' => $e->getMessage()
            ], 500);
        }
    }
}
';

if (file_put_contents('app/Http/Controllers/Api/AlkaproLibraryController.php', $controller_content)) {
    echo "✅ Created: app/Http/Controllers/Api/AlkaproLibraryController.php\n";
} else {
    echo "❌ Failed to create: app/Http/Controllers/Api/AlkaproLibraryController.php\n";
}

echo "\nNEXT STEPS:\n";
echo "1. Upload file Filament Resource yang lebih besar secara manual\n";
echo "2. Atau jalankan: git reset --hard origin/main && git pull origin main\n";
echo "3. Kemudian jalankan: php artisan migrate\n";
echo "4. Dan: php artisan optimize:clear\n\n";

echo "FILES CREATED SUCCESSFULLY!\n";
echo "Now you need to upload the Filament Resource files manually or fix git pull.\n";
