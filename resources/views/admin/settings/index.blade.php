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

<!-- Google Calendar Integration -->
<div class="max-w-3xl mt-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold mb-4">Google Calendar Entegrasyonu</h3>
        <p class="text-sm text-gray-500 mb-4">
            Google Calendar'ı bağlayarak teklif taleplerindeki toplantı taleplerini otomatik olarak takviminize ekleyebilirsiniz.
        </p>
        
        @php
            $isConnected = \App\Models\GoogleToken::where('user_id', auth()->id())->exists();
        @endphp
        
        @if($isConnected)
        <div class="flex items-center justify-between p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span class="text-green-700 dark:text-green-400">Google Calendar bağlı</span>
            </div>
            <a href="{{ route('admin.calendar.disconnect') }}" class="text-sm text-red-600 hover:underline" data-testid="disconnect-calendar">
                Bağlantıyı Kes
            </a>
        </div>
        @else
        <a href="{{ route('admin.calendar.connect') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-testid="connect-calendar">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/>
            </svg>
            Google Calendar'a Bağlan
        </a>
        @endif
    </div>
</div>

<!-- Image Upload -->
<div class="max-w-3xl mt-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold mb-4">Görsel Yükleme</h3>
        
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center" id="upload-area">
            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500 mb-4">Görsel yüklemek için tıklayın veya sürükleyin</p>
            <input type="file" id="file-input" class="hidden" accept="image/*" data-testid="file-input">
            <button type="button" onclick="document.getElementById('file-input').click()" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors" data-testid="upload-btn">
                Dosya Seç
            </button>
        </div>
        
        <div id="upload-result" class="mt-4 hidden">
            <p class="text-sm text-gray-500 mb-2">Yüklenen görsel URL'si:</p>
            <div class="flex items-center gap-2">
                <input type="text" id="uploaded-url" readonly class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700">
                <button type="button" onclick="copyUrl()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" data-testid="copy-url">
                    Kopyala
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('file-input').addEventListener('change', async function(e) {
    const file = e.target.files[0];
    if (!file) return;
    
    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', '{{ csrf_token() }}');
    
    try {
        const response = await fetch('{{ route("admin.upload") }}', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('uploaded-url').value = data.url;
            document.getElementById('upload-result').classList.remove('hidden');
        } else {
            alert('Yükleme başarısız: ' + (data.message || 'Bilinmeyen hata'));
        }
    } catch (error) {
        alert('Yükleme sırasında bir hata oluştu');
    }
});

function copyUrl() {
    const input = document.getElementById('uploaded-url');
    input.select();
    document.execCommand('copy');
    alert('URL kopyalandı!');
}
</script>
@endsection
