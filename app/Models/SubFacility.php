<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SubFacility extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'sub_facilities';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category',
        'capacity',
        'location',
        'specifications',
        'order_index',
        'is_active',
        'parent_slug'
    ];

    protected $casts = [
        'capacity' => 'integer',
        'order_index' => 'integer',
        'is_active' => 'boolean',
        'specifications' => 'array'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

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

    // Scope untuk filter berdasarkan parent_slug
    public function scopeByParentSlug($query, $parentSlug)
    {
        return $query->where('parent_slug', $parentSlug);
    }

    // Scope untuk filter berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Accessor untuk image
    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Relationship dengan FacilityBox
    public function facilityBox()
    {
        return $this->belongsTo(FacilityBox::class, 'parent_slug', 'link_slug');
    }

    // Relationship dengan SubFacilitySettings
    public function settings()
    {
        return $this->hasOne(SubFacilitySettings::class, 'parent_slug', 'parent_slug');
    }
} 