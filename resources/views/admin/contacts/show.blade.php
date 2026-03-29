@extends('layouts.admin')

@section('header', 'Mesaj Detayı')

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 mb-6">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Mesajlara Dön
    </a>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold">{{ $contact->name }}</h2>
                <p class="text-gray-500">{{ $contact->email }}</p>
            </div>
            <form action="{{ route('admin.contacts.status', $contact) }}" method="POST" class="flex items-center gap-2">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()" class="px-3 py-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm">
                    <option value="new" {{ $contact->status === 'new' ? 'selected' : '' }}>Yeni</option>
                    <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Okundu</option>
                    <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Yanıtlandı</option>
                    <option value="archived" {{ $contact->status === 'archived' ? 'selected' : '' }}>Arşivlendi</option>
                </select>
            </form>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
            @if($contact->phone)
            <div>
                <span class="text-gray-500">Telefon:</span>
                <span class="ml-2">{{ $contact->phone }}</span>
            </div>
            @endif
            @if($contact->company)
            <div>
                <span class="text-gray-500">Firma:</span>
                <span class="ml-2">{{ $contact->company }}</span>
            </div>
            @endif
            <div>
                <span class="text-gray-500">Tarih:</span>
                <span class="ml-2">{{ $contact->created_at->format('d.m.Y H:i') }}</span>
            </div>
        </div>
        
        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
            <h3 class="font-medium mb-2">{{ $contact->subject }}</h3>
            <p class="text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $contact->message }}</p>
        </div>
    </div>
    
    <div class="flex gap-4">
        <a href="mailto:{{ $contact->email }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            E-posta Gönder
        </a>
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                Sil
            </button>
        </form>
    </div>
</div>
@endsection
