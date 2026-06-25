<div>
    <!-- Hero Section -->
    <div class="relative bg-zinc-900 overflow-hidden h-[70vh] flex items-center justify-center border-b border-zinc-800">
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero_banner.png') }}" alt="NafunaTV Hero" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/60 to-transparent"></div>
        </div>
        <div class="relative z-10 text-center max-w-5xl mx-auto px-4 mt-16">
            <h1 class="text-6xl md:text-8xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-zinc-500 tracking-tighter mb-6">Discover African<br/>Creativity</h1>
            <p class="text-xl md:text-2xl text-zinc-400 font-medium max-w-3xl mx-auto mb-10">Stream the best original web series, talk shows, and documentaries from Nafuna Africa.</p>
            <div class="flex items-center justify-center gap-4">
                <a href="#categories" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-full text-zinc-950 bg-white hover:bg-zinc-200 transition-all shadow-lg shadow-white/10 hover:scale-105 duration-300">
                    Start Watching
                </a>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
        @foreach($categories as $category)
            <section class="category-section">
                <div class="mb-8">
                    <flux:heading size="xl" class="mb-2">{{ $category->name }}</flux:heading>
                    <flux:subheading size="lg">{{ $category->description }}</flux:subheading>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($category->shows as $show)
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
                        
                        <flux:card class="p-0 overflow-hidden flex flex-col group hover:ring-2 hover:ring-indigo-500 transition-all cursor-pointer">
                            <a href="{{ route('show.detail', $show->slug) }}" wire:navigate class="flex flex-col h-full">
                                <div class="aspect-video w-full overflow-hidden relative">
                                    <img src="{{ $thumbnailUrl }}" alt="{{ $show->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <flux:heading size="lg" class="line-clamp-1 mb-1">{{ $show->title }}</flux:heading>
                                    <flux:subheading class="line-clamp-2">{{ $show->description }}</flux:subheading>
                                </div>
                            </a>
                        </flux:card>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</div>
