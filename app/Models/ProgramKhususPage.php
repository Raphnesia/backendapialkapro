<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKhususPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_image_desktop',
        'hero_image_mobile',
        'overview_title',
        'overview_subtitle',
        'section_title',
        'section_subtitle',
        'section_programs',
        'programs',
        'reasons_title',
        'reasons_subtitle',
        'reasons',
        'cta_title',
        'cta_subtitle',
        'cta_primary_label',
        'cta_primary_url',
        'cta_secondary_label',
        'cta_secondary_url',
        'is_active',
    ];

    protected $casts = [
        'programs' => 'array',
        'section_programs' => 'array',
        'reasons' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}


