<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Review;

class ReviewDisplay extends Component
{
    public function render()
    {
        // Fetch reviews ordered by rating in descending order
        $reviews = Review::with('user', 'reservasi')
            ->orderBy('rating', 'desc')
            ->get();

        // Return the view with reviews data
        return view('livewire.review-display', compact('reviews'));
    }
}
