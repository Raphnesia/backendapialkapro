<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavbarItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'href',
        'target',
        'order_index',
        'is_active',
        'parent_id',
    ];

    protected $casts = [
        'order_index' => 'integer',
        'is_active' => 'boolean',
        'parent_id' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order_index')->orderBy('id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index')->orderBy('id');
    }
} 