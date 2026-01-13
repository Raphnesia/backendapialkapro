<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKhususType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'banner_desktop',
        'banner_mobile',
        'intro_badge',
        'intro_title',
        'intro_subtitle',
        'featured_image',
        'featured_overlay_title',
        'featured_overlay_desc',
        'featured_badge',
        'key_points',
        'features_title',
        'features_subtitle',
        'features_image',
        'features_items',
        'benefits_badge',
        'benefits_title',
        'benefits_subtitle',
        'benefits_items',
        'gallery_title',
        'gallery_subtitle',
        'gallery_items',
        'cta_background',
        'cta_badge',
        'cta_title',
        'cta_description',
        'cta_primary_label',
        'cta_primary_url',
        'cta_secondary_label',
        'cta_secondary_url',
        'is_active',
    ];

    protected $casts = [
        'key_points' => 'array',
        'features_items' => 'array',
        'benefits_items' => 'array',
        'gallery_items' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}


