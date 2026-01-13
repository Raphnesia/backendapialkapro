<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlkaproLibrarySettings;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AlkaproLibraryController extends Controller
{
    /**
     * Get Alkapro Library settings
     */
    public function getSettings(): JsonResponse
    {
        try {
            $settings = AlkaproLibrarySettings::active()->first();

            if (!$settings) {
                return response()->json([
                    'success' => false,
                    'message' => 'Alkapro Library settings not found',
                    'data' => $this->getDefaultSettings()
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Alkapro Library settings retrieved successfully',
                'data' => $this->formatSettingsResponse($settings)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Alkapro Library settings',
                'error' => $e->getMessage(),
                'data' => $this->getDefaultSettings()
            ], 500);
        }
    }

    /**
     * Get complete Alkapro Library data (settings + content)
     */
    public function getComplete(): JsonResponse
    {
        try {
            $settings = AlkaproLibrarySettings::active()->first();

            if (!$settings) {
                return response()->json([
                    'success' => false,
                    'message' => 'Alkapro Library data not found',
                    'data' => $this->getDefaultCompleteData()
                ], 404);
            }

            $completeData = $this->formatCompleteResponse($settings);

            return response()->json([
                'success' => true,
                'message' => 'Alkapro Library complete data retrieved successfully',
                'data' => $completeData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Alkapro Library complete data',
                'error' => $e->getMessage(),
                'data' => $this->getDefaultCompleteData()
            ], 500);
        }
    }

    /**
     * Get gallery images only
     */
    public function getGallery(): JsonResponse
    {
        try {
            $settings = AlkaproLibrarySettings::active()->first();

            if (!$settings || !$settings->show_gallery) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gallery not available',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Gallery retrieved successfully',
                'data' => [
                    'images' => $settings->library_gallery ?? [],
                    'auto_slide' => $settings->gallery_auto_slide,
                    'slide_interval' => $settings->gallery_slide_interval
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve gallery',
                'error' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Get pamphlets only
     */
    public function getPamphlets(): JsonResponse
    {
        try {
            $settings = AlkaproLibrarySettings::active()->first();

            if (!$settings || !$settings->show_pamphlets) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pamphlets not available',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Pamphlets retrieved successfully',
                'data' => [
                    'images' => $settings->library_pamphlets ?? [],
                    'auto_slide' => $settings->pamphlet_auto_slide,
                    'slide_interval' => $settings->pamphlet_slide_interval
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve pamphlets',
                'error' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Format settings response
     */
    private function formatSettingsResponse(AlkaproLibrarySettings $settings): array
    {
        return [
            'id' => $settings->id,
            'basic_info' => [
                'title' => $settings->title,
                'subtitle' => $settings->subtitle,
                'banner_desktop' => $settings->banner_desktop,
                'banner_mobile' => $settings->banner_mobile,
            ],
            'hero_section' => [
                'title' => $settings->hero_title,
                'subtitle' => $settings->hero_subtitle,
                'image' => $settings->hero_image,
            ],
            'introduction' => [
                'badge_text' => $settings->intro_badge_text,
                'title' => $settings->intro_title,
                'description' => $settings->intro_description,
                'featured_image' => $settings->intro_featured_image,
            ],
            'features' => [
                'title' => $settings->features_title,
                'collection_features' => $settings->collection_features ?? [],
                'facility_features' => $settings->facility_features ?? [],
            ],
            'facilities_flow' => $settings->show_facilities_flow ? [
                'title' => $settings->facilities_flow_title,
                'description' => $settings->facilities_flow_description,
                'steps' => $settings->facilities_flow_steps ?? [],
            ] : null,
            'display_settings' => [
                'show_gallery' => $settings->show_gallery,
                'show_pamphlets' => $settings->show_pamphlets,
                'show_service_hours' => $settings->show_service_hours,
                'show_social_media' => $settings->show_social_media,
                'show_programs' => $settings->show_programs,
                'show_additional_services' => $settings->show_additional_services,
                'show_facilities_flow' => $settings->show_facilities_flow,
                'show_cta_section' => $settings->show_cta_section,
            ],
            'is_active' => $settings->is_active,
            'updated_at' => $settings->updated_at,
        ];
    }

    /**
     * Format complete response
     */
    private function formatCompleteResponse(AlkaproLibrarySettings $settings): array
    {
        return [
            'id' => $settings->id,
            'basic_info' => [
                'title' => $settings->title,
                'subtitle' => $settings->subtitle,
                'banner_desktop' => $settings->banner_desktop,
                'banner_mobile' => $settings->banner_mobile,
            ],
            'hero_section' => [
                'title' => $settings->hero_title,
                'subtitle' => $settings->hero_subtitle,
                'image' => $settings->hero_image,
            ],
            'introduction' => [
                'badge_text' => $settings->intro_badge_text,
                'title' => $settings->intro_title,
                'description' => $settings->intro_description,
                'featured_image' => $settings->intro_featured_image,
            ],
            'features' => [
                'title' => $settings->features_title,
                'collection_features' => $settings->collection_features ?? [],
                'facility_features' => $settings->facility_features ?? [],
            ],
            'facilities_flow' => $settings->show_facilities_flow ? [
                'title' => $settings->facilities_flow_title,
                'description' => $settings->facilities_flow_description,
                'steps' => $settings->facilities_flow_steps ?? [],
            ] : null,
            'gallery' => $settings->show_gallery ? [
                'images' => $settings->library_gallery ?? [],
                'auto_slide' => $settings->gallery_auto_slide,
                'slide_interval' => $settings->gallery_slide_interval,
            ] : null,
            'pamphlets' => $settings->show_pamphlets ? [
                'images' => $settings->library_pamphlets ?? [],
                'auto_slide' => $settings->pamphlet_auto_slide,
                'slide_interval' => $settings->pamphlet_slide_interval,
            ] : null,
            'programs' => $settings->show_programs ? [
                'title' => $settings->programs_title,
                'description' => $settings->programs_description,
                'reading_club' => [
                    'title' => $settings->reading_club_title,
                    'description' => $settings->reading_club_description,
                    'image' => $settings->reading_club_image,
                ],
                'digital_library' => [
                    'title' => $settings->digital_library_title,
                    'description' => $settings->digital_library_description,
                    'image' => $settings->digital_library_image,
                ],
            ] : null,
            'additional_services' => $settings->show_additional_services ? [
                'title' => $settings->services_title,
                'description' => $settings->services_description,
                'services' => $settings->additional_services ?? [],
            ] : null,
            'service_hours' => $settings->show_service_hours ? [
                'title' => $settings->service_hours_title,
                'weekday_hours' => $settings->weekday_hours,
                'weekend_hours' => $settings->weekend_hours,
                'note' => $settings->service_hours_note,
            ] : null,
            'social_media' => $settings->show_social_media ? [
                'instagram_username' => $settings->instagram_username,
                'instagram_url' => $settings->instagram_url,
                'facebook_url' => $settings->facebook_url,
                'twitter_url' => $settings->twitter_url,
                'youtube_url' => $settings->youtube_url,
            ] : null,
            'call_to_action' => $settings->show_cta_section ? [
                'title' => $settings->cta_title,
                'description' => $settings->cta_description,
                'background_image' => $settings->cta_background_image,
                'primary_button' => [
                    'text' => $settings->cta_primary_button_text,
                    'url' => $settings->cta_primary_button_url,
                ],
                'secondary_button' => [
                    'text' => $settings->cta_secondary_button_text,
                    'url' => $settings->cta_secondary_button_url,
                ],
            ] : null,
            'seo' => [
                'meta_title' => $settings->meta_title,
                'meta_description' => $settings->meta_description,
                'meta_keywords' => $settings->meta_keywords,
            ],
            'is_active' => $settings->is_active,
            'updated_at' => $settings->updated_at,
        ];
    }

    /**
     * Get default settings when no data found
     */
    private function getDefaultSettings(): array
    {
        return [
            'basic_info' => [
                'title' => 'Alkapro Library',
                'subtitle' => 'Perpustakaan Modern SMP Muhammadiyah Al Kautsar PK Kartasura',
                'banner_desktop' => null,
                'banner_mobile' => null,
            ],
            'hero_section' => [
                'title' => 'Alkapro Library',
                'subtitle' => 'Perpustakaan Modern SMP Muhammadiyah Al Kautsar PK Kartasura',
                'image' => null,
            ],
            'introduction' => [
                'badge_text' => 'Perpustakaan Sekolah',
                'title' => 'Selamat Datang di Alkapro Library',
                'description' => 'Perpustakaan modern dengan koleksi lengkap dan fasilitas terdepan untuk mendukung kegiatan belajar mengajar dan penelitian siswa.',
                'featured_image' => null,
            ],
            'features' => [
                'title' => 'Koleksi Lengkap & Fasilitas Modern',
                'collection_features' => AlkaproLibrarySettings::getDefaultCollectionFeatures(),
                'facility_features' => AlkaproLibrarySettings::getDefaultFacilityFeatures(),
            ],
            'facilities_flow' => [
                'title' => 'Alur Penggunaan Fasilitas Perpustakaan',
                'description' => 'Panduan langkah demi langkah untuk menggunakan fasilitas perpustakaan dengan optimal',
                'steps' => AlkaproLibrarySettings::getDefaultFacilitiesFlowSteps(),
            ],
            'display_settings' => [
                'show_gallery' => true,
                'show_pamphlets' => true,
                'show_service_hours' => true,
                'show_social_media' => true,
                'show_programs' => true,
                'show_additional_services' => true,
                'show_facilities_flow' => true,
                'show_cta_section' => true,
            ],
        ];
    }

    /**
     * Get default complete data when no data found
     */
    private function getDefaultCompleteData(): array
    {
        return array_merge($this->getDefaultSettings(), [
            'gallery' => [
                'images' => [],
                'auto_slide' => true,
                'slide_interval' => 4000,
            ],
            'pamphlets' => [
                'images' => [],
                'auto_slide' => true,
                'slide_interval' => 5000,
            ],
            'programs' => [
                'title' => 'Program Unggulan Perpustakaan',
                'description' => 'Berbagai program menarik yang tersedia di Alkapro Library untuk mendukung minat baca dan pembelajaran siswa',
                'reading_club' => [
                    'title' => 'Reading Club Alkapro',
                    'description' => 'Program klub membaca yang mengajak siswa untuk aktif membaca buku, berdiskusi, dan berbagi pengalaman literasi.',
                    'image' => null,
                ],
                'digital_library' => [
                    'title' => 'Perpustakaan Digital',
                    'description' => 'Akses ke koleksi digital yang luas termasuk e-book, jurnal online, dan database akademik.',
                    'image' => null,
                ],
            ],
            'additional_services' => [
                'title' => 'Layanan Tambahan',
                'description' => 'Layanan khusus yang tersedia untuk mendukung kegiatan akademik dan penelitian siswa',
                'services' => AlkaproLibrarySettings::getDefaultAdditionalServices(),
            ],
            'service_hours' => [
                'title' => 'Jam Layanan Perpustakaan Sekolah',
                'weekday_hours' => '07.30 - 14.30 WIB',
                'weekend_hours' => '07.30 - 11.00 WIB',
                'note' => 'Perpustakaan tutup pada hari libur nasional dan cuti bersama',
            ],
            'social_media' => [
                'instagram_username' => '@alkapro.library',
                'instagram_url' => 'https://instagram.com/alkapro.library',
                'facebook_url' => null,
                'twitter_url' => null,
                'youtube_url' => null,
            ],
            'call_to_action' => [
                'title' => 'Siap Menjelajahi Dunia Pengetahuan di Alkapro Library?',
                'description' => 'Bergabunglah dengan ribuan siswa yang telah merasakan manfaat fasilitas perpustakaan modern kami.',
                'background_image' => null,
                'primary_button' => [
                    'text' => 'Tentang Sekolah',
                    'url' => '/profil',
                ],
                'secondary_button' => [
                    'text' => 'Lihat Fasilitas Lain',
                    'url' => '/fasilitas',
                ],
            ],
            'seo' => [
                'meta_title' => 'Alkapro Library - Perpustakaan Modern SMP Muhammadiyah Al Kautsar',
                'meta_description' => 'Perpustakaan modern dengan koleksi lengkap dan fasilitas terdepan untuk mendukung kegiatan belajar mengajar siswa.',
                'meta_keywords' => 'perpustakaan, alkapro library, smp muhammadiyah, al kautsar, kartasura',
            ],
        ]);
    }
}
