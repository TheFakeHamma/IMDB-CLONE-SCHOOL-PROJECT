<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function people()
    {
        $people = Person::paginate(12); // 12 because makes sense on PC but double check on phone later
        return view('people', compact('people'));
    }

    public function show($id)
    {
        $person = Person::with(['contents' => function($query){
            $query->withPivot('role');
        }])->findOrFail($id);

        return view('person-page', compact('person'));
    }
}

