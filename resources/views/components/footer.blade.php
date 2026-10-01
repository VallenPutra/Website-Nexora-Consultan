<footer class="border-t border-navy/10 bg-navy text-white/80">
    <div class="container-nexora py-14">
        <div class="grid grid-cols-2 gap-10 md:grid-cols-3 lg:grid-cols-6">
            <div class="col-span-2">
                <a href="{{ route('home') }}" class="inline-flex rounded bg-white p-2" aria-label="NIT Nusa Indo Technology">
                    <img src="{{ app(\App\Support\SiteBrand::class)->logoUrl() }}" alt="NIT Nusa Indo Technology IT Management Consultant" class="h-auto w-56 max-w-full">
                </a>
                <p class="mt-4 max-w-xs text-sm text-white/60">
                    {{ __('site.footer.tagline') }} {{ __('site.footer.blurb') }}
                </p>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-white/40">{{ __('site.footer.company') }}</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('company.about') }}" class="hover:text-accent">{{ __('site.nav.about') }}</a></li>
                    <li><a href="{{ route('company.team') }}" class="hover:text-accent">{{ __('site.nav.team') }}</a></li>
                    <li><a href="{{ route('company.careers') }}" class="hover:text-accent">{{ __('site.nav.careers') }}</a></li>
                    <li><a href="{{ route('company.partners') }}" class="hover:text-accent">{{ __('site.nav.partners') }}</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-white/40">{{ __('site.footer.solutions') }}</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-accent">IT Strategy &amp; Blueprint</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-accent">IT Governance &amp; Audit</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-accent">ERP &amp; Odoo</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-accent">Software Development</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-white/40">{{ __('site.footer.services') }}</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-accent">IT Portfolio Management</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-accent">Enterprise Architecture</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-accent">IT Training</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-accent">Multimedia &amp; Development</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-white/40">{{ __('site.footer.resources') }}</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('insights.index') }}" class="hover:text-accent">Insights</a></li>
                    <li><a href="{{ route('insights.index') }}" class="hover:text-accent">{{ __('site.footer.case_studies') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-accent">{{ __('site.footer.faq') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 grid gap-6 border-t border-white/10 pt-8 text-sm text-white/60 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <p class="font-semibold text-white/80">{{ __('site.footer.email') }}</p>
                <a href="mailto:info@nusaindotech.com" class="hover:text-accent">info@nusaindotech.com</a>
            </div>
            <div>
                <p class="font-semibold text-white/80">{{ __('site.footer.phone') }}</p>
                <a href="tel:+6287852461990" class="hover:text-accent">0878 5246 1990</a>
            </div>
            <div>
                <p class="font-semibold text-white/80">{{ __('site.footer.address') }}</p>
                <p>Jl. Penjaringan Sari 1B No. 42, Rungkut, Surabaya 60297, Indonesia</p>
            </div>
            <div>
                <p class="font-semibold text-white/80">{{ __('site.footer.follow_us') }}</p>
                <div class="mt-1 flex gap-3">
                    <a href="#" class="hover:text-accent" aria-label="LinkedIn">LinkedIn</a>
                    <a href="#" class="hover:text-accent" aria-label="Instagram">Instagram</a>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container-nexora flex flex-col items-center justify-between gap-2 py-5 text-xs text-white/50 sm:flex-row">
            <p>&copy; {{ date('Y') }} NUSA INDO TECHNOLOGY. {{ __('site.footer.rights') }}</p>
            <p>{{ __('site.footer.tagline') }}</p>
        </div>
    </div>
</footer>
