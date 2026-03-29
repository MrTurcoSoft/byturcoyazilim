@extends('layouts.admin')

@section('header', isset($reference) ? 'Referansı Düzenle' : 'Yeni Referans')

@section('content')
<div class="max-w-4xl">
    <form action="{{ isset($reference) ? route('admin.references.update', $reference) : route('admin.references.store') }}" method="POST" data-testid="reference-form">
        @csrf
        @if(isset($reference))
        @method('PUT')
        @endif
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Proje Bilgileri</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Başlık (TR) *</label>
                    <input type="text" name="title_tr" value="{{ old('title_tr', $reference->title['tr'] ?? '') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Title (EN)</label>
                    <input type="text" name="title_en" value="{{ old('title_en', $reference->title['en'] ?? '') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Müşteri Adı *</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $reference->client_name ?? '') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $reference->category ?? '') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Görsel URL *</label>
                <input type="text" name="image" value="{{ old('image', $reference->image ?? '') }}" required
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Web Site URL</label>
                <input type="url" name="url" value="{{ old('url', $reference->url ?? '') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Açıklama (TR)</label>
                    <textarea name="description_tr" rows="3"
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description_tr', $reference->description['tr'] ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Description (EN)</label>
                    <textarea name="description_en" rows="3"
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description_en', $reference->description['en'] ?? '') }}</textarea>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Sıra</label>
                    <input type="number" name="order" value="{{ old('order', $reference->order ?? 0) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-center pt-8">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $reference->is_active ?? true) ? 'checked' : '' }}
                           class="w-4 h-4 text-blue-600 rounded border-gray-300" id="is_active">
                    <label for="is_active" class="ml-2 text-sm">Aktif</label>
                </div>
            </div>
        </div>
        
        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                {{ isset($reference) ? 'Güncelle' : 'Oluştur' }}
            </button>
            <a href="{{ route('admin.references.index') }}" class="text-gray-500 hover:text-gray-700">İptal</a>
        </div>
    </form>
</div>
@endsection
