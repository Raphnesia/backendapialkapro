<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahSingkatSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'banner_desktop',
        'banner_mobile',
        'title_panel_bg_color',
        'subtitle_panel_bg_color',
        'mobile_panel_bg_color',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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
}
