<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProfileSection extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'order_index',
        'is_active',
        'icon',
        'subtitle',
    ];

    protected $attributes = [
        'content' => '', // Default empty string instead of null
    ];

    protected $casts = [
        'order_index' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
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
}