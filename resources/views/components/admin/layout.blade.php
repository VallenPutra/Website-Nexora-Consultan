@props([
    'title' => 'Dashboard',
    'adminName' => null,
])
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | NEXORA IT Consulting Management</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#171a2b">
    <link rel="icon" href="data:,">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="bg-surface text-charcoal antialiased">

    <a href="#admin-main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-100 focus:rounded-lg focus:bg-navy focus:px-4 focus:py-2 focus:text-white">
        Skip to content
    </a>

    <div data-admin-shell class="flex min-h-screen">
        <x-admin.sidebar />

        <div data-admin-main class="flex min-w-0 flex-1 flex-col">
            <x-admin.topbar :title="$title" :admin-name="$adminName" />

            <main id="admin-main-content" class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
