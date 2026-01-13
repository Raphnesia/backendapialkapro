<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityPhoto extends Model
{
    use HasFactory;

    protected $table = 'facility_photos';

    protected $fillable = [
        'title',
        'description',
        'image',
        'alt_text',
        'order_index',
        'is_active'
    ];

    protected $casts = [
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

    // Accessor untuk image
    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
} 