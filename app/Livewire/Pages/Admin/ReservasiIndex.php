<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;

class ReservasiIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.reservasi-index')->layout('layouts.admin');
    }
}
