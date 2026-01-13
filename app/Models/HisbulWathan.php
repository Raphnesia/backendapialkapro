<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HisbulWathan extends Model
{
    use HasFactory;

    protected $table = 'hisbul_wathan';

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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index', 'asc');
    }

    public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
} 