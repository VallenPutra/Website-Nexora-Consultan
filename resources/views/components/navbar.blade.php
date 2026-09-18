@php
    $solutions = \App\Support\SiteContent::solutions();
    $services = \App\Support\SiteContent::services();
    $industries = \App\Support\SiteContent::industries();

    $businessSolutions = collect($solutions)->filter(fn ($item) => in_array($item['group'], ['Business Solutions', 'Solusi Bisnis'], true));
    $techSolutions = collect($solutions)->filter(fn ($item) => in_array($item['group'], ['Technology Solutions', 'Solusi Teknologi'], true));
@endphp

<header class="sticky top-0 z-50 border-b border-navy/10 bg-white/95 backdrop-blur">
    <div class="container-nexora flex h-20 items-center justify-between gap-6">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex flex-col leading-none">
            <span class="text-xl font-bold tracking-tight text-navy">NEXORA</span>
            <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-muted">IT Consulting</span>
        </a>

        {{-- Desktop menu --}}
        <nav class="hidden items-center gap-1 lg:flex" aria-label="Primary">
            {{-- Solutions mega menu --}}
            <div class="relative" data-mega-menu-item>
                <button type="button" data-mega-menu-trigger aria-expanded="false"
                    class="flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-navy hover:text-accent">
                    {{ __('site.nav.solutions') }}
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div data-mega-menu-panel class="absolute left-1/2 top-full hidden w-160 -translate-x-1/2 pt-3 opacity-0 transition-all duration-150">
                    <div class="rounded-xl border border-navy/10 bg-white p-6 shadow-xl">
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-muted">{{ __('site.nav.business_solutions') }}</p>
                                <ul class="space-y-3">
                                    @foreach ($businessSolutions as $slug => $item)
                                        <li>
                                            <a href="{{ route('solutions.show', $slug) }}" class="group block rounded-lg p-2 -m-2 hover:bg-surface">
                                                <span class="block text-sm font-semibold text-navy group-hover:text-accent">{{ $item['title'] }}</span>
                                                <span class="mt-0.5 block text-xs text-muted">{{ $item['short'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div>
                                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-muted">{{ __('site.nav.technology_solutions') }}</p>
                                <ul class="space-y-3">
                                    @foreach ($techSolutions as $slug => $item)
                                        <li>
                                            <a href="{{ route('solutions.show', $slug) }}" class="group block rounded-lg p-2 -m-2 hover:bg-surface">
                                                <span class="block text-sm font-semibold text-navy group-hover:text-accent">{{ $item['title'] }}</span>
                                                <span class="mt-0.5 block text-xs text-muted">{{ $item['short'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="mt-5 border-t border-navy/10 pt-4">
                            <a href="{{ route('solutions.index') }}" class="text-sm font-semibold text-navy hover:text-accent">{{ __('site.nav.view_all_solutions') }} &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Services mega menu --}}
            <div class="relative" data-mega-menu-item>
                <button type="button" data-mega-menu-trigger aria-expanded="false"
                    class="flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-navy hover:text-accent">
                    {{ __('site.nav.services') }}
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div data-mega-menu-panel class="absolute left-1/2 top-full hidden w-160 -translate-x-1/2 pt-3 opacity-0 transition-all duration-150">
                    <div class="rounded-xl border border-navy/10 bg-white p-6 shadow-xl">
                        <div class="grid grid-cols-2 gap-x-8 gap-y-3">
                            @foreach ($services as $slug => $item)
                                <a href="{{ route('services.show', $slug) }}" class="group block rounded-lg p-2 -m-2 hover:bg-surface">
                                    <span class="block text-sm font-semibold text-navy group-hover:text-accent">{{ $item['title'] }}</span>
                                    <span class="mt-0.5 block text-xs text-muted">{{ $item['short'] }}</span>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-5 border-t border-navy/10 pt-4">
                            <a href="{{ route('services.index') }}" class="text-sm font-semibold text-navy hover:text-accent">{{ __('site.nav.view_all_services') }} &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Industries mega menu --}}
            <div class="relative" data-mega-menu-item>
                <button type="button" data-mega-menu-trigger aria-expanded="false"
                    class="flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-navy hover:text-accent">
                    {{ __('site.nav.industries') }}
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div data-mega-menu-panel class="absolute left-1/2 top-full hidden w-130 -translate-x-1/2 pt-3 opacity-0 transition-all duration-150">
                    <div class="rounded-xl border border-navy/10 bg-white p-6 shadow-xl">
                        <div class="grid grid-cols-2 gap-x-8 gap-y-3">
                            @foreach ($industries as $slug => $item)
                                <a href="{{ route('industries.show', $slug) }}" class="group block rounded-lg p-2 -m-2 hover:bg-surface">
                                    <span class="block text-sm font-semibold text-navy group-hover:text-accent">{{ $item['title'] }}</span>
                                    <span class="mt-0.5 block text-xs text-muted">{{ $item['short'] }}</span>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-5 border-t border-navy/10 pt-4">
                            <a href="{{ route('industries.index') }}" class="text-sm font-semibold text-navy hover:text-accent">{{ __('site.nav.view_all_industries') }} &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('insights.index') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-navy hover:text-accent">{{ __('site.nav.insights') }}</a>

            {{-- Company dropdown --}}
            <div class="relative" data-mega-menu-item>
                <button type="button" data-mega-menu-trigger aria-expanded="false"
                    class="flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-navy hover:text-accent">
                    {{ __('site.nav.company') }}
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div data-mega-menu-panel class="absolute left-1/2 top-full hidden w-56 -translate-x-1/2 pt-3 opacity-0 transition-all duration-150">
                    <div class="rounded-xl border border-navy/10 bg-white p-2 shadow-xl">
                        <a href="{{ route('company.about') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">{{ __('site.nav.about') }}</a>
                        <a href="{{ route('company.approach') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">{{ __('site.nav.approach') }}</a>
                        <a href="{{ route('company.team') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">{{ __('site.nav.team') }}</a>
                        <a href="{{ route('company.careers') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">{{ __('site.nav.careers') }}</a>
                        <a href="{{ route('company.partners') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">{{ __('site.nav.partners') }}</a>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Right side: language + login + CTA + mobile toggle --}}
        <div class="flex items-center gap-3">
            <div class="hidden items-center gap-1 text-xs font-semibold sm:flex" aria-label="Language selector">
                <a href="{{ route('locale.switch', 'id') }}"
                    class="rounded px-1.5 py-1 {{ app()->getLocale() === 'id' ? 'text-navy' : 'text-muted hover:text-navy' }}"
                    aria-current="{{ app()->getLocale() === 'id' ? 'true' : 'false' }}">ID</a>
                <span aria-hidden="true" class="text-muted">/</span>
                <a href="{{ route('locale.switch', 'en') }}"
                    class="rounded px-1.5 py-1 {{ app()->getLocale() === 'en' ? 'text-navy' : 'text-muted hover:text-navy' }}"
                    aria-current="{{ app()->getLocale() === 'en' ? 'true' : 'false' }}">EN</a>
            </div>

            {{-- Login / profile --}}
            @auth
                <div class="relative hidden lg:block" data-mega-menu-item>
                    <button type="button" data-mega-menu-trigger aria-expanded="false"
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-navy text-xs font-semibold text-white hover:bg-accent hover:text-navy"
                        aria-label="{{ __('site.nav.dashboard') }}">
                        {{ collect(explode(' ', auth()->user()->name ?? 'U'))->map(fn ($n) => $n[0] ?? '')->take(2)->implode('') }}
                    </button>
                    <div data-mega-menu-panel class="absolute right-0 top-full hidden w-48 -translate-x-0 pt-3 opacity-0 transition-all duration-150">
                        <div class="rounded-xl border border-navy/10 bg-white p-2 shadow-xl">
                            <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">{{ __('site.nav.dashboard') }}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-navy hover:bg-surface hover:text-accent">{{ __('site.nav.logout') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hidden items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium text-navy hover:text-accent lg:inline-flex">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <circle cx="10" cy="6.5" r="3.25" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M3.5 17c1.2-3.5 4-5 6.5-5s5.3 1.5 6.5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                    {{ __('site.nav.login') }}
                </a>
            @endauth

            <a href="{{ route('contact') }}" class="btn-accent hidden lg:inline-flex">{{ __('site.nav.contact') }}</a>

            <button type="button" data-mobile-menu-toggle aria-expanded="false" aria-controls="mobile-menu-panel"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-navy/10 text-navy lg:hidden">
                <span class="sr-only">Open menu</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="M3 5h14M3 10h14M3 15h14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu panel --}}
    <div id="mobile-menu-panel" data-mobile-menu-panel class="hidden border-t border-navy/10 bg-white lg:hidden">
        <div class="container-nexora max-h-[75vh] space-y-1 overflow-y-auto py-4">

            <div>
                <button type="button" data-accordion-trigger aria-expanded="false" class="flex w-full items-center justify-between rounded-lg px-2 py-3 text-left text-sm font-semibold text-navy">
                    {{ __('site.nav.solutions') }}
                    <svg data-accordion-icon class="h-4 w-4 transition-transform" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="hidden space-y-1 pb-2 pl-2">
                    @foreach ($solutions as $slug => $item)
                        <a href="{{ route('solutions.show', $slug) }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </div>

            <div>
                <button type="button" data-accordion-trigger aria-expanded="false" class="flex w-full items-center justify-between rounded-lg px-2 py-3 text-left text-sm font-semibold text-navy">
                    {{ __('site.nav.services') }}
                    <svg data-accordion-icon class="h-4 w-4 transition-transform" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="hidden space-y-1 pb-2 pl-2">
                    @foreach ($services as $slug => $item)
                        <a href="{{ route('services.show', $slug) }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </div>

            <div>
                <button type="button" data-accordion-trigger aria-expanded="false" class="flex w-full items-center justify-between rounded-lg px-2 py-3 text-left text-sm font-semibold text-navy">
                    {{ __('site.nav.industries') }}
                    <svg data-accordion-icon class="h-4 w-4 transition-transform" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="hidden space-y-1 pb-2 pl-2">
                    @foreach ($industries as $slug => $item)
                        <a href="{{ route('industries.show', $slug) }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('insights.index') }}" class="block rounded-lg px-2 py-3 text-sm font-semibold text-navy">{{ __('site.nav.insights') }}</a>

            <div>
                <button type="button" data-accordion-trigger aria-expanded="false" class="flex w-full items-center justify-between rounded-lg px-2 py-3 text-left text-sm font-semibold text-navy">
                    {{ __('site.nav.company') }}
                    <svg data-accordion-icon class="h-4 w-4 transition-transform" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="hidden space-y-1 pb-2 pl-2">
                    <a href="{{ route('company.about') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">{{ __('site.nav.about') }}</a>
                    <a href="{{ route('company.approach') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">{{ __('site.nav.approach') }}</a>
                    <a href="{{ route('company.team') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">{{ __('site.nav.team') }}</a>
                    <a href="{{ route('company.careers') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">{{ __('site.nav.careers') }}</a>
                    <a href="{{ route('company.partners') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">{{ __('site.nav.partners') }}</a>
                </div>
            </div>

            {{-- Login / profile (mobile) --}}
            @auth
                <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-2 py-3 text-sm font-semibold text-navy">{{ __('site.nav.dashboard') }}</a>
                <form method="POST" action="{{ route('logout') }}" class="px-2">
                    @csrf
                    <button type="submit" class="block w-full py-1 text-left text-sm font-semibold text-navy">{{ __('site.nav.logout') }}</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="flex items-center gap-1.5 rounded-lg px-2 py-3 text-sm font-semibold text-navy">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <circle cx="10" cy="6.5" r="3.25" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M3.5 17c1.2-3.5 4-5 6.5-5s5.3 1.5 6.5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                    {{ __('site.nav.login') }}
                </a>
            @endauth

            {{-- Language switcher (mobile) --}}
            <div class="flex items-center gap-2 px-2 pt-2 text-sm font-semibold" aria-label="Language selector">
                <a href="{{ route('locale.switch', 'id') }}" class="rounded px-2 py-1 {{ app()->getLocale() === 'id' ? 'bg-navy text-white' : 'text-muted' }}">ID</a>
                <a href="{{ route('locale.switch', 'en') }}" class="rounded px-2 py-1 {{ app()->getLocale() === 'en' ? 'bg-navy text-white' : 'text-muted' }}">EN</a>
            </div>

            <a href="{{ route('contact') }}" class="btn-accent mt-3 w-full">{{ __('site.nav.contact') }}</a>
        </div>
    </div>
</header>
