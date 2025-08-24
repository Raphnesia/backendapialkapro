<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_heading',
        'hero_subtitle',
        'hero_background_color',
        'hero_text_color',
        'floating_elements_bg_color',
        'floating_elements_text_color',
        'feature_lists'
    ];

    protected $casts = [
        'feature_lists' => 'array'
    ];
} 