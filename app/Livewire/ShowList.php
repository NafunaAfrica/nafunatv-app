<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

#[Lazy]
#[Layout('components.layouts.app')]
class ShowList extends Component
{
    public function placeholder()
    {
        return <<<'HTML'
        <div class="skeleton-container" style="max-width: 1400px; margin: 0 auto; padding: 2rem 5%;">
            <div class="skeleton-pulse" style="width: 100%; height: 450px; border-radius: 24px; margin-bottom: 4rem;"></div>
            
            <div class="glass-panel">
                <div class="skeleton-pulse" style="width: 300px; height: 40px; border-radius: 8px; margin-bottom: 1rem;"></div>
                <div class="skeleton-pulse" style="width: 500px; height: 20px; border-radius: 4px; margin-bottom: 2rem;"></div>
                
                <div class="shows-grid">
                    <div class="skeleton-pulse" style="height: 320px; border-radius: 16px;"></div>
                    <div class="skeleton-pulse" style="height: 320px; border-radius: 16px;"></div>
                    <div class="skeleton-pulse" style="height: 320px; border-radius: 16px;"></div>
                </div>
            </div>
        </div>
        HTML;
    }

    public function render()
    {
        // Cache raw arrays to avoid PHP incomplete class serialization errors
        $categoriesData = Cache::remember('directus_categories_shows_array', 300, function () {
            // Fetch from Directus API
            $categoriesResponse = Http::get('https://data.nafuna.africa/items/nafunatv_categories');
            $showsResponse = Http::get('https://data.nafuna.africa/items/nafunatv_shows');
            
            if ($categoriesResponse->failed() || $showsResponse->failed()) {
                return [];
            }
            
            $cats = $categoriesResponse->json('data') ?? [];
            $shows = collect($showsResponse->json('data') ?? []);
            
            // Map shows to their respective categories as pure arrays
            return collect($cats)->map(function ($cat) use ($shows) {
                $cat['shows'] = $shows->where('category_id', $cat['id'])->values()->all();
                return $cat;
            })->all();
        });

        // Convert to objects right before passing to the view so Blade syntax ($category->name) works
        $categories = collect($categoriesData)->map(function ($cat) {
            $obj = (object) $cat;
            $obj->shows = collect($cat['shows'] ?? [])->map(function ($show) {
                return (object) $show;
            })->all();
            return $obj;
        })->all();

        return view('livewire.show-list', [
            'categories' => $categories
        ]);
    }
}
