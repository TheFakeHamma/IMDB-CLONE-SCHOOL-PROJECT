<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Genre;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Content::where('type', 'movie')->get();
        $movies->each(function ($movie) {
            $movie->averageRating = $movie->reviews->avg('rating') ?? 'No reviews';
        });

        $latestMovie = Content::where('type', 'movie')->latest('release_date')->first();
        if ($latestMovie) {
            $latestMovie->averageRating = $latestMovie->reviews->avg('rating') ?? 'No reviews';
        }

        return view('index', compact('movies', 'latestMovie'));
    }


    public function contents(Request $request)
    {
        $query = Content::query();

        $heading = 'All Content';

        // Adjust the heading based on the request parameters
        if ($request->filled('search')) {
            $heading = 'Search results for "' . $request->search . '"';
        } elseif ($request->filled('genre')) {
            $heading = 'Filtered';
        } elseif ($request->has('type')) {
            $type = $request->input('type');
            $typeFormatted = ucfirst(str_replace('_', ' ', $type));
            $heading = "Show all $typeFormatted";
        }

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

        // Search filter
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhereHas('genres', function($query) use ($search) {
                          $query->where('name', 'LIKE', "%{$search}%");
                      });

                // Check if the search term is a year
                if (is_numeric($search)) {
                  $query->orWhereYear('release_date', '=', $search);
                }
            });
        }

        $contents = $query->with('reviews')->paginate(12);

        $genres = Genre::all();
        $types = Content::select('type')->distinct()->get();

        return view('contents', compact('contents', 'genres', 'types'));
    }
}
