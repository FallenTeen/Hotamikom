<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminLayout extends Component
{

    public function render(): View
    {
        return view('layouts.admin');
    }
}
