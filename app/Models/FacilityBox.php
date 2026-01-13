<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityBox extends Model
{
    use HasFactory;

    protected $table = 'facility_boxes';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'background_image',
        'link_slug',
        'bg_color',
        'hover_bg_color',
        'order_index',
        'is_active',
        'creates_sub_facility'
    ];

    protected $casts = [
        'order_index' => 'integer',
        'is_active' => 'boolean',
        'creates_sub_facility' => 'boolean'
    ];

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

    // Accessor untuk icon
    public function getIconAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Accessor untuk background_image
    public function getBackgroundImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    // Relationship dengan SubFacility
    public function subFacilities()
    {
        return $this->hasMany(SubFacility::class, 'parent_slug', 'link_slug');
    }

    // Relationship dengan SubFacilitySettings
    public function subFacilitySettings()
    {
        return $this->hasOne(SubFacilitySettings::class, 'parent_slug', 'link_slug');
    }

    // Relationship dengan SubFacilityBoxes
    public function subFacilityBoxes()
    {
        return $this->hasMany(SubFacilityBox::class, 'parent_slug', 'link_slug');
    }

    // Relationship dengan SubFacilityPhotos
    public function subFacilityPhotos()
    {
        return $this->hasMany(SubFacilityPhoto::class, 'parent_slug', 'link_slug');
    }
} 