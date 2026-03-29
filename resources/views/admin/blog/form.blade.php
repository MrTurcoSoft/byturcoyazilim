@extends('layouts.admin')

@section('header', isset($post) ? 'Yazıyı Düzenle' : 'Yeni Yazı')

@section('content')
<div class="max-w-4xl">
    <form action="{{ isset($post) ? route('admin.blog.update', $post) : route('admin.blog.store') }}" method="POST" data-testid="blog-form">
        @csrf
        @if(isset($post))
        @method('PUT')
        @endif
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Türkçe İçerik</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Başlık (TR) *</label>
                <input type="text" name="title_tr" value="{{ old('title_tr', $post->title['tr'] ?? '') }}" required
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Özet (TR)</label>
                <textarea name="excerpt_tr" rows="2"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('excerpt_tr', $post->excerpt['tr'] ?? '') }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">İçerik (TR) *</label>
                <textarea name="content_tr" rows="10" required
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content_tr', $post->content['tr'] ?? '') }}</textarea>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">English Content</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Title (EN)</label>
                <input type="text" name="title_en" value="{{ old('title_en', $post->title['en'] ?? '') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Excerpt (EN)</label>
                <textarea name="excerpt_en" rows="2"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('excerpt_en', $post->excerpt['en'] ?? '') }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Content (EN)</label>
                <textarea name="content_en" rows="10"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content_en', $post->content['en'] ?? '') }}</textarea>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Diğer Ayarlar</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Görsel URL</label>
                    <input type="text" name="image" value="{{ old('image', $post->image ?? '') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $post->category ?? '') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Etiketler <span class="text-gray-500 text-xs">virgülle ayırın</span></label>
                <input type="text" name="tags" value="{{ old('tags', is_array($post->tags ?? null) ? implode(', ', $post->tags) : '') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}
                       class="w-4 h-4 text-blue-600 rounded border-gray-300" id="is_published">
                <label for="is_published" class="ml-2 text-sm">Yayınla</label>
            </div>
        </div>
        
        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                {{ isset($post) ? 'Güncelle' : 'Oluştur' }}
            </button>
            <a href="{{ route('admin.blog.index') }}" class="text-gray-500 hover:text-gray-700">İptal</a>
        </div>
    </form>
</div>
@endsection
