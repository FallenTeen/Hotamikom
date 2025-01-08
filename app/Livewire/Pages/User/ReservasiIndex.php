<?php

namespace App\Livewire\Pages\User;

use Livewire\Component;

class ReservasiIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.user.reservasi-index')->layout('layouts.user');
    }
}
