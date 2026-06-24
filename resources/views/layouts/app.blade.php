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
<body class="bg-zinc-950 text-white antialiased min-h-screen flex flex-col font-sans">
    <header class="sticky top-0 z-50 bg-zinc-950/80 backdrop-blur-md border-b border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center gap-3">
                    <img src="{{ asset('images/nafunatv-logo.svg') }}" alt="NafunaTV" class="h-8 w-auto">
                    <span class="font-bold text-xl tracking-tight text-white">Nafuna<span class="text-indigo-500">TV</span></span>
                </a>
                <nav class="hidden md:block">
                    <a href="https://nafuna.africa" target="_blank" class="text-sm font-medium text-zinc-300 hover:text-white transition-colors bg-zinc-800/50 hover:bg-zinc-800 px-5 py-2.5 rounded-full border border-zinc-700/50 backdrop-blur-sm flex items-center gap-2">
                        <span>Visit Nafuna Africa</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </nav>
            </div>
        </div>
    </header>
    
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-zinc-950 border-t border-zinc-900 py-16 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-center text-center">
                <a href="https://nafuna.africa" target="_blank" class="group block w-full max-w-3xl bg-zinc-900/50 border border-zinc-800 rounded-3xl p-10 hover:border-indigo-500/50 transition-all duration-300 hover:bg-zinc-900 hover:shadow-2xl hover:shadow-indigo-500/10 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <h3 class="text-3xl font-bold text-white mb-4 group-hover:text-indigo-400 transition-colors">Discover More from Nafuna Africa</h3>
                        <p class="text-zinc-400 text-lg mb-8 max-w-2xl mx-auto">We are a digital media agency crafting world-class animation, film, and web experiences across the continent.</p>
                        <span class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-semibold rounded-full text-white bg-indigo-600 hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-500/25 group-hover:scale-105 duration-300">
                            Explore our Agency
                        </span>
                    </div>
                </a>
                <p class="mt-16 text-zinc-600 text-sm font-medium tracking-wide">&copy; {{ date('Y') }} Nafuna Africa. Exploring Creative Frontiers.</p>
            </div>
        </div>
    </footer>

    @fluxScripts
    @livewireScripts
</body>
</html>
