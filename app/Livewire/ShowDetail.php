<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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

    public function render()
    {
        return view('livewire.show-detail')
            ->layout('components.layouts.app', [
                'title' => $this->show->meta_title ?? $this->show->title . ' | NafunaTV',
                'metaDescription' => $this->show->meta_description ?? $this->show->description
            ]);
    }
}
