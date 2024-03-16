<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PersonCard extends Component
{
    public $name;
    public $bio;
    public $photoUrl;
    public $id;
    public function __construct($name, $bio, $photoUrl, $id)
    {
        $this->name = $name;
        $this->bio = $bio;
        $this->photoUrl = $photoUrl;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.person-card');
    }
}
