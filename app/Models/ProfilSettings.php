<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSettings extends Model
{
    use HasFactory;

    protected $table = 'profil_settings';

    protected $fillable = [
        'title',
        'subtitle',
        'banner_desktop',
        'banner_mobile',
        'description',
        'meta_description',
        'meta_keywords',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active profile settings
     */
    public static function getSettings()
    {
        return static::where('is_active', true)->first() ?? static::first();
    }
}
