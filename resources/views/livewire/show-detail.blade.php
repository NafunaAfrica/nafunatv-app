<div class="relative bg-zinc-950 min-h-[50vh] border-b border-zinc-800">
    <div class="absolute inset-0">
        @php
            $ytId = null;
            $url = $show->youtube_url ?? '';
            if (preg_match('/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
                $ytId = $matches[1];
            } elseif (preg_match('/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
                $ytId = $matches[1];
            }
            $thumbnailUrl = $ytId ? "https://img.youtube.com/vi/{$ytId}/maxresdefault.jpg" : asset('images/hero_banner.png');
        @endphp
        <img src="{{ $thumbnailUrl }}" alt="{{ $show->title }}" class="w-full h-full object-cover opacity-20 blur-xl">
        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            <!-- Video Player Container -->
            <div class="w-full lg:w-2/3">
                <div class="aspect-video w-full rounded-2xl overflow-hidden shadow-2xl shadow-indigo-500/10 border border-zinc-800 bg-zinc-900">
                    <iframe 
                        src="{{ $show->youtube_url }}" 
                        class="w-full h-full"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Info Container -->
            <div class="w-full lg:w-1/3 space-y-8">
                <a href="{{ url('/') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-zinc-400 hover:text-white transition-colors bg-zinc-900/50 hover:bg-zinc-800 px-4 py-2 rounded-full border border-zinc-800 w-fit">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Library
                </a>

                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4">{{ $show->title }}</h1>
                    <div class="flex items-center gap-3 mb-6">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">HD</span>
                        <span class="text-zinc-400 text-sm">Original Series</span>
                    </div>
                    <p class="text-lg text-zinc-300 leading-relaxed">{{ $show->description }}</p>
                </div>

                <div class="pt-8 border-t border-zinc-800">
                    <h3 class="text-lg font-bold text-white mb-4">Category</h3>
                    <div class="flex flex-wrap gap-2">
                        @if(isset($show->category))
                            <span class="px-4 py-2 rounded-full bg-zinc-900 border border-zinc-800 text-sm text-zinc-300">{{ $show->category->name }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
