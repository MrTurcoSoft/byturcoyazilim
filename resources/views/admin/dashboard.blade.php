@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700" data-testid="stat-services">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Hizmetler</p>
                <p class="text-3xl font-bold mt-1">{{ $stats['services'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700" data-testid="stat-references">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Referanslar</p>
                <p class="text-3xl font-bold mt-1">{{ $stats['references'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700" data-testid="stat-contacts">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Yeni Mesajlar</p>
                <p class="text-3xl font-bold mt-1">{{ $stats['new_contacts'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700" data-testid="stat-quotes">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Bekleyen Teklifler</p>
                <p class="text-3xl font-bold mt-1">{{ $stats['pending_quotes'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Contacts -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Son Mesajlar</h2>
            <a href="{{ route('admin.contacts.index') }}" class="text-sm text-blue-600 hover:underline">Tümünü Gör</a>
        </div>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($recentContacts as $contact)
            <a href="{{ route('admin.contacts.show', $contact) }}" class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <div class="flex items-center justify-between mb-1">
                    <span class="font-medium">{{ $contact->name }}</span>
                    <span class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-sm text-gray-500 truncate">{{ $contact->subject }}</p>
            </a>
            @empty
            <div class="p-4 text-center text-gray-500">Henüz mesaj yok</div>
            @endforelse
        </div>
    </div>
    
    <!-- Recent Quotes -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Son Teklif Talepleri</h2>
            <a href="{{ route('admin.quotes.index') }}" class="text-sm text-blue-600 hover:underline">Tümünü Gör</a>
        </div>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($recentQuotes as $quote)
            <a href="{{ route('admin.quotes.show', $quote) }}" class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                <div class="flex items-center justify-between mb-1">
                    <span class="font-medium">{{ $quote->name }}</span>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $quote->status === 'pending' ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                        {{ $quote->status }}
                    </span>
                </div>
                <p class="text-sm text-gray-500">{{ $quote->project_type }}</p>
            </a>
            @empty
            <div class="p-4 text-center text-gray-500">Henüz teklif talebi yok</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
