<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'features', 'icon', 'image', 'order', 'is_active'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getTitle($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->title[$locale] ?? $this->title['tr'] ?? '';
    }

    public function getDescription($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->description[$locale] ?? $this->description['tr'] ?? '';
    }
}
