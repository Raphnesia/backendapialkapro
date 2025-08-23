<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_heading',
        'hero_background_color',
        'hero_text_color'
    ];
} 