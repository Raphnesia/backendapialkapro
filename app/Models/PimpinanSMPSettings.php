<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PimpinanSMPSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'banner_desktop',
        'banner_mobile',
        'keunggulan_title',
        'keunggulan_subtitle',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
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
} 