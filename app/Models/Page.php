<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['slug', 'title', 'content', 'meta_title', 'meta_description', 'is_active'];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'is_active' => 'boolean',
    ];

    public function getTitle($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->title[$locale] ?? $this->title['tr'] ?? '';
    }

    public function getContent($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->content[$locale] ?? $this->content['tr'] ?? '';
    }
}
