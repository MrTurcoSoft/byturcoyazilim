@extends('layouts.admin')

@section('header', isset($service) ? 'Hizmeti Düzenle' : 'Yeni Hizmet')

@section('content')
<div class="max-w-4xl">
    <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" data-testid="service-form">
        @csrf
        @if(isset($service))
        @method('PUT')
        @endif
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Türkçe İçerik</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Başlık (TR) *</label>
                <input type="text" name="title_tr" value="{{ old('title_tr', $service->title['tr'] ?? '') }}" required
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       data-testid="service-title-tr">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Açıklama (TR) *</label>
                <textarea name="description_tr" rows="4" required
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          data-testid="service-description-tr">{{ old('description_tr', $service->description['tr'] ?? '') }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Özellikler (TR) <span class="text-gray-500 text-xs">Her satıra bir özellik</span></label>
                <textarea name="features_tr" rows="4"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          data-testid="service-features-tr">{{ old('features_tr', implode("\n", $service->features['tr'] ?? [])) }}</textarea>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">English Content</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Title (EN)</label>
                <input type="text" name="title_en" value="{{ old('title_en', $service->title['en'] ?? '') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       data-testid="service-title-en">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Description (EN)</label>
                <textarea name="description_en" rows="4"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          data-testid="service-description-en">{{ old('description_en', $service->description['en'] ?? '') }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-2">Features (EN)</label>
                <textarea name="features_en" rows="4"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          data-testid="service-features-en">{{ old('features_en', implode("\n", $service->features['en'] ?? [])) }}</textarea>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Diğer Ayarlar</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Görsel URL</label>
                    <input type="text" name="image" value="{{ old('image', $service->image ?? '') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           data-testid="service-image">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Sıra</label>
                    <input type="number" name="order" value="{{ old('order', $service->order ?? 0) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           data-testid="service-order">
                </div>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 text-blue-600 rounded border-gray-300" id="is_active" data-testid="service-active">
                <label for="is_active" class="ml-2 text-sm">Aktif</label>
            </div>
        </div>
        
        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-testid="service-submit">
                {{ isset($service) ? 'Güncelle' : 'Oluştur' }}
            </button>
            <a href="{{ route('admin.services.index') }}" class="text-gray-500 hover:text-gray-700">İptal</a>
        </div>
    </form>
</div>
@endsection
