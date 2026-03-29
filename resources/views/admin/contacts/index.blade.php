@extends('layouts.admin')

@section('header', 'Mesajlar')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gönderen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Konu</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($contacts as $contact)
            <tr class="{{ $contact->status === 'new' ? 'bg-blue-50 dark:bg-blue-900/10' : '' }}">
                <td class="px-6 py-4">
                    <div class="font-medium">{{ $contact->name }}</div>
                    <div class="text-sm text-gray-500">{{ $contact->email }}</div>
                </td>
                <td class="px-6 py-4">{{ $contact->subject }}</td>
                <td class="px-6 py-4">
                    @php
                    $statusColors = [
                        'new' => 'bg-blue-100 text-blue-600',
                        'read' => 'bg-gray-100 text-gray-600',
                        'replied' => 'bg-green-100 text-green-600',
                        'archived' => 'bg-yellow-100 text-yellow-600',
                    ];
                    @endphp
                    <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$contact->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $contact->status }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $contact->created_at->format('d.m.Y H:i') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600 hover:underline">Görüntüle</a>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-500">Henüz mesaj yok</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($contacts->hasPages())
<div class="mt-6">
    {{ $contacts->links() }}
</div>
@endif
@endsection
