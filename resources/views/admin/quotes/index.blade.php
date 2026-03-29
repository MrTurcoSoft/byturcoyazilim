@extends('layouts.admin')

@section('header', 'Teklif Talepleri')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Müşteri</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proje Türü</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($quotes as $quote)
            <tr>
                <td class="px-6 py-4">
                    <div class="font-medium">{{ $quote->name }}</div>
                    <div class="text-sm text-gray-500">{{ $quote->email }}</div>
                </td>
                <td class="px-6 py-4">
                    {{ $quote->project_type }}
                    @if($quote->wants_meeting)
                    <span class="ml-2 inline-flex items-center px-2 py-0.5 text-xs rounded bg-green-100 text-green-700">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
                        Meet
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @php
                    $statusColors = [
                        'pending' => 'bg-orange-100 text-orange-600',
                        'reviewing' => 'bg-blue-100 text-blue-600',
                        'quoted' => 'bg-purple-100 text-purple-600',
                        'accepted' => 'bg-green-100 text-green-600',
                        'rejected' => 'bg-red-100 text-red-600',
                    ];
                    @endphp
                    <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$quote->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $quote->status }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $quote->created_at->format('d.m.Y H:i') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.quotes.show', $quote) }}" class="text-blue-600 hover:underline">Görüntüle</a>
                    <form action="{{ route('admin.quotes.destroy', $quote) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-500">Henüz teklif talebi yok</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($quotes->hasPages())
<div class="mt-6">
    {{ $quotes->links() }}
</div>
@endif
@endsection
