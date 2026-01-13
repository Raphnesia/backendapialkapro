<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PimpinanSMPBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'order_index',
        'is_active',
        'background_color', // green-600, green-700, dll
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

    // Mutator untuk image - handle array dari Filament
    public function setImageAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['image'] = reset($value);
        } else {
            $this->attributes['image'] = $value;
        }
    }
} 