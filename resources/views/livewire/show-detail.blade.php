<div>
    <div class="mb-6">
        <flux:button href="{{ url('/') }}" wire:navigate variant="subtle" icon="arrow-left">
            Back to Library
        </flux:button>
    </div>

    <flux:grid class="gap-8">
        <flux:grid.col class="lg:col-span-8">
            <flux:card class="p-0 overflow-hidden bg-zinc-900 border-zinc-800">
                <div class="aspect-video w-full">
                    <iframe 
                        src="{{ $show->youtube_url }}" 
                        class="w-full h-full"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </flux:card>
        </flux:grid.col>

        <flux:grid.col class="lg:col-span-4 space-y-6">
            <div>
                <flux:heading size="xl" class="mb-2">{{ $show->title }}</flux:heading>
                <div class="flex items-center gap-2 mb-4">
                    <flux:badge color="indigo" size="sm">HD</flux:badge>
                    <flux:text class="text-sm">Original Series</flux:text>
                </div>
                <flux:text class="leading-relaxed">
                    {{ $show->description }}
                </flux:text>
            </div>

            <flux:separator />

            <div>
                <flux:heading size="lg" class="mb-3">Category</flux:heading>
                @if(isset($show->category))
                    <flux:badge variant="outline">{{ $show->category->name }}</flux:badge>
                @endif
            </div>
        </flux:grid.col>
    </flux:grid>
</div>
