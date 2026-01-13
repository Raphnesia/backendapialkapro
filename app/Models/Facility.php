<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Facility extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

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
    ];

    protected $casts = [
        'capacity' => 'integer',
        'order_index' => 'integer',
        'is_active' => 'boolean',
        'specifications' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index')->orderBy('id');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }


}