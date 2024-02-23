<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReviewCard extends Component
{
    public $review;

    public function __construct($review)
    {
        $this->review = $review;
    }

    public function render()
    {
        return view('components.review-card');
    }
}
