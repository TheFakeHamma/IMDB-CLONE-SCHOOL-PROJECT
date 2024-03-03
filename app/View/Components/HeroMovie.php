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

    public function __construct($title, $releaseDate, $synopsis, $id)
    {
        $this->title = $title;
        // $this->photoUrl = $photoUrl;
        $this->releaseDate = $releaseDate;
        $this->synopsis = $synopsis;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero-movie');
    }
}
