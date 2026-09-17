<x-layout
    title="Home"
    description="NEXORA IT Consulting helps businesses simplify operations, improve efficiency, and grow through reliable digital solutions."
>
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-white">
        <div class="pointer-events-none absolute inset-0 bg-linear-to-br from-accent-soft/60 via-white to-white"></div>
        <div class="container-nexora relative grid items-center gap-12 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <p class="eyebrow">Nexora IT Consulting</p>
                <h1 class="mt-3 text-4xl font-bold leading-tight text-navy sm:text-5xl">
                    Technology Solutions That Move Your Business Forward
                </h1>
                <p class="mt-5 max-w-lg text-base text-muted">
                    NEXORA IT CONSULTING helps businesses simplify operations, improve efficiency, and grow through reliable digital solutions.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('contact') }}" class="btn-primary">Start a Consultation</a>
                    <a href="{{ route('solutions.index') }}" class="btn-secondary">Explore Our Solutions</a>
                </div>
            </div>

            <div class="relative">
                <div class="aspect-4/3 w-full rounded-2xl border border-navy/10 bg-navy p-8 shadow-xl">
                    <div class="grid h-full grid-cols-2 gap-4">
                        <div class="col-span-2 rounded-xl bg-white/5 p-5">
                            <div class="h-2 w-16 rounded-full bg-accent"></div>
                            <div class="mt-4 h-2 w-3/4 rounded-full bg-white/20"></div>
                            <div class="mt-2 h-2 w-1/2 rounded-full bg-white/20"></div>
                        </div>
                        <div class="rounded-xl bg-white/5 p-5">
                            <div class="h-2 w-10 rounded-full bg-white/30"></div>
                            <div class="mt-6 h-16 rounded-lg bg-accent/20"></div>
                        </div>
                        <div class="rounded-xl bg-white/5 p-5">
                            <div class="h-2 w-10 rounded-full bg-white/30"></div>
                            <div class="mt-6 h-16 rounded-lg bg-white/10"></div>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-6 -left-6 hidden rounded-xl border border-navy/10 bg-white p-4 shadow-lg sm:block">
                    <p class="text-xs font-semibold text-muted">System Uptime</p>
                    <p class="text-xl font-bold text-navy">99.9%</p>
                </div>
            </div>
        </div>
    </section>

    {{-- TRUSTED BY --}}
    <section class="border-y border-navy/10 bg-surface">
        <div class="container-nexora py-10">
            <p class="text-center text-xs font-semibold uppercase tracking-wide text-muted">
                Trusted by businesses that want to move forward
            </p>
            <div class="mt-6 grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-6">
                @foreach (['Astra Nusantara', 'Mitra Logistik', 'Kirana Retail', 'Bumi Finance', 'Pelita Health', 'Cendana Group'] as $client)
                    <div class="flex items-center justify-center rounded-lg bg-white py-4 text-sm font-semibold text-navy/50">
                        {{ $client }}
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SOLUTIONS --}}
    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                eyebrow="Solutions"
                title="Technology designed around your business"
                description="From strategy to execution, our solutions help you simplify operations and scale with confidence."
            />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (['digital-transformation', 'business-process-automation', 'cloud-solutions', 'enterprise-software'] as $slug)
                    @php($item = $solutions[$slug])
                    <a href="{{ route('solutions.show', $slug) }}" class="card-outline flex flex-col p-6">
                        <span class="text-base font-semibold text-navy">{{ $item['title'] }}</span>
                        <span class="mt-2 flex-1 text-sm text-muted">{{ $item['short'] }}</span>
                        <span class="mt-4 text-sm font-semibold text-accent">Learn more &rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FEATURED SOLUTION --}}
    <section class="section-py bg-surface">
        <div class="container-nexora grid items-center gap-12 lg:grid-cols-2">
            <div class="order-2 aspect-4/3 rounded-2xl border border-navy/10 bg-white p-6 shadow-sm lg:order-1">
                <div class="flex h-full flex-col justify-between">
                    <div class="grid grid-cols-3 gap-3">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="h-12 rounded-lg {{ $i === 1 ? 'bg-accent/30' : 'bg-surface' }}"></div>
                        @endfor
                    </div>
                    <div class="h-24 rounded-lg bg-navy/5"></div>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <p class="eyebrow">Featured Solution</p>
                <h2 class="mt-2 text-2xl font-bold text-navy sm:text-3xl">Enterprise Software Built Around Your Operations</h2>
                <p class="mt-4 text-sm text-muted sm:text-base">
                    When off-the-shelf tools no longer fit the way your business runs, we design and build custom enterprise software that reflects your real workflows.
                </p>
                <ul class="mt-5 space-y-2 text-sm text-charcoal">
                    <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-accent"></span> Custom internal business applications</li>
                    <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-accent"></span> Role-based access and approval structures</li>
                    <li class="flex items-start gap-2"><span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-accent"></span> Reporting and analytics built into the system</li>
                </ul>
                <a href="{{ route('solutions.show', 'enterprise-software') }}" class="btn-primary mt-6">Explore Enterprise Software</a>
            </div>
        </div>
    </section>

    {{-- SERVICES --}}
    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                eyebrow="Services"
                title="Services that keep your technology moving"
                description="Hands-on delivery across the full technology lifecycle, from consulting to ongoing support."
            />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                @foreach (['it-consulting', 'web-development', 'erp-odoo', 'cloud-management', 'cybersecurity'] as $slug)
                    @php($item = $services[$slug])
                    <div class="card-outline flex flex-col p-6">
                        <span class="text-sm font-semibold text-navy">{{ $item['title'] }}</span>
                        <span class="mt-2 flex-1 text-xs text-muted">{{ $item['short'] }}</span>
                        <a href="{{ route('services.show', $slug) }}" class="mt-4 text-sm font-semibold text-accent hover:underline">Explore Service &rarr;</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- INDUSTRIES --}}
    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading
                eyebrow="Industries"
                title="Industries we serve"
                description="We tailor every engagement to the operational realities of your industry."
            />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                @foreach (['manufacturing', 'healthcare', 'education', 'retail', 'finance'] as $slug)
                    @php($item = $industries[$slug])
                    <a href="{{ route('industries.show', $slug) }}" class="card-outline flex flex-col p-6">
                        <span class="text-sm font-semibold text-navy">{{ $item['title'] }}</span>
                        <span class="mt-2 flex-1 text-xs text-muted">{{ $item['short'] }}</span>
                        <span class="mt-4 text-sm font-semibold text-accent">Learn more &rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- INSIGHTS --}}
    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                eyebrow="Insights"
                title="Insights for a changing digital world"
                description="Practical perspectives on technology, digital transformation, and business growth."
            />
            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ($insights as $slug => $article)
                    <a href="{{ route('insights.show', $slug) }}" class="card-outline flex flex-col overflow-hidden">
                        <div class="aspect-video bg-linear-to-br from-navy to-charcoal"></div>
                        <div class="flex flex-1 flex-col p-6">
                            <span class="text-xs font-semibold uppercase tracking-wide text-accent">{{ $article['category'] }}</span>
                            <span class="mt-2 text-base font-semibold text-navy">{{ $article['title'] }}</span>
                            <span class="mt-2 flex-1 text-sm text-muted">{{ $article['excerpt'] }}</span>
                            <span class="mt-4 text-xs text-muted">{{ \Illuminate\Support\Carbon::parse($article['date'])->format('d M Y') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHY NEXORA --}}
    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading eyebrow="Why Nexora" title="A partner that thinks like an operator, not just a vendor" align="center" />
            <div class="mx-auto mt-10 grid max-w-4xl gap-6 sm:grid-cols-2">
                @foreach ([
                    'Business-focused approach' => 'We start with your business goals, not the technology, and work backward from there.',
                    'Experienced technology team' => 'Our consultants and engineers bring real delivery experience across industries.',
                    'Scalable solutions' => 'Everything we build is designed to grow alongside your business.',
                    'Transparent communication' => 'You always know the status, timeline, and reasoning behind our recommendations.',
                    'Long-term support' => 'We stay involved after launch, not just through go-live.',
                ] as $title => $desc)
                    <div class="rounded-xl bg-white p-6">
                        <p class="text-sm font-semibold text-navy">{{ $title }}</p>
                        <p class="mt-2 text-sm text-muted">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
