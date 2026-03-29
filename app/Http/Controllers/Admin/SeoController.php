<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    protected array $pages = [
        'home' => 'Ana Sayfa',
        'about' => 'Hakkımızda',
        'services' => 'Hizmetler',
        'references' => 'Referanslar',
        'blog' => 'Blog',
        'contact' => 'İletişim',
        'quote' => 'Teklif Al',
    ];

    public function index()
    {
        $seoSettings = SeoSetting::all()->keyBy('page_identifier');
        $pages = $this->pages;
        
        return view('admin.seo.index', compact('seoSettings', 'pages'));
    }

    public function edit($page)
    {
        if (!array_key_exists($page, $this->pages)) {
            abort(404);
        }

        $seo = SeoSetting::firstOrCreate(
            ['page_identifier' => $page],
            [
                'meta_title' => ['tr' => '', 'en' => ''],
                'meta_description' => ['tr' => '', 'en' => ''],
                'meta_keywords' => ['tr' => '', 'en' => ''],
            ]
        );

        $pageName = $this->pages[$page];

        return view('admin.seo.edit', compact('seo', 'page', 'pageName'));
    }

    public function update(Request $request, $page)
    {
        $validated = $request->validate([
            'meta_title_tr' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_description_tr' => 'nullable|string|max:500',
            'meta_description_en' => 'nullable|string|max:500',
            'meta_keywords_tr' => 'nullable|string|max:500',
            'meta_keywords_en' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:255',
        ]);

        SeoSetting::updateOrCreate(
            ['page_identifier' => $page],
            [
                'meta_title' => ['tr' => $validated['meta_title_tr'] ?? '', 'en' => $validated['meta_title_en'] ?? ''],
                'meta_description' => ['tr' => $validated['meta_description_tr'] ?? '', 'en' => $validated['meta_description_en'] ?? ''],
                'meta_keywords' => ['tr' => $validated['meta_keywords_tr'] ?? '', 'en' => $validated['meta_keywords_en'] ?? ''],
                'og_image' => $validated['og_image'] ?? '',
            ]
        );

        return redirect()->route('admin.seo.index')->with('success', 'SEO ayarları güncellendi.');
    }
}
