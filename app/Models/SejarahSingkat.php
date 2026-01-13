<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahSingkat extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'grid_type',
        'use_list_disc',
        'list_items',
        'background_color',
        'border_color',
        'order_index',
        'is_active',
    ];

    protected $casts = [
        'use_list_disc' => 'boolean',
        'list_items' => 'array',
        'is_active' => 'boolean',
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index', 'asc');
    }
}
