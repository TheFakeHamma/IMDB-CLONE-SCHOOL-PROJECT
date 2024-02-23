<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Genre;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Content::where('type', 'movie')->get(); // Fetch all movies
        $latestMovie = Content::where('type', 'movie')->latest('release_date')->first(); // Fetch the latest movie

        return view('index', compact('movies', 'latestMovie'));
    }

    public function contents(Request $request)
    {
        $query = Content::query();

        if ($request->filled('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->whereIn('name', $request->genre);
            });
        }

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Filter by release date range
        if ($request->has('release_date_from') && $request->release_date_from != '') {
            $query->where('release_date', '>=', $request->release_date_from);
        }
        if ($request->has('release_date_to') && $request->release_date_to != '') {
            $query->where('release_date', '<=', $request->release_date_to);
        }

        $contents = $query->paginate(12);
        $genres = Genre::all();
        $types = Content::select('type')->distinct()->get();

        return view('contents', compact('contents', 'genres', 'types'));
    }
}
