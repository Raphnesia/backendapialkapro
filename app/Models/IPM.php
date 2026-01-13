<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPM extends Model
{
    use HasFactory;

    protected $table = 'ipm';

    protected $fillable = [
        'position',
        'name',
        'photo',
        'kelas',
        'description',
        'order_index',
        'is_active'
    ];

    protected $casts = [
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

    // Accessor untuk photo
    public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
} 