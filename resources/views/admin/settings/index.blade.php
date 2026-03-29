@extends('layouts.admin')

@section('header', 'Site Ayarları')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" data-testid="settings-form">
    @csrf
    
    <div class="max-w-3xl space-y-6">
        <!-- General Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4">Genel Ayarlar</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Site Adı</label>
                    <input type="text" name="settings[site_name]" value="{{ \App\Models\Setting::get('site_name', 'DigiAgency') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           data-testid="setting-site-name">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Varsayılan Tema</label>
                    <select name="settings[theme_mode]"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            data-testid="setting-theme">
                        <option value="dark" {{ \App\Models\Setting::get('theme_mode', 'dark') === 'dark' ? 'selected' : '' }}>Koyu</option>
                        <option value="light" {{ \App\Models\Setting::get('theme_mode', 'dark') === 'light' ? 'selected' : '' }}>Açık</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-4">
                <label class="block text-sm font-medium mb-2">Site Açıklaması</label>
                <textarea name="settings[site_description]" rows="2"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          data-testid="setting-description">{{ \App\Models\Setting::get('site_description', 'Profesyonel web tasarım ve yazılım çözümleri') }}</textarea>
            </div>
        </div>
        
        <!-- Contact Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4">İletişim Bilgileri</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Telefon</label>
                    <input type="text" name="settings[contact_phone]" value="{{ \App\Models\Setting::get('contact_phone') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">E-posta</label>
                    <input type="email" name="settings[contact_email]" value="{{ \App\Models\Setting::get('contact_email') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div class="mt-4">
                <label class="block text-sm font-medium mb-2">Adres</label>
                <textarea name="settings[contact_address]" rows="2"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ \App\Models\Setting::get('contact_address') }}</textarea>
            </div>
        </div>
        
        <!-- Social Media -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4">Sosyal Medya</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Facebook</label>
                    <input type="url" name="settings[social_facebook]" value="{{ \App\Models\Setting::get('social_facebook') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Instagram</label>
                    <input type="url" name="settings[social_instagram]" value="{{ \App\Models\Setting::get('social_instagram') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">LinkedIn</label>
                    <input type="url" name="settings[social_linkedin]" value="{{ \App\Models\Setting::get('social_linkedin') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Twitter</label>
                    <input type="url" name="settings[social_twitter]" value="{{ \App\Models\Setting::get('social_twitter') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>
        
        <!-- About Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4">Hakkımızda Sayfası</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Hakkımızda Metni</label>
                    <textarea name="settings[about_text]" rows="3"
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ \App\Models\Setting::get('about_text') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Vizyon</label>
                    <textarea name="settings[vision_text]" rows="2"
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ \App\Models\Setting::get('vision_text') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Misyon</label>
                    <textarea name="settings[mission_text]" rows="2"
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ \App\Models\Setting::get('mission_text') }}</textarea>
                </div>
            </div>
        </div>
        
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-testid="settings-submit">
            Ayarları Kaydet
        </button>
    </div>
</form>
@endsection
