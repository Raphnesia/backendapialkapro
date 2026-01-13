<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PopupSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'image_url',
        'image_alt',
        'link_url',
        'open_in_new_tab',
        'show_on_first_visit_only',
        'delay_before_show',
        'expires_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_in_new_tab' => 'boolean',
        'show_on_first_visit_only' => 'boolean',
        'delay_before_show' => 'integer',
        'expires_at' => 'datetime',
    ];

    protected $appends = ['image_url_full'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the full URL for the image
     */
    public function getImageUrlFullAttribute()
    {
        if (!$this->image_url) {
            return null;
        }

        // If it's already a full URL (starts with http:// or https://), return as is
        if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
            return $this->image_url;
        }

        // Otherwise, convert storage path to full URL
        return Storage::disk('public')->url($this->image_url);
    }
}
