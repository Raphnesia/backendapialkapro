<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SchoolActivity extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'image',
        'activity_date',
        'activity_time',
        'location',
        'category',
        'participants',
        'author',
        'type',
        'date',
        'is_active',
        'order_index',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'activity_time' => 'datetime:H:i',
        'date' => 'date',
        'participants' => 'array',
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
        return $query->orderBy('activity_date', 'desc')->orderBy('id', 'desc');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('activity_date', '>=', now());
    }

    public function scopePast($query)
    {
        return $query->where('activity_date', '<', now());
    }
}