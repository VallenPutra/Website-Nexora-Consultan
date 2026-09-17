<x-layout
    title="Services"
    description="Explore NEXORA's IT consulting, development, ERP, cloud, and cybersecurity services."
>
    <x-breadcrumb :items="[['label' => 'Services']]" />

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                eyebrow="Services"
                title="Services that keep your technology moving"
                description="Hands-on delivery across the full technology lifecycle, from strategy and design to development and ongoing support."
            />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($services as $slug => $item)
                    <a href="{{ route('services.show', $slug) }}" class="card-outline flex flex-col p-6">
                        <span class="text-base font-semibold text-navy">{{ $item['title'] }}</span>
                        <span class="mt-2 flex-1 text-sm text-muted">{{ $item['short'] }}</span>
                        <span class="mt-4 text-sm font-semibold text-accent">Explore Service &rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
