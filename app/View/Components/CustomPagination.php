<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Livewire\WithPagination;

class CustomPagination extends Component
{
    use WithPagination;

    public $currentPage = 1, $paginator;
    /**
     * Create a new component instance.
     */
    public function __construct($paginator = null)
    {
        $this->paginator = $paginator;
    }

    public function gotoPage($page)
    {
        $this->paginator->setPage($page);
    }
    public function nextPage()
    {
        $this->paginator->nextPage();
    }
    public function previousPage()
    {
        $this->paginator->previousPage();
    }
    public function render(): View|Closure|string
    {
        return view('components.custom-pagination', [
            'paginator' => $this->paginator,
        ]);
    }

}
