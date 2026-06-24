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
    <div id="categories" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-24">
        @foreach($categories as $category)
            <section class="category-section">
                <div class="mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-white tracking-tight mb-3 flex items-center gap-3">
                        <span class="w-2 h-8 bg-indigo-500 rounded-full"></span>
                        {{ $category->name }}
                    </h2>
                    <p class="text-zinc-400 text-lg max-w-3xl pl-5">{{ $category->description }}</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($category->shows as $show)
                        @php
                            $title = strtolower($show->title);
                            if (str_contains($title, 'beginning')) {
                                $thumbnailUrl = asset('images/angry_mwana_1.png');
                            } elseif (str_contains($title, 'city life')) {
                                $thumbnailUrl = asset('images/angry_mwana_2.png');
                            } elseif (str_contains($title, 'campus')) {
                                $thumbnailUrl = asset('images/nafuna_campus.png');
                            } elseif (str_contains($title, 'behind')) {
                                $thumbnailUrl = asset('images/behind_scenes.png');
                            } else {
                                $thumbnailUrl = asset('images/hero_banner.png');
                            }
                        @endphp
                        
                        <a href="{{ route('show.detail', $show->slug) }}" class="group relative flex flex-col bg-zinc-900/50 border border-zinc-800 rounded-2xl overflow-hidden hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1">
                            <div class="aspect-video w-full overflow-hidden relative">
                                <img src="{{ $thumbnailUrl }}" alt="{{ $show->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white scale-75 group-hover:scale-100 transition-transform duration-300">
                                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-5 flex flex-col flex-grow">
                                <h3 class="text-lg font-bold text-white mb-2 line-clamp-1 group-hover:text-indigo-400 transition-colors">{{ $show->title }}</h3>
                                <p class="text-sm text-zinc-400 line-clamp-2 leading-relaxed">{{ $show->description }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</div>
