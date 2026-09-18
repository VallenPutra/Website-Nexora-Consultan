<x-auth.layout title="Sign In">

    <h1 class="text-xl font-bold text-navy">Sign in to your account</h1>
    <p class="mt-1.5 text-sm text-muted">Enter your credentials to continue to NEXORA.</p>

    @if (session('status'))
        <div class="mt-5 rounded-lg bg-emerald-50 px-3.5 py-2.5 text-sm text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
        @csrf

        <x-auth.input label="Email address" name="email" type="email" autofocus autocomplete="email" />
        <x-auth.input label="Password" name="password" type="password" autocomplete="current-password" />

        <label class="flex items-center gap-2 text-sm text-charcoal">
            <input type="checkbox" name="remember" class="rounded border-navy/25 text-accent focus:ring-accent/40">
            Remember me
        </label>

        <button type="submit" class="admin-btn-primary w-full">Sign In</button>
    </form>

    @if (config('nexora.registration_open'))
        <p class="mt-6 text-center text-sm text-muted">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-semibold text-accent hover:text-amber-600">Create one</a>
        </p>
    @endif

</x-auth.layout>
