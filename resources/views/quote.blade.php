@extends('layouts.app')

@section('title', __('messages.quote_title') . ' - ' . \App\Models\Setting::get('site_name', 'Dijital Ajans'))

@section('content')
<!-- Hero Section -->
<section class="relative py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.start_project') }}</p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tighter mb-6" data-testid="quote-title">
                {{ __('messages.quote_title') }}
            </h1>
            <p class="text-lg text-[var(--muted-foreground)] max-w-2xl mx-auto">
                {{ __('messages.quote_description') }}
            </p>
        </div>
    </div>
</section>

<!-- Quote Form -->
<section class="py-20 lg:py-32">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="p-8 lg:p-12 bg-[var(--card)] border border-[var(--border)] rounded-lg">
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg text-green-600 dark:text-green-400" data-testid="success-message">
                {{ session('success') }}
            </div>
            @endif
            
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg text-red-600 dark:text-red-400">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ route('quote.submit') }}" method="POST" data-testid="quote-form">
                @csrf
                
                <!-- Personal Info -->
                <h3 class="text-lg font-semibold mb-6">Kişisel Bilgiler</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium mb-2">{{ __('messages.name') }} *</label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}"
                               class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                               data-testid="quote-name">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-2">{{ __('messages.email') }} *</label>
                        <input type="email" id="email" name="email" required value="{{ old('email') }}"
                               class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                               data-testid="quote-email">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="phone" class="block text-sm font-medium mb-2">{{ __('messages.phone') }}</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                               class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                               data-testid="quote-phone">
                    </div>
                    <div>
                        <label for="company" class="block text-sm font-medium mb-2">{{ __('messages.company') }}</label>
                        <input type="text" id="company" name="company" value="{{ old('company') }}"
                               class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                               data-testid="quote-company">
                    </div>
                </div>
                
                <!-- Project Info -->
                <h3 class="text-lg font-semibold mb-6 pt-6 border-t border-[var(--border)]">Proje Bilgileri</h3>
                
                <div class="mb-6">
                    <label for="project_type" class="block text-sm font-medium mb-2">{{ __('messages.project_type') }} *</label>
                    <select id="project_type" name="project_type" required
                            class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                            data-testid="quote-project-type">
                        <option value="">Seçiniz</option>
                        <option value="web_design" {{ old('project_type') == 'web_design' ? 'selected' : '' }}>{{ __('messages.web_design') }}</option>
                        <option value="web_development" {{ old('project_type') == 'web_development' ? 'selected' : '' }}>{{ __('messages.web_development') }}</option>
                        <option value="ecommerce" {{ old('project_type') == 'ecommerce' ? 'selected' : '' }}>{{ __('messages.ecommerce') }}</option>
                        <option value="mobile_app" {{ old('project_type') == 'mobile_app' ? 'selected' : '' }}>{{ __('messages.mobile_app') }}</option>
                        <option value="seo" {{ old('project_type') == 'seo' ? 'selected' : '' }}>{{ __('messages.seo') }}</option>
                        <option value="digital_marketing" {{ old('project_type') == 'digital_marketing' ? 'selected' : '' }}>{{ __('messages.digital_marketing') }}</option>
                        <option value="other" {{ old('project_type') == 'other' ? 'selected' : '' }}>{{ __('messages.other') }}</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label for="project_description" class="block text-sm font-medium mb-2">{{ __('messages.project_description') }} *</label>
                    <textarea id="project_description" name="project_description" rows="5" required
                              class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] resize-none"
                              data-testid="quote-description">{{ old('project_description') }}</textarea>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="budget_range" class="block text-sm font-medium mb-2">{{ __('messages.budget_range') }}</label>
                        <select id="budget_range" name="budget_range"
                                class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                                data-testid="quote-budget">
                            <option value="">Seçiniz</option>
                            <option value="5k-10k" {{ old('budget_range') == '5k-10k' ? 'selected' : '' }}>{{ __('messages.budget_5k_10k') }}</option>
                            <option value="10k-25k" {{ old('budget_range') == '10k-25k' ? 'selected' : '' }}>{{ __('messages.budget_10k_25k') }}</option>
                            <option value="25k-50k" {{ old('budget_range') == '25k-50k' ? 'selected' : '' }}>{{ __('messages.budget_25k_50k') }}</option>
                            <option value="50k-100k" {{ old('budget_range') == '50k-100k' ? 'selected' : '' }}>{{ __('messages.budget_50k_100k') }}</option>
                            <option value="100k+" {{ old('budget_range') == '100k+' ? 'selected' : '' }}>{{ __('messages.budget_100k_plus') }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="timeline" class="block text-sm font-medium mb-2">{{ __('messages.timeline') }}</label>
                        <select id="timeline" name="timeline"
                                class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                                data-testid="quote-timeline">
                            <option value="">Seçiniz</option>
                            <option value="1_month" {{ old('timeline') == '1_month' ? 'selected' : '' }}>{{ __('messages.timeline_1_month') }}</option>
                            <option value="1_3_months" {{ old('timeline') == '1_3_months' ? 'selected' : '' }}>{{ __('messages.timeline_1_3_months') }}</option>
                            <option value="3_6_months" {{ old('timeline') == '3_6_months' ? 'selected' : '' }}>{{ __('messages.timeline_3_6_months') }}</option>
                            <option value="6_plus_months" {{ old('timeline') == '6_plus_months' ? 'selected' : '' }}>{{ __('messages.timeline_6_plus_months') }}</option>
                            <option value="flexible" {{ old('timeline') == 'flexible' ? 'selected' : '' }}>{{ __('messages.timeline_flexible') }}</option>
                        </select>
                    </div>
                </div>
                
                <!-- Meeting Preferences -->
                <h3 class="text-lg font-semibold mb-6 pt-6 border-t border-[var(--border)]">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[var(--primary)]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/>
                        </svg>
                        {{ __('messages.meeting_preferences') }}
                    </span>
                </h3>
                
                <!-- Google Meet Option -->
                <div class="mb-6 p-4 bg-[var(--secondary)] rounded-lg border border-[var(--border)]">
                    <label class="flex items-start cursor-pointer">
                        <input type="checkbox" name="wants_meeting" value="1" {{ old('wants_meeting') ? 'checked' : '' }}
                               class="w-5 h-5 mt-0.5 text-[var(--primary)] rounded border-[var(--border)] focus:ring-[var(--primary)]"
                               id="wants_meeting" data-testid="wants-meeting">
                        <div class="ml-3">
                            <span class="flex items-center font-medium">
                                <svg class="w-5 h-5 mr-2 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm5.82 16.32l-1.5-1.5c-.293-.293-.768-.293-1.06 0l-1.5 1.5c-.293.293-.293.768 0 1.06l1.5 1.5c.147.147.34.22.53.22s.384-.073.53-.22l1.5-1.5c.293-.293.293-.768 0-1.06zM15 10.5c0-.828-.672-1.5-1.5-1.5h-3c-.828 0-1.5.672-1.5 1.5v3c0 .828.672 1.5 1.5 1.5h3c.828 0 1.5-.672 1.5-1.5v-3z"/>
                                </svg>
                                {{ __('messages.want_google_meet') }}
                            </span>
                            <p class="text-sm text-[var(--muted-foreground)] mt-1">
                                {{ __('messages.google_meet_description') }}
                            </p>
                        </div>
                    </label>
                </div>
                
                <div id="meeting-fields" class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="preferred_date" class="block text-sm font-medium mb-2">{{ __('messages.preferred_date') }}</label>
                        <input type="date" id="preferred_date" name="preferred_date" value="{{ old('preferred_date') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                               data-testid="quote-date">
                    </div>
                    <div>
                        <label for="preferred_time" class="block text-sm font-medium mb-2">{{ __('messages.preferred_time') }}</label>
                        <select id="preferred_time" name="preferred_time"
                                class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                                data-testid="quote-time">
                            <option value="">Seçiniz</option>
                            <option value="10:00" {{ old('preferred_time') == '10:00' ? 'selected' : '' }}>10:00</option>
                            <option value="11:00" {{ old('preferred_time') == '11:00' ? 'selected' : '' }}>11:00</option>
                            <option value="12:00" {{ old('preferred_time') == '12:00' ? 'selected' : '' }}>12:00</option>
                            <option value="14:00" {{ old('preferred_time') == '14:00' ? 'selected' : '' }}>14:00</option>
                            <option value="15:00" {{ old('preferred_time') == '15:00' ? 'selected' : '' }}>15:00</option>
                            <option value="16:00" {{ old('preferred_time') == '16:00' ? 'selected' : '' }}>16:00</option>
                            <option value="17:00" {{ old('preferred_time') == '17:00' ? 'selected' : '' }}>17:00</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-8 p-4 bg-blue-500/10 border border-blue-500/20 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-blue-600 dark:text-blue-400">
                            {{ __('messages.meeting_info') }}
                        </p>
                    </div>
                </div>
                
                <button type="submit" class="w-full px-6 py-4 rounded-full bg-[var(--primary)] text-white font-medium hover:opacity-90 transition-opacity" data-testid="quote-submit">
                    {{ __('messages.submit_request') }}
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
