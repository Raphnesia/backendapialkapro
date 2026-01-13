<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class InfoPPDBSettings extends Model
{
    use HasFactory;

    protected $table = 'info_p_p_d_b_settings';

    protected $fillable = [
        'title', 'subtitle', 'banner_desktop', 'banner_mobile', 'hero_description',
        'intro_badge', 'intro_title', 'intro_subtitle', 'featured_image',
        'featured_overlay_title', 'featured_overlay_desc', 'featured_badge',
        'key_points', 'alur_title', 'alur_subtitle', 'alur_image', 'steps',
        'program_section_badge', 'program_section_title', 'program_section_subtitle',
        'program_rows', 'cta_text', 'cta_link', 'cta_background', 'cta_badge',
        'cta_title', 'cta_description', 'cta_primary_label', 'cta_primary_url',
        'cta_secondary_label', 'cta_secondary_url', 'registration_deadline',
        'academic_year', 'is_registration_open', 'contact_info', 'meta_description',
        'meta_keywords', 'is_active',
    ];

    protected $casts = [
        'key_points' => 'array',
        'steps' => 'array',
        'program_rows' => 'array',
        'registration_deadline' => 'date',
        'is_registration_open' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        'title' => 'Info PPDB',
        'subtitle' => 'Alur Pendaftaran SMP Muhammadiyah Al Kautsar PK Kartasura',
        'hero_description' => 'Informasi lengkap mengenai alur pendaftaran dan persyaratan untuk menjadi bagian dari keluarga besar SMP Muhammadiyah Al Kautsar PK Kartasura dengan berbagai program unggulan yang tersedia.',
        'intro_badge' => 'Penerimaan Peserta Didik Baru',
        'intro_title' => 'Mari Daftarkan Putra Putri Anda Sekolah ke SMP Muhammadiyah Al Kautsar PK Kartasura',
        'intro_subtitle' => 'Informasi lengkap mengenai alur pendaftaran dan persyaratan untuk menjadi bagian dari keluarga besar SMP Muhammadiyah Al Kautsar PK Kartasura dengan berbagai program unggulan yang tersedia.',
        'featured_overlay_title' => 'Digital School',
        'featured_overlay_desc' => 'Sekolahku Surgaku',
        'featured_badge' => 'Sekolah Modern',
        'alur_title' => 'Pendaftaran Online',
        'alur_subtitle' => 'Langkah-langkah mudah untuk mendaftar di SMP Muhammadiyah Al Kautsar PK Kartasura',
        'program_section_badge' => 'Program Khusus',
        'program_section_title' => 'Pilihan Program Khusus Tersedia',
        'program_section_subtitle' => 'Berbagai program unggulan yang dapat dipilih sesuai dengan minat dan bakat calon siswa',
        'cta_text' => 'Siap Menjadi Bagian dari SMP Muhammadiyah AL Kautsar PK Kartasura',
        'cta_link' => 'https://ppdb.smpam.site',
        'cta_badge' => 'PPDB INDEN 2025 / 2026',
        'cta_title' => 'Siap Menjadi Bagian dari SMP Muhammadiyah AL Kautsar PK Kartasura',
        'cta_description' => 'Siap Menjadi Bagian dari SMP Muhammadiyah AL Kautsar PK Kartasura',
        'cta_primary_label' => 'PPDB Inden 2025 / 2026',
        'cta_primary_url' => 'https://ppdb.smpam.site',
        'cta_secondary_label' => 'Tentang ALKAPRO',
        'cta_secondary_url' => '#',
        'academic_year' => '2025 / 2026',
        'is_registration_open' => true,
        'is_active' => true,
    ];

    /**
     * Get active settings
     */
    public static function getSettings()
    {
        return static::first();
    }

    /**
     * Get absolute URL for image paths
     */
    public function getImageUrlAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        // If already absolute URL, return as is
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        // For production, use APP_URL, for local use localhost
        $baseUrl = config('app.env') === 'production' 
            ? config('app.url') 
            : 'http://localhost:8000';

        return $baseUrl . '/storage/' . ltrim($value, '/');
    }

    /**
     * Mutator untuk cta_link
     */
    protected function ctaLink(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return $value ?: 'https://ppdb.smpam.site';
            }
        );
    }
}



