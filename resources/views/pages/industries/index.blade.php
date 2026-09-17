<x-layout
    title="Industries"
    description="See how NEXORA helps manufacturing, healthcare, education, retail, finance, government, and startup organizations."
>
    <x-breadcrumb :items="[['label' => 'Industries']]" />

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                eyebrow="Industries"
                title="Industries we serve"
                description="We tailor every engagement to the operational realities, compliance needs, and growth goals of your industry."
            />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($industries as $slug => $item)
                    <a href="{{ route('industries.show', $slug) }}" class="card-outline flex flex-col p-6">
                        <span class="text-base font-semibold text-navy">{{ $item['title'] }}</span>
                        <span class="mt-2 flex-1 text-sm text-muted">{{ $item['short'] }}</span>
                        <span class="mt-4 text-sm font-semibold text-accent">Learn more &rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
