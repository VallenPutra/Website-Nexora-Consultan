<x-layout
    :title="__('site.pages.solutions.title')"
    :description="__('site.pages.solutions.description')"
>
    <x-breadcrumb :items="[['label' => __('site.pages.solutions.title')]]" />

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                :eyebrow="__('site.pages.solutions.eyebrow')"
                :title="__('site.pages.solutions.heading')"
                :description="__('site.pages.solutions.description_text')"
            />

            @foreach ([
                ['values' => ['Business Solutions', 'Solusi Bisnis'], 'label' => __('site.nav.business_solutions')],
                ['values' => ['Technology Solutions', 'Solusi Teknologi'], 'label' => __('site.nav.technology_solutions')],
            ] as $group)
                <div class="mt-12">
                    <p class="text-xs font-semibold uppercase tracking-wide text-muted">{{ $group['label'] }}</p>
                    <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($solutions as $slug => $item)
                            @continue(! in_array($item['group'], $group['values'], true))
                            <a href="{{ route('solutions.show', $slug) }}" class="card-outline flex flex-col p-6">
                                <span class="text-base font-semibold text-navy">{{ $item['title'] }}</span>
                                <span class="mt-2 flex-1 text-sm text-muted">{{ $item['short'] }}</span>
                                <span class="mt-4 text-sm font-semibold text-accent">{{ __('site.pages.solutions.learn_more') }} &rarr;</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <x-cta-section />
</x-layout>
