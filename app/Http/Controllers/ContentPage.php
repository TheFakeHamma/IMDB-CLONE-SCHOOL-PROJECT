<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Person;

class ContentPage extends Controller
{
    public function show($id)
    {
        // Fetch the content item by its ID
        $content = Content::with('genres', 'people')->findOrFail($id);

        // Load the roles for each person
        foreach ($content->people as $person) {
            $role = $person->pivot->role;
            $person->role = $role;
        }

        return view('content-page', compact('content'));
    }
}

