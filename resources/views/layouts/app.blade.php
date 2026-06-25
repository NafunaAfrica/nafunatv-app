<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'NafunaTV | Premium African Streaming' }}</title>
    @if(isset($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @else
        <meta name="description" content="NafunaTV is the premier platform for web series, animation, and creative digital content by Nafuna Africa.">
    @endif
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @fluxAppearance
    @livewireStyles
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/nafunatv-logo.svg') }}" alt="NafunaTV" class="h-8 w-auto">
            <span class="font-bold text-xl tracking-tight dark:text-white text-zinc-900">Nafuna<span class="text-indigo-500">TV</span></span>
        </a>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item href="https://nafuna.africa" target="_blank">Visit Nafuna Africa</flux:navbar.item>
        </flux:navbar>

        <flux:spacer />
    </flux:header>

    <flux:sidebar stashable sticky class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ url('/') }}" class="flex items-center gap-2 px-2">
            <img src="{{ asset('images/nafunatv-logo.svg') }}" alt="NafunaTV" class="h-8 w-auto">
            <span class="font-bold text-xl tracking-tight dark:text-white text-zinc-900">Nafuna<span class="text-indigo-500">TV</span></span>
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.item icon="arrow-top-right-on-square" href="https://nafuna.africa" target="_blank">Visit Nafuna Africa</flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>

    <flux:main container>
        {{ $slot }}
    </flux:main>

    <flux:footer container class="mt-16 text-center text-sm text-zinc-500 dark:text-zinc-400">
        &copy; {{ date('Y') }} Nafuna Africa. Exploring Creative Frontiers.
    </flux:footer>

    @fluxScripts
    @livewireScripts
</body>
</html>
