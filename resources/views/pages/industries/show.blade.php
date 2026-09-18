<x-layout
    :title="$industry['title']"
    :description="$industry['short']"
>
    <x-breadcrumb :items="[
        ['label' => __('site.pages.industries.title'), 'url' => route('industries.index')],
        ['label' => $industry['title']],
    ]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ __('site.pages.detail.industry') }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ $industry['hero'] }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">{{ $industry['short'] }}</p>
            <a href="{{ route('contact') }}" class="btn-primary mt-6">{{ __('site.pages.detail.contact') }}</a>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading title="Common challenges" />
            <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($industry['problems'] as $problem)
                    <li class="rounded-xl border border-navy/10 p-5 text-sm text-muted">{{ $problem }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading title="How we help" />
            <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($industry['solutions'] as $solution)
                    <li class="flex items-start gap-3 rounded-xl bg-white p-5 text-sm text-charcoal">
                        <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-accent"></span>
                        {{ $solution }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading title="Example systems we can build" />
            <div class="mt-8 grid gap-6 sm:grid-cols-3">
                @foreach ($industry['examples'] as $example)
                    <div class="card-outline p-6 text-sm font-medium text-navy">{{ $example }}</div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading title="Benefits for your organization" />
            <ul class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach ($industry['benefits'] as $benefit)
                    <li class="flex items-start gap-3 text-sm text-charcoal sm:text-base">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M4 10.5l4 4 8-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        {{ $benefit }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading title="Other industries" />
            <div class="mt-8 grid gap-6 sm:grid-cols-3">
                @foreach (collect($allIndustries)->except($slug)->take(3) as $otherSlug => $otherItem)
                    <a href="{{ route('industries.show', $otherSlug) }}" class="card-outline flex flex-col p-6">
                        <span class="text-sm font-semibold text-navy">{{ $otherItem['title'] }}</span>
                        <span class="mt-2 text-sm text-muted">{{ $otherItem['short'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section title="Let's talk about {{ $industry['title'] }}" description="Tell us about your challenge and discover how technology can help your organization grow." />
</x-layout>
