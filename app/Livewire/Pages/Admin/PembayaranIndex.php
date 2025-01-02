<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;

class PembayaranIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.pembayaran-index')->layout('layouts.admin');
    }
}
