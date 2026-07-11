@extends('layouts.app')

@section('content')
<section class="relative py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.privacy_policy') }}</p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tighter mb-6">
                {{ __('messages.privacy_policy_title') }}
            </h1>
            <p class="text-lg text-[var(--muted-foreground)] max-w-2xl mx-auto">
                {{ __('messages.privacy_policy_description') }}
            </p>
        </div>
    </div>
</section>

<section class="py-20 lg:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-10">
            <div>
                <h2 class="text-2xl font-semibold mb-3">{{ __('messages.privacy_information_title') }}</h2>
                <p class="text-[var(--muted-foreground)] leading-relaxed">{{ __('messages.privacy_information_text') }}</p>
            </div>
            <div>
                <h2 class="text-2xl font-semibold mb-3">{{ __('messages.privacy_usage_title') }}</h2>
                <p class="text-[var(--muted-foreground)] leading-relaxed">{{ __('messages.privacy_usage_text') }}</p>
            </div>
            <div>
                <h2 class="text-2xl font-semibold mb-3">{{ __('messages.privacy_security_title') }}</h2>
                <p class="text-[var(--muted-foreground)] leading-relaxed">{{ __('messages.privacy_security_text') }}</p>
            </div>
            <div>
                <h2 class="text-2xl font-semibold mb-3">{{ __('messages.privacy_contact_title') }}</h2>
                <p class="text-[var(--muted-foreground)] leading-relaxed">{{ __('messages.privacy_contact_text') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
