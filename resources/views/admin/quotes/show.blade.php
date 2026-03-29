@extends('layouts.admin')

@section('header', 'Teklif Detayı')

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('admin.quotes.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 mb-6">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Tekliflere Dön
    </a>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-6">Müşteri Bilgileri</h2>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Ad Soyad:</span>
                        <p class="font-medium">{{ $quote->name }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">E-posta:</span>
                        <p class="font-medium">{{ $quote->email }}</p>
                    </div>
                    @if($quote->phone)
                    <div>
                        <span class="text-gray-500">Telefon:</span>
                        <p class="font-medium">{{ $quote->phone }}</p>
                    </div>
                    @endif
                    @if($quote->company)
                    <div>
                        <span class="text-gray-500">Firma:</span>
                        <p class="font-medium">{{ $quote->company }}</p>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-semibold mb-6">Proje Detayları</h2>
                
                <div class="space-y-4 text-sm">
                    <div>
                        <span class="text-gray-500">Proje Türü:</span>
                        <p class="font-medium">{{ $quote->project_type }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Açıklama:</span>
                        <p class="mt-1 text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $quote->project_description }}</p>
                    </div>
                    @if($quote->budget_range)
                    <div>
                        <span class="text-gray-500">Bütçe Aralığı:</span>
                        <p class="font-medium">{{ $quote->budget_range }}</p>
                    </div>
                    @endif
                    @if($quote->timeline)
                    <div>
                        <span class="text-gray-500">Süre:</span>
                        <p class="font-medium">{{ $quote->timeline }}</p>
                    </div>
                    @endif
                    @if($quote->preferred_date)
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <span class="text-gray-500">Tercih Edilen Toplantı:</span>
                        <p class="font-medium text-blue-700 dark:text-blue-300">
                            {{ $quote->preferred_date->format('d.m.Y') }} {{ $quote->preferred_time }}
                        </p>
                        
                        @if($calendarConnected)
                            @if($quote->calendar_event_id)
                            <div class="mt-3 flex items-center gap-2">
                                <span class="text-xs text-green-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Takvime eklendi
                                </span>
                                <form action="{{ route('admin.quotes.calendar.remove', $quote) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 hover:underline">Kaldır</button>
                                </form>
                            </div>
                            @else
                            <form action="{{ route('admin.quotes.calendar.add', $quote) }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700" data-testid="add-to-calendar">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                                    </svg>
                                    Takvime Ekle
                                </button>
                            </form>
                            @endif
                        @else
                        <p class="mt-2 text-xs text-gray-500">
                            Takvime eklemek için <a href="{{ route('admin.settings.index') }}" class="text-blue-600 hover:underline">Google Calendar'ı bağlayın</a>
                        </p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div>
            <form action="{{ route('admin.quotes.update', $quote) }}" method="POST" class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                @csrf
                @method('PATCH')
                
                <h2 class="text-lg font-semibold mb-4">Teklif Yönetimi</h2>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Durum</label>
                    <select name="status" class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700">
                        <option value="pending" {{ $quote->status === 'pending' ? 'selected' : '' }}>Beklemede</option>
                        <option value="reviewing" {{ $quote->status === 'reviewing' ? 'selected' : '' }}>İnceleniyor</option>
                        <option value="quoted" {{ $quote->status === 'quoted' ? 'selected' : '' }}>Teklif Verildi</option>
                        <option value="accepted" {{ $quote->status === 'accepted' ? 'selected' : '' }}>Kabul Edildi</option>
                        <option value="rejected" {{ $quote->status === 'rejected' ? 'selected' : '' }}>Reddedildi</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Teklif Tutarı (TL)</label>
                    <input type="number" name="quoted_amount" step="0.01" value="{{ $quote->quoted_amount }}"
                           class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Notlar</label>
                    <textarea name="admin_notes" rows="4"
                              class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700">{{ $quote->admin_notes }}</textarea>
                </div>
                
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Güncelle
                </button>
            </form>
            
            <div class="mt-4 flex gap-2">
                <a href="mailto:{{ $quote->email }}" class="flex-1 px-4 py-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700 transition-colors">
                    E-posta Gönder
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
