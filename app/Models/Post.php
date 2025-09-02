<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'content',
        'image',
        'author_image',
        'category',
        'type',
        'is_published',
        'published_at',
        'author',
        'tags',
        'meta_description',
        'navigation_sections',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'tags' => 'array',
        'navigation_sections' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            $post->processNavigationSections();
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Process navigation sections to auto-generate IDs from titles
     */
    public function processNavigationSections()
    {
        if (!$this->navigation_sections) {
            return;
        }

        $processedSections = [];
        $usedIds = [];

        foreach ($this->navigation_sections as $section) {
            if (isset($section['title']) && !empty($section['title'])) {
                // Generate ID from title
                $baseId = $this->generateIdFromTitle($section['title']);
                $uniqueId = $this->ensureUniqueId($baseId, $usedIds);
                $usedIds[] = $uniqueId;

                $processedSections[] = [
                    'id' => $uniqueId,
                    'title' => $section['title'],
                    'content' => $section['content'] ?? '',
                ];
            }
        }

        $this->navigation_sections = $processedSections;
    }

    /**
     * Generate a slug-like ID from title
     */
    private function generateIdFromTitle($title)
    {
        // Convert to lowercase and create slug
        $slug = Str::slug($title, '-');
        
        // Ensure it starts with a letter (for valid HTML IDs)
        if (preg_match('/^[0-9]/', $slug)) {
            $slug = 'section-' . $slug;
        }
        
        return $slug;
    }

    /**
     * Ensure the ID is unique within the navigation sections
     */
    private function ensureUniqueId($baseId, $usedIds)
    {
        $uniqueId = $baseId;
        $counter = 1;

        while (in_array($uniqueId, $usedIds)) {
            $uniqueId = $baseId . '-' . $counter;
            $counter++;
        }

        return $uniqueId;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where('published_at', '<=', now());
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc')->orderBy('id', 'desc');
    }
}
