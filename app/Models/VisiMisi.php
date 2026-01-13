<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;

    protected $table = 'visi_misi';

    protected $fillable = [
        'title',
        'content',
        'grid_type',
        'use_list_disc',
        'list_items',
        'background_color',
        'border_color',
        'order_index',
        'is_active'
    ];

    protected $casts = [
        'list_items' => 'array',
        'use_list_disc' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk data terurut
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index', 'asc');
    }

    // Accessor untuk background_color
    public function getBackgroundColorAttribute($value)
    {
        return $value ?: 'bg-white';
    }

    // Accessor untuk border_color
    public function getBorderColorAttribute($value)
    {
        return $value ?: 'border-gray-200';
    }
} 