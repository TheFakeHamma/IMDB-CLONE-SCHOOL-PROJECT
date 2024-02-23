<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PeopleCard extends Component
{
    public $name;
    public $photoUrl;
    public $bio;
    public $role;

    public function __construct($name, $photoUrl, $bio, $role = null)
    {
        $this->name = $name;
        $this->photoUrl = $photoUrl;
        $this->bio = $bio;
        $this->role = $role;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.people-card');
    }
}
