<x-layout
    :title="__('site.pages.contact.title')"
    :description="__('site.pages.contact.description')"
>
    <x-breadcrumb :items="[['label' => __('site.pages.contact.title')]]" />

    <section class="section-py">
        <div class="container-nexora grid gap-12 lg:grid-cols-5">
            <div class="lg:col-span-3">
                <p class="eyebrow">{{ __('site.pages.contact.title') }}</p>
                <h1 class="mt-2 text-3xl font-bold text-navy sm:text-4xl">{{ __('site.pages.contact.heading') }}</h1>
                <p class="mt-4 max-w-lg text-sm text-muted sm:text-base">
                    {{ __('site.pages.contact.intro') }}
                </p>

                @if (session('submitted'))
                    <div class="mt-6 rounded-xl border border-accent/40 bg-accent-soft p-4 text-sm text-navy">
                        <strong class="font-semibold">{{ __('site.pages.contact.success_title') }}</strong>
                        {{ __('site.pages.contact.success_body') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        {{ __('site.pages.contact.errors') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}" data-contact-form novalidate class="mt-8 space-y-5">
                    @csrf

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div data-field>
                            <label for="name" class="text-sm font-medium text-navy">{{ __('site.pages.contact.name') }}</label>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm text-charcoal focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                            <p data-field-error class="mt-1 hidden text-xs text-red-500">{{ __('site.pages.contact.validation_name') }}</p>
                            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div data-field>
                            <label for="email" class="text-sm font-medium text-navy">{{ __('site.pages.contact.email') }}</label>
                            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm text-charcoal focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                            <p data-field-error class="mt-1 hidden text-xs text-red-500">{{ __('site.pages.contact.validation_email') }}</p>
                            @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div data-field>
                            <label for="company" class="text-sm font-medium text-navy">{{ __('site.pages.contact.company') }}</label>
                            <input id="company" name="company" type="text" value="{{ old('company') }}"
                                class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm text-charcoal focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        </div>

                        <div data-field>
                            <label for="phone" class="text-sm font-medium text-navy">{{ __('site.pages.contact.phone') }}</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}"
                                class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm text-charcoal focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        </div>

                        <div data-field>
                            <label for="service" class="text-sm font-medium text-navy">{{ __('site.pages.contact.service') }}</label>
                            <select id="service" name="service" required
                                class="mt-1.5 w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm text-charcoal focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                                <option value="">{{ __('site.pages.contact.select_service') }}</option>
                                <option value="it-consulting">IT Consulting</option>
                                <option value="web-development">Web Development</option>
                                <option value="mobile-app-development">Mobile App Development</option>
                                <option value="erp-odoo">ERP &amp; Odoo Implementation</option>
                                <option value="cloud-management">Cloud &amp; Server Management</option>
                                <option value="cybersecurity">Cybersecurity</option>
                                <option value="other">Other</option>
                            </select>
                            <p data-field-error class="mt-1 hidden text-xs text-red-500">{{ __('site.pages.contact.validation_service') }}</p>
                        </div>

                        <div data-field>
                            <label for="budget" class="text-sm font-medium text-navy">{{ __('site.pages.contact.budget') }}</label>
                            <select id="budget" name="budget" required
                                class="mt-1.5 w-full rounded-lg border border-navy/15 bg-white px-3.5 py-2.5 text-sm text-charcoal focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                                <option value="">{{ __('site.pages.contact.select_budget') }}</option>
                                <option value="under-50m">Under Rp 50 million</option>
                                <option value="50-150m">Rp 50–150 million</option>
                                <option value="150-500m">Rp 150–500 million</option>
                                <option value="above-500m">Above Rp 500 million</option>
                            </select>
                            <p data-field-error class="mt-1 hidden text-xs text-red-500">{{ __('site.pages.contact.validation_budget') }}</p>
                        </div>
                    </div>

                    <div data-field>
                        <label for="message" class="text-sm font-medium text-navy">{{ __('site.pages.contact.message') }}</label>
                        <textarea id="message" name="message" rows="5" required
                            class="mt-1.5 w-full rounded-lg border border-navy/15 px-3.5 py-2.5 text-sm text-charcoal focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('message') }}</textarea>
                        <p data-field-error class="mt-1 hidden text-xs text-red-500">{{ __('site.pages.contact.validation_message') }}</p>
                        @error('message') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full sm:w-auto">{{ __('site.pages.contact.submit') }}</button>
                </form>
            </div>

            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-navy/10 bg-surface p-8">
                    <p class="text-sm font-semibold text-navy">{{ __('site.pages.contact.contact_information') }}</p>
                    <dl class="mt-5 space-y-4 text-sm text-muted">
                        <div>
                            <dt class="font-medium text-navy">{{ __('site.pages.contact.email') }}</dt>
                            <dd><a href="mailto:hello@nexoraconsulting.co.id" class="hover:text-accent">hello@nexoraconsulting.co.id</a></dd>
                        </div>
                        <div>
                            <dt class="font-medium text-navy">{{ __('site.pages.contact.phone') }}</dt>
                            <dd><a href="tel:+622112345678" class="hover:text-accent">+62 21 1234 5678</a></dd>
                        </div>
                        <div>
                            <dt class="font-medium text-navy">{{ __('site.pages.contact.office_address') }}</dt>
                            <dd>Jl. Sudirman No. 88, Surabaya, Indonesia</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-navy">{{ __('site.pages.contact.operating_hours') }}</dt>
                            <dd>Monday–Friday, 09:00–18:00 WIB</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-navy">{{ __('site.pages.contact.social_media') }}</dt>
                            <dd class="flex gap-3">
                                <a href="#" class="hover:text-accent">LinkedIn</a>
                                <a href="#" class="hover:text-accent">Instagram</a>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>
</x-layout>
