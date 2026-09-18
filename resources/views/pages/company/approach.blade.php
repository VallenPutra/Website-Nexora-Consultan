<x-layout
    :title="__('site.pages.company.approach_title')"
    :description="__('site.pages.company.approach_description')"
>
    <x-breadcrumb :items="[['label' => __('site.nav.company'), 'url' => route('company.about')], ['label' => __('site.pages.company.approach_title')]]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ __('site.pages.company.approach_title') }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ __('site.pages.company.approach_heading') }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                {{ __('site.pages.company.approach_intro') }}
            </p>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora">
            <div class="grid gap-6 lg:grid-cols-3">
                @foreach (__('site.pages.company.steps') as $index => $item)
                    <div class="rounded-xl border border-navy/10 p-6">
                        <span class="text-sm font-semibold text-accent">{{ sprintf('%02d', $index + 1) }}</span>
                        <p class="mt-2 text-base font-semibold text-navy">{{ $item['step'] }}</p>
                        <p class="mt-2 text-sm text-muted">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
