<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'image', 'category', 'tags', 'user_id', 'is_published', 'published_at'];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'excerpt' => 'array',
        'content' => 'array',
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getTitle($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->title[$locale] ?? $this->title['tr'] ?? '';
    }

    public function getSlug($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->slug[$locale] ?? $this->slug['tr'] ?? '';
    }

    public function getExcerpt($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->excerpt[$locale] ?? $this->excerpt['tr'] ?? '';
    }

    public function getContent($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->content[$locale] ?? $this->content['tr'] ?? '';
    }
}
