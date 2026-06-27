<div>
    <!-- Cinematic Hero Section -->
    @if($featuredShow)
        <div class="relative bg-zinc-950 h-[65vh] min-h-[450px] flex items-end pb-12 border-b border-zinc-900 overflow-hidden">
            <!-- Hero Background -->
            <div class="absolute inset-0">
                <img src="https://img.youtube.com/vi/{{ $featuredShow->youtube_id }}/maxresdefault.jpg" 
                     onerror="this.src='https://img.youtube.com/vi/{{ $featuredShow->youtube_id }}/hqdefault.jpg'"
                     alt="{{ $featuredShow->title }}" 
                     class="w-full h-full object-cover opacity-35 scale-105 blur-[2px] md:blur-0">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/50 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-zinc-950 via-zinc-950/20 to-transparent"></div>
            </div>

            <!-- Hero Info -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-3xl space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold uppercase tracking-wider">
                        Featured Show
                    </div>
                    
                    <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight leading-tight">
                        {{ $featuredShow->title }}
                    </h1>
                    
                    <p class="text-base sm:text-lg text-zinc-300 line-clamp-3 font-medium leading-relaxed max-w-2xl">
                        {{ $featuredShow->description }}
                    </p>
                    
                    <div class="flex items-center gap-4 pt-2">
                        <flux:button href="{{ route('show.detail', $featuredShow->slug) }}" wire:navigate icon="play" size="base" class="bg-white text-zinc-950 hover:bg-zinc-200 border-none font-bold rounded-xl px-8 shadow-lg shadow-white/5 transition-transform hover:scale-105 duration-200">
                            Watch Now
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Scrollable Categories Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16" id="categories">
        @foreach($categories as $category)
            @php
                $sectionId = match(true) {
                    str_contains(strtolower($category->name), 'web') => 'web-series',
                    str_contains(strtolower($category->name), 'talk') => 'talk-discussion',
                    str_contains(strtolower($category->name), 'animation') => 'animation-tech',
                    default => 'category-' . $category->id
                };
            @endphp
            @if(count($category->shows) > 0)
                <section id="{{ $sectionId }}" class="space-y-6 scroll-mt-24">
                    <div class="border-l-4 border-indigo-500 pl-4">
                        <flux:heading size="xl" class="text-white font-bold tracking-tight">{{ $category->name }}</flux:heading>
                        <flux:subheading size="sm" class="text-zinc-400 mt-1">{{ $category->description }}</flux:subheading>
                    </div>
                    
                    <!-- Horizontal Scroll Container -->
                    <div class="flex gap-6 overflow-x-auto pb-4 scrollbar-thin px-4 -mx-4">
                        @foreach($category->shows as $show)
                            <div class="w-[280px] sm:w-[320px] flex-shrink-0 group">
                                <a href="{{ route('show.detail', $show->slug) }}" wire:navigate class="space-y-3 block">
                                    <!-- Card Image Container -->
                                    <div class="aspect-video w-full rounded-2xl overflow-hidden bg-zinc-900 border border-zinc-800/80 relative transition-all duration-300 group-hover:scale-[1.03] group-hover:border-zinc-700 group-hover:shadow-2xl group-hover:shadow-indigo-500/10">
                                        <img src="{{ $show->thumbnail_url }}" alt="{{ $show->title }}" class="w-full h-full object-cover">
                                        
                                        <!-- Ambient Play Overlay -->
                                        <div class="absolute inset-0 bg-zinc-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white scale-75 group-hover:scale-100 transition-transform duration-300">
                                                <flux:icon name="play" class="w-6 h-6 ml-0.5" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Card Metadata -->
                                    <div class="px-1 space-y-1">
                                        <h3 class="text-sm font-semibold text-zinc-100 group-hover:text-white line-clamp-1 transition-colors">
                                            {{ $show->title }}
                                        </h3>
                                        <p class="text-xs text-zinc-500 font-medium flex items-center gap-1.5">
                                            <span>{{ $show->description }}</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div class="w-4 flex-shrink-0"></div>
                    </div>
                </section>
            @endif
        @endforeach
    </div>
</div>
