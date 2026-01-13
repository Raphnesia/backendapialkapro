<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';

    protected $fillable = [
        'title',
        'excerpt',
        'image',
        'category',
        'jadwal',
        'location',
        'pembina',
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

    // Scope untuk filter berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'Semua Ekstrakurikuler') {
            return $query->where('category', $category);
        }
        return $query;
    }

    // Accessor untuk image
    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
} 