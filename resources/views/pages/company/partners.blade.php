<x-layout
    :title="__('site.pages.company.partners_title')"
    :description="__('site.pages.company.partners_description')"
>
    <x-breadcrumb :items="[['label' => __('site.nav.company'), 'url' => route('company.about')], ['label' => __('site.pages.company.partners_title')]]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ __('site.pages.company.partners_title') }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ __('site.pages.company.partners_heading') }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                {{ __('site.pages.company.partners_intro') }}
            </p>
        </div>
    </section>

    <section class="section-py space-y-12">
        <div class="container-nexora space-y-12">
            @foreach ($partnerGroups as $group => $partners)
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-muted">{{ $group }}</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-3">
                        @foreach ($partners as $partner)
                            <div class="flex items-center justify-center rounded-xl border border-navy/10 bg-surface py-8 text-sm font-semibold text-navy/60">
                                {{ $partner }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <x-cta-section title="Have a platform in mind?" description="Tell us which systems you're already using and we'll help you get the most out of them." />
</x-layout>
