<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPMContent extends Model
{
    use HasFactory;

    protected $table = 'ipm_content';

    protected $fillable = [
        'title',
        'content',
        'grid_type',
        'use_list_disc',
        'list_items',
        'bidang_structure',
        'background_color',
        'border_color',
        'order_index',
        'is_active'
    ];

    protected $casts = [
        'list_items' => 'array',
        'bidang_structure' => 'array',
        'use_list_disc' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index', 'asc');
    }

    public function getBackgroundColorAttribute($value)
    {
        return $value ?: 'bg-white';
    }

    public function getBorderColorAttribute($value)
    {
        return $value ?: 'border-gray-200';
    }
} 