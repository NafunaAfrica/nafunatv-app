<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

#[Lazy]
#[Layout('components.layouts.app')]
class ShowDetail extends Component
{
    public $show;

    public function mount($slug)
    {
        // Fetch specific show from Directus API
        $response = Http::get('https://data.nafuna.africa/items/nafunatv_shows', [
            'filter' => [
                'slug' => [
                    '_eq' => $slug
                ]
            ],
            // Include category_id relation data (for $show->category->name)
            'fields' => ['*', 'category_id.name']
        ]);

        $shows = $response->json('data') ?? [];

        if (empty($shows)) {
            abort(404);
        }

        $this->show = (object) $shows[0];
        
        // Map category_id relation to category for Blade view
        if (isset($this->show->category_id) && is_array($this->show->category_id)) {
            $this->show->category = (object) $this->show->category_id;
        } else {
            $this->show->category = (object) ['name' => 'Uncategorized'];
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div style="max-width: 1400px; margin: 0 auto; padding: 2rem 5%;">
            <div class="show-detail-content glass-panel skeleton-container">
                <div class="skeleton-pulse" style="width: 250px; height: 35px; border-radius: 20px; margin-bottom: 2rem;"></div>
                <div class="skeleton-pulse" style="width: 80%; height: 60px; border-radius: 8px; margin-bottom: 1.5rem;"></div>
                <div class="skeleton-pulse" style="width: 100%; aspect-ratio: 16/9; border-radius: 16px; margin-bottom: 2rem;"></div>
                <div class="skeleton-pulse" style="width: 100%; height: 20px; border-radius: 4px; margin-bottom: 0.8rem;"></div>
                <div class="skeleton-pulse" style="width: 90%; height: 20px; border-radius: 4px; margin-bottom: 0.8rem;"></div>
                <div class="skeleton-pulse" style="width: 70%; height: 20px; border-radius: 4px;"></div>
            </div>
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.show-detail')
            ->layout('components.layouts.app', [
                'title' => $this->show->meta_title ?? $this->show->title . ' | NafunaTV',
                'metaDescription' => $this->show->meta_description ?? $this->show->description
            ]);
    }
}
