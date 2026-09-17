@php
    $solutions = \App\Support\SiteContent::solutions();
    $services = \App\Support\SiteContent::services();
    $industries = \App\Support\SiteContent::industries();

    $businessSolutions = collect($solutions)->filter(fn ($item) => $item['group'] === 'Business Solutions');
    $techSolutions = collect($solutions)->filter(fn ($item) => $item['group'] === 'Technology Solutions');
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
                    Solutions
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div data-mega-menu-panel class="absolute left-1/2 top-full hidden w-[640px] -translate-x-1/2 pt-3 opacity-0 transition-all duration-150">
                    <div class="rounded-xl border border-navy/10 bg-white p-6 shadow-xl">
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-muted">Business Solutions</p>
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
                                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-muted">Technology Solutions</p>
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
                            <a href="{{ route('solutions.index') }}" class="text-sm font-semibold text-navy hover:text-accent">View all solutions &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Services mega menu --}}
            <div class="relative" data-mega-menu-item>
                <button type="button" data-mega-menu-trigger aria-expanded="false"
                    class="flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-navy hover:text-accent">
                    Services
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div data-mega-menu-panel class="absolute left-1/2 top-full hidden w-[640px] -translate-x-1/2 pt-3 opacity-0 transition-all duration-150">
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
                            <a href="{{ route('services.index') }}" class="text-sm font-semibold text-navy hover:text-accent">View all services &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Industries mega menu --}}
            <div class="relative" data-mega-menu-item>
                <button type="button" data-mega-menu-trigger aria-expanded="false"
                    class="flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-navy hover:text-accent">
                    Industries
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div data-mega-menu-panel class="absolute left-1/2 top-full hidden w-[520px] -translate-x-1/2 pt-3 opacity-0 transition-all duration-150">
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
                            <a href="{{ route('industries.index') }}" class="text-sm font-semibold text-navy hover:text-accent">View all industries &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('insights.index') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-navy hover:text-accent">Insights</a>

            {{-- Company dropdown --}}
            <div class="relative" data-mega-menu-item>
                <button type="button" data-mega-menu-trigger aria-expanded="false"
                    class="flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-navy hover:text-accent">
                    Company
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div data-mega-menu-panel class="absolute left-1/2 top-full hidden w-56 -translate-x-1/2 pt-3 opacity-0 transition-all duration-150">
                    <div class="rounded-xl border border-navy/10 bg-white p-2 shadow-xl">
                        <a href="{{ route('company.about') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">About Us</a>
                        <a href="{{ route('company.approach') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">Our Approach</a>
                        <a href="{{ route('company.team') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">Our Team</a>
                        <a href="{{ route('company.careers') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">Careers</a>
                        <a href="{{ route('company.partners') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-navy hover:bg-surface hover:text-accent">Partners</a>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Right side: language + CTA + mobile toggle --}}
        <div class="flex items-center gap-3">
            <div class="hidden items-center gap-1 text-xs font-semibold text-muted sm:flex" aria-label="Language selector">
                <button type="button" class="rounded px-1.5 py-1 text-navy">ID</button>
                <span aria-hidden="true">/</span>
                <button type="button" class="rounded px-1.5 py-1 hover:text-navy">EN</button>
            </div>

            <a href="{{ route('contact') }}" class="btn-accent hidden lg:inline-flex">Contact Us</a>

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
                    Solutions
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
                    Services
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
                    Industries
                    <svg data-accordion-icon class="h-4 w-4 transition-transform" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="hidden space-y-1 pb-2 pl-2">
                    @foreach ($industries as $slug => $item)
                        <a href="{{ route('industries.show', $slug) }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('insights.index') }}" class="block rounded-lg px-2 py-3 text-sm font-semibold text-navy">Insights</a>

            <div>
                <button type="button" data-accordion-trigger aria-expanded="false" class="flex w-full items-center justify-between rounded-lg px-2 py-3 text-left text-sm font-semibold text-navy">
                    Company
                    <svg data-accordion-icon class="h-4 w-4 transition-transform" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="hidden space-y-1 pb-2 pl-2">
                    <a href="{{ route('company.about') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">About Us</a>
                    <a href="{{ route('company.approach') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">Our Approach</a>
                    <a href="{{ route('company.team') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">Our Team</a>
                    <a href="{{ route('company.careers') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">Careers</a>
                    <a href="{{ route('company.partners') }}" class="block rounded-lg px-2 py-2 text-sm text-muted hover:text-navy">Partners</a>
                </div>
            </div>

            <a href="{{ route('contact') }}" class="btn-accent mt-3 w-full">Contact Us</a>
        </div>
    </div>
</header>
