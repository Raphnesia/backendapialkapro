<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlkaproLibrarySettings extends Model
{
    use HasFactory;

    protected $table = 'alkapro_library_settings';

    protected $fillable = [
        // Basic Page Settings
        'title',
        'subtitle',
        'banner_desktop',
        'banner_mobile',
        
        // Hero Section Settings
        'hero_title',
        'hero_subtitle',
        'hero_image',
        
        // Introduction Section
        'intro_badge_text',
        'intro_title',
        'intro_description',
        'intro_featured_image',
        
        // Library Gallery Settings
        'library_gallery',
        'gallery_auto_slide',
        'gallery_slide_interval',
        
        // Library Pamphlets Settings
        'library_pamphlets',
        'pamphlet_auto_slide',
        'pamphlet_slide_interval',
        
        // Service Hours Settings
        'service_hours_title',
        'weekday_hours',
        'weekend_hours',
        'service_hours_note',
        
        // Social Media Settings
        'instagram_username',
        'instagram_url',
        'facebook_url',
        'twitter_url',
        'youtube_url',
        
        // Call to Action Settings
        'cta_title',
        'cta_description',
        'cta_background_image',
        'cta_primary_button_text',
        'cta_primary_button_url',
        'cta_secondary_button_text',
        'cta_secondary_button_url',
        
        // Features Section
        'features_title',
        'collection_features',
        'facility_features',
        
        // Programs Section
        'programs_title',
        'programs_description',
        'reading_club_title',
        'reading_club_description',
        'reading_club_image',
        'digital_library_title',
        'digital_library_description',
        'digital_library_image',
        
        // Additional Services Section
        'services_title',
        'services_description',
        'additional_services',
        
        // SEO Settings
        'meta_title',
        'meta_description',
        'meta_keywords',
        
        // Display Settings
        'show_gallery',
        'show_pamphlets',
        'show_service_hours',
        'show_social_media',
        'show_programs',
        'show_additional_services',
        'show_cta_section',
        
        // Status
        'is_active'
    ];

    protected $casts = [
        'library_gallery' => 'array',
        'library_pamphlets' => 'array',
        'collection_features' => 'array',
        'facility_features' => 'array',
        'additional_services' => 'array',
        'gallery_auto_slide' => 'boolean',
        'pamphlet_auto_slide' => 'boolean',
        'show_gallery' => 'boolean',
        'show_pamphlets' => 'boolean',
        'show_service_hours' => 'boolean',
        'show_social_media' => 'boolean',
        'show_programs' => 'boolean',
        'show_additional_services' => 'boolean',
        'show_cta_section' => 'boolean',
        'is_active' => 'boolean',
        'gallery_slide_interval' => 'integer',
        'pamphlet_slide_interval' => 'integer'
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk banner_desktop
    public function getBannerDesktopAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Accessor untuk banner_mobile
    public function getBannerMobileAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Accessor untuk hero_image
    public function getHeroImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Accessor untuk intro_featured_image
    public function getIntroFeaturedImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Accessor untuk reading_club_image
    public function getReadingClubImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Accessor untuk digital_library_image
    public function getDigitalLibraryImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Accessor untuk cta_background_image
    public function getCtaBackgroundImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Accessor untuk library_gallery - convert paths to full URLs
    public function getLibraryGalleryAttribute($value)
    {
        if (!$value) return [];
        
        $gallery = is_string($value) ? json_decode($value, true) : $value;
        
        if (!is_array($gallery)) return [];
        
        return array_map(function($path) {
            return $path ? asset('storage/' . $path) : null;
        }, $gallery);
    }

    // Accessor untuk library_pamphlets - convert paths to full URLs
    public function getLibraryPamphletsAttribute($value)
    {
        if (!$value) return [];
        
        $pamphlets = is_string($value) ? json_decode($value, true) : $value;
        
        if (!is_array($pamphlets)) return [];
        
        return array_map(function($path) {
            return $path ? asset('storage/' . $path) : null;
        }, $pamphlets);
    }

    // Mutator untuk banner_desktop - handle array dari Filament
    public function setBannerDesktopAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['banner_desktop'] = reset($value);
        } else {
            $this->attributes['banner_desktop'] = $value;
        }
    }

    // Mutator untuk banner_mobile - handle array dari Filament
    public function setBannerMobileAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['banner_mobile'] = reset($value);
        } else {
            $this->attributes['banner_mobile'] = $value;
        }
    }

    // Mutator untuk hero_image - handle array dari Filament
    public function setHeroImageAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['hero_image'] = reset($value);
        } else {
            $this->attributes['hero_image'] = $value;
        }
    }

    // Mutator untuk intro_featured_image - handle array dari Filament
    public function setIntroFeaturedImageAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['intro_featured_image'] = reset($value);
        } else {
            $this->attributes['intro_featured_image'] = $value;
        }
    }

    // Mutator untuk reading_club_image - handle array dari Filament
    public function setReadingClubImageAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['reading_club_image'] = reset($value);
        } else {
            $this->attributes['reading_club_image'] = $value;
        }
    }

    // Mutator untuk digital_library_image - handle array dari Filament
    public function setDigitalLibraryImageAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['digital_library_image'] = reset($value);
        } else {
            $this->attributes['digital_library_image'] = $value;
        }
    }

    // Mutator untuk cta_background_image - handle array dari Filament
    public function setCtaBackgroundImageAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['cta_background_image'] = reset($value);
        } else {
            $this->attributes['cta_background_image'] = $value;
        }
    }

    // Helper method untuk mendapatkan default collection features
    public static function getDefaultCollectionFeatures()
    {
        return [
            'Buku pelajaran kurikulum terbaru',
            'Koleksi buku referensi dan ensiklopedia',
            'Majalah dan jurnal ilmiah',
            'E-book dan sumber digital'
        ];
    }

    // Helper method untuk mendapatkan default facility features
    public static function getDefaultFacilityFeatures()
    {
        return [
            'Area baca yang nyaman dan tenang',
            'Komputer dan akses internet gratis',
            'Ruang diskusi kelompok',
            'Sistem katalog digital'
        ];
    }

    // Helper method untuk mendapatkan default additional services
    public static function getDefaultAdditionalServices()
    {
        return [
            [
                'title' => 'Layanan Referensi',
                'description' => 'Bantuan pustakawan dalam mencari informasi dan referensi untuk tugas dan penelitian siswa',
                'icon' => 'search'
            ],
            [
                'title' => 'Pelatihan Literasi Digital',
                'description' => 'Workshop dan pelatihan penggunaan database digital, e-journal, dan sumber informasi online',
                'icon' => 'monitor'
            ],
            [
                'title' => 'Ruang Belajar Kelompok',
                'description' => 'Fasilitas ruang diskusi untuk kegiatan belajar kelompok dan presentasi siswa',
                'icon' => 'users'
            ],
            [
                'title' => 'Layanan Fotokopi & Print',
                'description' => 'Fasilitas fotokopi dan print untuk kebutuhan akademik siswa dengan harga terjangkau',
                'icon' => 'file-text'
            ]
        ];
    }
}
