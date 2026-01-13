<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityContent extends Model
{
    use HasFactory;

    protected $table = 'facility_content';

    protected $fillable = [
        'section_title',
        'content',
        'display_type',
        'show_photo_collage',
        'order_index',
        'is_active'
    ];

    protected $casts = [
        'show_photo_collage' => 'boolean',
        'order_index' => 'integer',
        'is_active' => 'boolean'
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk data yang diurutkan
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index')->orderBy('id');
    }
} 