<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeHeroVideo extends Model
{
    use HasFactory;

    protected $table = 'home_hero_videos';

    protected $fillable = [
        'title',
        'source_type',
        'video_file',
        'mobile_video_file',
        'video_url',
        'mobile_video_url',
        'poster_image',
        'is_active',
        'order_index',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_index' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index')->orderBy('id');
    }

    protected function mapStorageUrl(?string $value): ?string
    {
        if (!$value) {
            return null;
        }
        if (preg_match('/^https?:\/\//i', $value)) {
            return $value;
        }
        return asset('storage/' . $value);
    }

    public function getVideoFileAttribute($value)
    {
        return $this->mapStorageUrl($value);
    }

    public function getMobileVideoFileAttribute($value)
    {
        return $this->mapStorageUrl($value);
    }

    public function getPosterImageAttribute($value)
    {
        return $this->mapStorageUrl($value);
    }
} 