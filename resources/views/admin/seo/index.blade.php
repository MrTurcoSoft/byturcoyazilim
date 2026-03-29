@extends('layouts.admin')

@section('header', 'SEO Ayarları')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sayfa</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Meta Title (TR)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($pages as $key => $name)
            @php $seo = $seoSettings->get($key); @endphp
            <tr data-testid="seo-row-{{ $key }}">
                <td class="px-6 py-4 font-medium">{{ $name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">
                    {{ $seo ? ($seo->meta_title['tr'] ?? '-') : '-' }}
                </td>
                <td class="px-6 py-4">
                    @if($seo && ($seo->meta_title['tr'] ?? null))
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600">Ayarlandı</span>
                    @else
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600">Ayarlanmadı</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.seo.edit', $key) }}" class="text-blue-600 hover:underline" data-testid="edit-seo-{{ $key }}">Düzenle</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
    <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-300 mb-2">SEO İpuçları</h3>
    <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-1">
        <li>• Meta başlık 50-60 karakter arasında olmalıdır</li>
        <li>• Meta açıklama 150-160 karakter arasında olmalıdır</li>
        <li>• Anahtar kelimeleri virgülle ayırın</li>
        <li>• Her sayfa için benzersiz meta bilgileri kullanın</li>
    </ul>
</div>
@endsection
