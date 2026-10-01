<x-layout
    :title="$service['title']"
    :description="$service['short']"
>
    <x-breadcrumb :items="[
        ['label' => __('site.pages.services.title'), 'url' => route('services.index')],
        ['label' => $service['title']],
    ]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ __('site.pages.detail.service') }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ $service['hero'] }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">{{ $service['subheadline'] }}</p>
            <a href="{{ route('contact') }}" class="btn-primary mt-6">{{ __('site.pages.detail.contact') }}</a>
        </div>
    </section>

    @if (isset($service['odoo']))
        <section class="section-py bg-surface">
            <div class="container-nexora">
                <x-section-heading
                    :eyebrow="$service['odoo']['eyebrow']"
                    :title="$service['odoo']['heading']"
                    :description="$service['odoo']['description']"
                />
                <div class="mt-10 grid gap-5 sm:grid-cols-2">
                    @foreach ($service['odoo']['categories'] as $category)
                        <article id="{{ \Illuminate\Support\Str::slug($category['title']) }}" class="scroll-mt-28 rounded-xl border border-navy/10 bg-white p-6">
                            <h2 class="text-lg font-semibold text-navy">{{ $category['title'] }}</h2>
                            <p class="mt-2 text-sm leading-6 text-muted">{{ $category['description'] }}</p>
                            <ul class="mt-4 grid gap-2 sm:grid-cols-2">
                                @foreach ($category['modules'] as $module)
                                    <li class="flex items-center gap-2 text-sm text-charcoal">
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-accent"></span>
                                        {{ $module }}
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section-py">
        <div class="container-nexora grid gap-12 lg:grid-cols-2">
            <div>
                <h2 class="text-xl font-bold text-navy">{{ __('site.pages.detail.challenge') }}</h2>
                <div class="mt-4 space-y-4 text-sm text-muted sm:text-base">
                    @foreach ($service['problem'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
            </div>
            <div>
                <h2 class="text-xl font-bold text-navy">{{ __('site.pages.detail.approach') }}</h2>
                <div class="mt-4 space-y-4 text-sm text-muted sm:text-base">
                    @foreach ($service['solution'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading :title="__('site.pages.detail.features')" />
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach ($service['features'] as $feature)
                    <div class="flex items-start gap-3 rounded-xl border border-navy/10 bg-white p-5">
                        <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-accent"></span>
                        <span class="text-sm text-charcoal">{{ $feature }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading :title="__('site.pages.detail.process')" />
            <ol class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($service['process'] as $index => $step)
                    <li class="rounded-xl border border-navy/10 p-6">
                        <span class="text-sm font-semibold text-accent">{{ sprintf('%02d', $index + 1) }}</span>
                        <p class="mt-2 text-sm font-medium text-navy">{{ $step }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading :title="__('site.pages.detail.benefits')" />
            <ul class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach ($service['benefits'] as $benefit)
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
            <x-section-heading title="Other services" />
            <div class="mt-8 grid gap-6 sm:grid-cols-3">
                @foreach (collect($allServices)->except($slug)->take(3) as $otherSlug => $otherItem)
                    <a href="{{ route('services.show', $otherSlug) }}" class="card-outline flex flex-col p-6">
                        <span class="text-sm font-semibold text-navy">{{ $otherItem['title'] }}</span>
                        <span class="mt-2 text-sm text-muted">{{ $otherItem['short'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section title="Let's talk about {{ $service['title'] }}" description="Tell us about your challenge and we'll help you find the right path forward." />
</x-layout>
