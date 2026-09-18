<x-layout
    :title="__('site.pages.services.title')"
    :description="__('site.pages.services.description')"
>
    <x-breadcrumb :items="[['label' => __('site.pages.services.title')]]" />

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                :eyebrow="__('site.pages.services.eyebrow')"
                :title="__('site.pages.services.heading')"
                :description="__('site.pages.services.description_text')"
            />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($services as $slug => $item)
                    <a href="{{ route('services.show', $slug) }}" class="card-outline flex flex-col p-6">
                        <span class="text-base font-semibold text-navy">{{ $item['title'] }}</span>
                        <span class="mt-2 flex-1 text-sm text-muted">{{ $item['short'] }}</span>
                        <span class="mt-4 text-sm font-semibold text-accent">{{ __('site.pages.services.explore') }} &rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
