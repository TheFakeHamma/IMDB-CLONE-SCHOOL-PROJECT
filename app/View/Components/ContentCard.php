<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContentCard extends Component
{
    public $title;
    public $photoUrl;
    public $releaseDate;
    public $averageRating;
    public $id;

    public function __construct($title, $photoUrl, $releaseDate, $averageRating = null, $id)
    {
        $this->title = $title;
        $this->photoUrl = $photoUrl;
        $this->releaseDate = $releaseDate;
        $this->averageRating = $averageRating;
        $this->id = $id;
    }

    public function render()
    {
        return view('components.content-card');
    }
}

