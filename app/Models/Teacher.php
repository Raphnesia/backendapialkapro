<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'photo',
        'bio',
        'position',
        'education',
        'experience',
        'type',
        'order_index',
        'is_active',
        'guruData',
        'banner_desktop',
        'banner_mobile',
    ];

    protected $casts = [
        'order_index' => 'integer',
        'is_active' => 'boolean',
        'guruData' => 'array',
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

    public function scopeTeachers($query)
    {
        return $query->where('type', 'teacher');
    }

    public function scopeStaff($query)
    {
        return $query->where('type', 'staff');
    }

    // Mutator untuk handle FileUpload dari Filament
    public function setGuruDataAttribute($value)
    {
        $this->attributes['guruData'] = json_encode($value);
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
}