<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LayananHotel;

class LayananDisplay extends Component
{
    public $selectedCategory = 'makanan';
    public $layanans;

    public function mount()
    {
        $this->fetchLayananByCategory();
    }

    public function fetchLayananByCategory()
    {
        $this->layanans = LayananHotel::where('kategori', $this->selectedCategory)->get();
    }

    public function setCategory($category)
    {
        $this->selectedCategory = $category;
        $this->fetchLayananByCategory();
    }

    public function render()
    {
        return view('livewire.layanan-display');
    }
}
