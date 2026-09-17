<x-layout
    title="Solutions"
    description="Explore NEXORA's business and technology solutions, from digital transformation to cloud infrastructure."
>
    <x-breadcrumb :items="[['label' => 'Solutions']]" />

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                eyebrow="Solutions"
                title="Technology designed around your business"
                description="We combine business strategy with technical execution to help you simplify operations, reduce cost, and grow sustainably."
            />

            @foreach (['Business Solutions', 'Technology Solutions'] as $group)
                <div class="mt-12">
                    <p class="text-xs font-semibold uppercase tracking-wide text-muted">{{ $group }}</p>
                    <div class="mt-5 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($solutions as $slug => $item)
                            @continue($item['group'] !== $group)
                            <a href="{{ route('solutions.show', $slug) }}" class="card-outline flex flex-col p-6">
                                <span class="text-base font-semibold text-navy">{{ $item['title'] }}</span>
                                <span class="mt-2 flex-1 text-sm text-muted">{{ $item['short'] }}</span>
                                <span class="mt-4 text-sm font-semibold text-accent">Learn more &rarr;</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <x-cta-section />
</x-layout>
