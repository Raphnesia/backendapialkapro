<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFacilitySettings extends Model
{
    use HasFactory;

    protected $table = 'sub_facility_settings';

    protected $fillable = [
        'parent_slug',
        'title',
        'subtitle',
        'banner_desktop',
        'banner_mobile',
        'title_panel_bg_color',
        'subtitle_panel_bg_color',
        'content_section_title',
        'content_section_text',
        'display_type',
        'show_photo_collage',
        'is_active'
    ];

    protected $casts = [
        'show_photo_collage' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk filter berdasarkan parent_slug
    public function scopeByParentSlug($query, $parentSlug)
    {
        return $query->where('parent_slug', $parentSlug);
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

    // Relationship dengan FacilityBox
    public function facilityBox()
    {
        return $this->belongsTo(FacilityBox::class, 'parent_slug', 'link_slug');
    }

    // Relationship dengan SubFacility
    public function subFacilities()
    {
        return $this->hasMany(SubFacility::class, 'parent_slug', 'parent_slug');
    }
} 