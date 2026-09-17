<footer class="border-t border-navy/10 bg-navy text-white/80">
    <div class="container-nexora py-14">
        <div class="grid grid-cols-2 gap-10 md:grid-cols-3 lg:grid-cols-6">
            <div class="col-span-2">
                <a href="{{ route('home') }}" class="flex flex-col leading-none text-white">
                    <span class="text-xl font-bold tracking-tight">NEXORA</span>
                    <span class="mt-1 text-[10px] font-semibold uppercase tracking-[0.2em] text-white/60">IT Consulting</span>
                </a>
                <p class="mt-4 max-w-xs text-sm text-white/60">
                    Transforming Business Through Technology. We help businesses simplify operations, improve efficiency, and grow through reliable digital solutions.
                </p>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-white/40">Company</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('company.about') }}" class="hover:text-accent">About Us</a></li>
                    <li><a href="{{ route('company.team') }}" class="hover:text-accent">Our Team</a></li>
                    <li><a href="{{ route('company.careers') }}" class="hover:text-accent">Careers</a></li>
                    <li><a href="{{ route('company.partners') }}" class="hover:text-accent">Partners</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-white/40">Solutions</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('solutions.show', 'digital-transformation') }}" class="hover:text-accent">Digital Transformation</a></li>
                    <li><a href="{{ route('solutions.show', 'cloud-solutions') }}" class="hover:text-accent">Cloud Solutions</a></li>
                    <li><a href="{{ route('solutions.show', 'business-process-automation') }}" class="hover:text-accent">Business Automation</a></li>
                    <li><a href="{{ route('solutions.show', 'enterprise-software') }}" class="hover:text-accent">Enterprise Software</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-white/40">Services</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('services.show', 'it-consulting') }}" class="hover:text-accent">IT Consulting</a></li>
                    <li><a href="{{ route('services.show', 'web-development') }}" class="hover:text-accent">Web Development</a></li>
                    <li><a href="{{ route('services.show', 'erp-odoo') }}" class="hover:text-accent">ERP &amp; Odoo</a></li>
                    <li><a href="{{ route('services.show', 'cybersecurity') }}" class="hover:text-accent">Cybersecurity</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-white/40">Resources</p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('insights.index') }}" class="hover:text-accent">Insights</a></li>
                    <li><a href="{{ route('insights.index') }}" class="hover:text-accent">Case Studies</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-accent">FAQ</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 grid gap-6 border-t border-white/10 pt-8 text-sm text-white/60 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <p class="font-semibold text-white/80">Email</p>
                <a href="mailto:hello@nexoraconsulting.co.id" class="hover:text-accent">hello@nexoraconsulting.co.id</a>
            </div>
            <div>
                <p class="font-semibold text-white/80">Phone</p>
                <a href="tel:+622112345678" class="hover:text-accent">+62 21 1234 5678</a>
            </div>
            <div>
                <p class="font-semibold text-white/80">Address</p>
                <p>Jl. Sudirman No. 88, Surabaya, Indonesia</p>
            </div>
            <div>
                <p class="font-semibold text-white/80">Follow Us</p>
                <div class="mt-1 flex gap-3">
                    <a href="#" class="hover:text-accent" aria-label="LinkedIn">LinkedIn</a>
                    <a href="#" class="hover:text-accent" aria-label="Instagram">Instagram</a>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container-nexora flex flex-col items-center justify-between gap-2 py-5 text-xs text-white/50 sm:flex-row">
            <p>&copy; {{ date('Y') }} NEXORA IT CONSULTING. All rights reserved.</p>
            <p>Transforming Business Through Technology.</p>
        </div>
    </div>
</footer>
