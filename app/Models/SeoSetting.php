<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = ['page_identifier', 'meta_title', 'meta_description', 'meta_keywords', 'og_image'];

    protected $casts = [
        'meta_title' => 'array',
        'meta_description' => 'array',
        'meta_keywords' => 'array',
    ];

    public static function getForPage($identifier, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $seo = self::where('page_identifier', $identifier)->first();
        
        if (!$seo) {
            return [
                'title' => Setting::get('site_name', 'DigiAgency'),
                'description' => Setting::get('site_description', ''),
                'keywords' => '',
                'og_image' => '',
            ];
        }

        return [
            'title' => $seo->meta_title[$locale] ?? $seo->meta_title['tr'] ?? '',
            'description' => $seo->meta_description[$locale] ?? $seo->meta_description['tr'] ?? '',
            'keywords' => $seo->meta_keywords[$locale] ?? $seo->meta_keywords['tr'] ?? '',
            'og_image' => $seo->og_image ?? '',
        ];
    }
}
