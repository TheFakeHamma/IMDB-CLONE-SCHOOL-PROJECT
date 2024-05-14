<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroMovie extends Component
{
    public $title;
    public $photoUrl;
    public $releaseDate;
    public $synopsis;
    public $id;
    public $averageRating;

    public function __construct($title, $releaseDate, $synopsis, $id, $averageRating=null)
    {
        $this->title = $title;
        // $this->photoUrl = $photoUrl;
        $this->releaseDate = $releaseDate;
        $this->synopsis = $synopsis;
        $this->id = $id;
        $this->averageRating = $averageRating;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero-movie');
    }
}
