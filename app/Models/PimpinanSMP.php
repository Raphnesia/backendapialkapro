<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PimpinanSMP extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'photo',
        'bio',
        'education',
        'experience',
        'order_index',
        'is_active',
        'banner_desktop',
        'banner_mobile',
        'type', // kepala_sekolah, wakil_kepala_sekolah_kurikulum, wakil_kepala_sekolah_kesiswaan, wakil_kepala_sekolah_sdm_humas, wakil_kepala_sekolah_aik, wakil_kepala_sekolah_sarpras
    ];

    protected $casts = [
        'order_index' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index')->orderBy('id');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Mutator untuk banner_desktop - handle array dari Filament
    public function setBannerDesktopAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['banner_desktop'] = reset($value);
        } else {
            $this->attributes['banner_desktop'] = $value;
        }
    }

    // Mutator untuk banner_mobile - handle array dari Filament
    public function setBannerMobileAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['banner_mobile'] = reset($value);
        } else {
            $this->attributes['banner_mobile'] = $value;
        }
    }

    // Mutator untuk photo - handle array dari Filament
    public function setPhotoAttribute($value)
    {
        if (is_array($value) && !empty($value)) {
            $this->attributes['photo'] = reset($value);
        } else {
            $this->attributes['photo'] = $value;
        }
    }
} 