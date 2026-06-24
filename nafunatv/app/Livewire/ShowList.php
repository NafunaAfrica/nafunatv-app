<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class ShowList extends Component
{
    public function render()
    {
        $categories = Category::with('shows')->get();
        return view('livewire.show-list', compact('categories'))
            ->layout('components.layouts.app');
    }
}
