<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFacilityBox extends Model
{
    use HasFactory;

    protected $table = 'sub_facility_boxes';

    protected $fillable = [
        'parent_slug',
        'title',
        'description',
        'icon',
        'background_image',
        'bg_color',
        'hover_bg_color',
        'order_index',
        'is_active'
    ];

    protected $casts = [
        'order_index' => 'integer',
        'is_active' => 'boolean'
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

    // Scope untuk filter berdasarkan parent_slug
    public function scopeByParentSlug($query, $parentSlug)
    {
        return $query->where('parent_slug', $parentSlug);
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

    // Relationship dengan FacilityBox
    public function facilityBox()
    {
        return $this->belongsTo(FacilityBox::class, 'parent_slug', 'link_slug');
    }
} 