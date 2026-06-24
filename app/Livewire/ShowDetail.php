<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Show;

class ShowDetail extends Component
{
    public $show;

    public function mount($slug)
    {
        $this->show = Show::where('slug', $slug)->firstOrFail();
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
