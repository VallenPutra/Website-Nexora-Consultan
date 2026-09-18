<x-layout
    :title="__('site.pages.company.about_title')"
    :description="__('site.pages.company.about_description')"
>
    <x-breadcrumb :items="[['label' => __('site.nav.company'), 'url' => route('company.about')], ['label' => __('site.pages.company.about_title')]]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ __('site.pages.company.about_eyebrow') }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ __('site.pages.company.about_heading') }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                {{ __('site.pages.company.about_intro') }}
            </p>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora grid gap-8 sm:grid-cols-3">
            <div class="rounded-xl border border-navy/10 p-6">
                <p class="text-sm font-semibold text-accent">{{ __('site.pages.company.vision') }}</p>
                <p class="mt-2 text-sm text-muted">{{ __('site.pages.company.vision_text') }}</p>
            </div>
            <div class="rounded-xl border border-navy/10 p-6">
                <p class="text-sm font-semibold text-accent">{{ __('site.pages.company.mission') }}</p>
                <p class="mt-2 text-sm text-muted">{{ __('site.pages.company.mission_text') }}</p>
            </div>
            <div class="rounded-xl border border-navy/10 p-6">
                <p class="text-sm font-semibold text-accent">{{ __('site.pages.company.values') }}</p>
                <p class="mt-2 text-sm text-muted">{{ __('site.pages.company.values_text') }}</p>
            </div>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading :eyebrow="__('site.pages.company.why_eyebrow')" :title="__('site.pages.company.why_heading')" />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (__('site.pages.company.strengths') as $strength)
                    <div class="rounded-xl bg-white p-6">
                        <p class="text-sm font-semibold text-navy">{{ $strength['title'] }}</p>
                        <p class="mt-2 text-sm text-muted">{{ $strength['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
