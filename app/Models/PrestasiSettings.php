<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSettings extends Model
{
    use HasFactory;

    protected $table = 'prestasi_settings';

    protected $fillable = [
        'hero_bg_from',
        'hero_bg_via',
        'hero_bg_to',
        'badge_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
} 