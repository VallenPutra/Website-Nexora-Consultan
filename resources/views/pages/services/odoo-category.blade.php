<x-layout
    :title="$category['title'].' | '.$service['title']"
    :description="$category['description']"
>
    <x-breadcrumb :items="[
        ['label' => __('site.pages.services.title'), 'url' => route('services.index')],
        ['label' => $service['title'], 'url' => route('services.show', 'erp-odoo')],
        ['label' => $category['title']],
    ]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ $service['title'] }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ $category['title'] }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">{{ $category['description'] }}</p>
            <a href="{{ route('contact') }}" class="btn-primary mt-6">{{ __('site.pages.detail.contact') }}</a>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora grid gap-10 lg:grid-cols-2 lg:items-start">
            <div>
                <x-section-heading :title="$category['title']" :description="$category['detail']" />
            </div>
            <div class="rounded-xl border border-navy/10 bg-white p-6 sm:p-8">
                <h2 class="text-xl font-bold text-navy">{{ __('site.pages.detail.features') }}</h2>
                <ul class="mt-5 grid gap-3">
                    @foreach ($category['modules'] as $module)
                        <li class="flex items-center gap-3 text-sm text-charcoal sm:text-base">
                            <span class="h-2 w-2 shrink-0 rounded-full bg-accent"></span>
                            {{ $module }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora flex flex-wrap items-center justify-between gap-5">
            <div>
                <h2 class="text-xl font-bold text-navy">{{ $service['title'] }}</h2>
                <p class="mt-2 text-sm text-muted">{{ $service['odoo']['description'] }}</p>
            </div>
            <a href="{{ route('services.show', 'erp-odoo') }}" class="btn-secondary">{{ __('site.pages.services.explore') }} &larr;</a>
        </div>
    </section>
</x-layout>
