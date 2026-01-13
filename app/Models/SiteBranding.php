<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteBranding extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_logo',
        'footer_brand_type', // text|image
        'footer_brand_text',
        'footer_brand_image',
    ];

    protected $casts = [
        // No special casts needed; kept simple for URLs/paths
    ];
} 