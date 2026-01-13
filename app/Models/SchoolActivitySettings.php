<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolActivitySettings extends Model
{
    use HasFactory;

    protected $table = 'school_activity_settings';

    protected $fillable = [
        'title',
        'subtitle',
        'banner_desktop',
        'banner_mobile',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getBannerDesktopAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getBannerMobileAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
} 