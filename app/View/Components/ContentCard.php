<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContentCard extends Component
{
    public $title;
    public $photoUrl;
    public $releaseDate;

    public function __construct($title, $photoUrl, $releaseDate)
    {
        $this->title = $title;
        $this->photoUrl = $photoUrl;
        $this->releaseDate = $releaseDate;
    }

    public function render()
    {
        return view('components.content-card');
    }
}

