@extends('layouts.admin')

@section('header', $pageName . ' - SEO Ayarları')

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.seo.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 mb-6">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        SEO Ayarlarına Dön
    </a>

    <form action="{{ route('admin.seo.update', $page) }}" method="POST" data-testid="seo-form">
        @csrf
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Türkçe</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Meta Başlık (TR)</label>
                <input type="text" name="meta_title_tr" value="{{ $seo->meta_title['tr'] ?? '' }}" maxlength="70"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       data-testid="seo-title-tr">
                <p class="text-xs text-gray-500 mt-1">Önerilen: 50-60 karakter</p>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Meta Açıklama (TR)</label>
                <textarea name="meta_description_tr" rows="3" maxlength="200"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          data-testid="seo-description-tr">{{ $seo->meta_description['tr'] ?? '' }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Önerilen: 150-160 karakter</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Anahtar Kelimeler (TR)</label>
                <input type="text" name="meta_keywords_tr" value="{{ $seo->meta_keywords['tr'] ?? '' }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="web tasarım, yazılım, dijital ajans"
                       data-testid="seo-keywords-tr">
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">English</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Meta Title (EN)</label>
                <input type="text" name="meta_title_en" value="{{ $seo->meta_title['en'] ?? '' }}" maxlength="70"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       data-testid="seo-title-en">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Meta Description (EN)</label>
                <textarea name="meta_description_en" rows="3" maxlength="200"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          data-testid="seo-description-en">{{ $seo->meta_description['en'] ?? '' }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Keywords (EN)</label>
                <input type="text" name="meta_keywords_en" value="{{ $seo->meta_keywords['en'] ?? '' }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="web design, software, digital agency"
                       data-testid="seo-keywords-en">
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Sosyal Medya</h3>
            
            <div>
                <label class="block text-sm font-medium mb-2">OG Image URL</label>
                <input type="text" name="og_image" value="{{ $seo->og_image ?? '' }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="https://example.com/image.jpg"
                       data-testid="seo-og-image">
                <p class="text-xs text-gray-500 mt-1">Sosyal medyada paylaşıldığında görünecek görsel (1200x630px önerilir)</p>
            </div>
        </div>
        
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-testid="seo-submit">
            Kaydet
        </button>
    </form>
</div>
@endsection
