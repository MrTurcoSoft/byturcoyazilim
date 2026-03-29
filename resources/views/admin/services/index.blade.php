@extends('layouts.admin')

@section('header', 'Hizmetler')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500">Toplam {{ $services->count() }} hizmet</p>
    <a href="{{ route('admin.services.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-testid="add-service-btn">
        + Yeni Hizmet
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Başlık</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sıra</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($services as $service)
            <tr data-testid="service-row-{{ $service->id }}">
                <td class="px-6 py-4">
                    <div class="font-medium">{{ $service->title['tr'] ?? '-' }}</div>
                    <div class="text-sm text-gray-500">{{ $service->title['en'] ?? '-' }}</div>
                </td>
                <td class="px-6 py-4">{{ $service->order }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full {{ $service->is_active ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}">
                        {{ $service->is_active ? 'Aktif' : 'Pasif' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.services.edit', $service) }}" class="text-blue-600 hover:underline" data-testid="edit-service-{{ $service->id }}">Düzenle</a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" data-testid="delete-service-{{ $service->id }}">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-500">Henüz hizmet eklenmemiş</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
