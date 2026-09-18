<x-auth.layout title="Create Account">

    <h1 class="text-xl font-bold text-navy">Create an account</h1>
    <p class="mt-1.5 text-sm text-muted">Create your account to connect with NEXORA.</p>

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
        @csrf

        <x-auth.input label="Full name" name="name" autofocus autocomplete="name" />
        <x-auth.input label="Email address" name="email" type="email" autocomplete="email" />
        <x-auth.input label="Password" name="password" type="password" autocomplete="new-password" />
        <x-auth.input label="Confirm password" name="password_confirmation" type="password" autocomplete="new-password" />

        <button type="submit" class="admin-btn-primary w-full">Create Account</button>
    </form>

    <p class="mt-6 text-center text-sm text-muted">
        Already have an account?
        <a href="{{ route('login') }}" class="font-semibold text-accent hover:text-amber-600">Sign in</a>
    </p>

</x-auth.layout>
