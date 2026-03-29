@extends('layouts.admin')

@section('header', 'Referanslar')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500">Toplam {{ $references->count() }} referans</p>
    <a href="{{ route('admin.references.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" data-testid="add-reference-btn">
        + Yeni Referans
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($references as $reference)
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden" data-testid="reference-card-{{ $reference->id }}">
        <div class="aspect-video">
            <img src="{{ $reference->image }}" alt="{{ $reference->title['tr'] ?? '' }}" class="w-full h-full object-cover">
        </div>
        <div class="p-4">
            <h3 class="font-semibold">{{ $reference->title['tr'] ?? '-' }}</h3>
            <p class="text-sm text-gray-500">{{ $reference->client_name }}</p>
            <div class="flex items-center justify-between mt-4">
                <span class="text-xs px-2 py-1 rounded-full {{ $reference->is_active ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}">
                    {{ $reference->is_active ? 'Aktif' : 'Pasif' }}
                </span>
                <div class="space-x-2">
                    <a href="{{ route('admin.references.edit', $reference) }}" class="text-sm text-blue-600 hover:underline">Düzenle</a>
                    <form action="{{ route('admin.references.destroy', $reference) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:underline">Sil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-500">Henüz referans eklenmemiş</div>
    @endforelse
</div>
@endsection
