<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarqueeText extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'order_index',
        'is_active',
        'color',
        'speed',
    ];

    protected $casts = [
        'order_index' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index')->orderBy('id');
    }
} 