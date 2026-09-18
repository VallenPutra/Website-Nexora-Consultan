<x-layout
    :title="__('site.pages.industries.title')"
    :description="__('site.pages.industries.description')"
>
    <x-breadcrumb :items="[['label' => __('site.pages.industries.title')]]" />

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                :eyebrow="__('site.pages.industries.eyebrow')"
                :title="__('site.pages.industries.heading')"
                :description="__('site.pages.industries.description_text')"
            />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($industries as $slug => $item)
                    <a href="{{ route('industries.show', $slug) }}" class="card-outline flex flex-col p-6">
                        <span class="text-base font-semibold text-navy">{{ $item['title'] }}</span>
                        <span class="mt-2 flex-1 text-sm text-muted">{{ $item['short'] }}</span>
                        <span class="mt-4 text-sm font-semibold text-accent">{{ __('site.pages.industries.learn_more') }} &rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
