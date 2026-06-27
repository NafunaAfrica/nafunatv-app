<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
    <!-- Back Navigation -->
    <div>
        <flux:button href="{{ url('/') }}" wire:navigate variant="subtle" icon="arrow-left" class="text-zinc-400 hover:text-white">
            Back to Library
        </flux:button>
    </div>

    <!-- Video & Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
        <!-- Video Player Column -->
        <div class="lg:col-span-8 space-y-6">
            <div class="aspect-video w-full rounded-2xl overflow-hidden bg-zinc-900 border border-zinc-800 shadow-2xl shadow-indigo-500/5 relative">
                <iframe 
                    src="{{ $show->youtube_url }}" 
                    class="w-full h-full absolute inset-0"
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        <!-- Details Column -->
        <div class="lg:col-span-4 flex flex-col justify-between space-y-6 bg-zinc-900/40 border border-zinc-900/80 rounded-2xl p-6 md:p-8">
            <div class="space-y-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight leading-snug">
                        {{ $show->title }}
                    </h1>
                </div>

                <div class="flex items-center gap-2">
                    <flux:badge color="indigo" size="sm" variant="solid" class="font-bold">HD</flux:badge>
                    @if(isset($show->category))
                        <flux:badge variant="outline" class="text-zinc-300 border-zinc-700 bg-zinc-800/40">{{ $show->category->name }}</flux:badge>
                    @endif
                </div>

                <flux:separator class="border-zinc-800" />

                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-zinc-300">About this show</h3>
                    <p class="text-sm text-zinc-400 font-medium leading-relaxed">
                        {{ $show->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Content Section -->
    @if(count($relatedShows) > 0)
        <flux:separator class="border-zinc-900 my-12" />

        <section class="space-y-6">
            <div class="border-l-4 border-indigo-500 pl-4">
                <flux:heading size="xl" class="text-white font-bold tracking-tight">More Like This</flux:heading>
                <flux:subheading size="sm" class="text-zinc-400 mt-1">Discover other vlogs and episodes in this category.</flux:subheading>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedShows as $related)
                    <div class="group">
                        <a href="{{ route('show.detail', $related->slug) }}" wire:navigate class="space-y-3 block">
                            <!-- Image container -->
                            <div class="aspect-video w-full rounded-2xl overflow-hidden bg-zinc-900 border border-zinc-800/80 relative transition-all duration-300 group-hover:scale-[1.03] group-hover:border-zinc-700 group-hover:shadow-2xl group-hover:shadow-indigo-500/10">
                                <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                                
                                <!-- Hover Play Overlay -->
                                <div class="absolute inset-0 bg-zinc-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white scale-75 group-hover:scale-100 transition-transform duration-300">
                                        <flux:icon name="play" class="w-5 h-5 ml-0.5" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Meta -->
                            <div class="px-1 space-y-1">
                                <h3 class="text-xs sm:text-sm font-semibold text-zinc-100 group-hover:text-white line-clamp-1 transition-colors">
                                    {{ $related->title }}
                                </h3>
                                <p class="text-xs text-zinc-500 font-medium line-clamp-1">
                                    {{ $related->description }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>
