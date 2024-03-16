<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Person;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        $type = $request->input('searchType');
        $genres = Genre::all();
        $types = Content::select('type')->distinct()->get();
        
        if ($type == 'people') {
            $people = Person::where('name', 'LIKE', "%$query%")->paginate(12);
            return view('people', compact('people'));
        } else {
            $contents = Content::where('title', 'LIKE', "%$query%")
                ->orWhereHas('genres', function($q) use ($query) {
                    $q->where('name', 'LIKE', "%$query%");
                })
                ->with('reviews')
                ->paginate(12);

            return view('contents', compact('contents', 'genres', 'types', 'query', 'type'));
        }
    }
}