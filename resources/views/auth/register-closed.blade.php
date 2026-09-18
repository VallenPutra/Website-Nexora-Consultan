<x-auth.layout title="Registration Closed">

    <h1 class="text-xl font-bold text-navy">Registration is closed</h1>
    <p class="mt-2 text-sm text-muted leading-relaxed">
        Public sign-up for NEXORA is currently disabled. If you need access,
        ask an existing administrator to create your account, or provision one directly
        via <code class="rounded bg-surface px-1.5 py-0.5 text-xs">php artisan db:seed</code> / Tinker.
    </p>

    <a href="{{ route('login') }}" class="admin-btn-primary mt-6 w-full">Back to Sign In</a>

</x-auth.layout>
