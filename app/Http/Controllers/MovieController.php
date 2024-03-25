<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

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

        $watchListItems = collect();

        if (Auth::check()) {
            $watchListItems = Watchlist::where('user_id', Auth::id())
                ->where('watched', false)
                ->with('content.genres', 'content.reviews')
                ->take(5)
                ->get();
        }

        $topMovies = Content::where('type', 'movie')
            ->withAvg('reviews', 'rating')
            ->with('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->orderByDesc('release_date')
            ->take(5)
            ->get();

        $topGenres = Genre::withCount(['contents' => function($query) {
                $query->where('type', 'movie');
            }])->orderBy('contents_count', 'desc')
            ->take(5)
            ->get();

        return view('index', compact('movies', 'latestMovie', 'watchListItems', 'topMovies', 'topGenres'));
    }


    public function contents(Request $request)
    {
        $query = Content::query();

        $heading = 'All Content';

        
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

        
        if ($request->has('release_date_from') && $request->release_date_from != '') {
            $query->where('release_date', '>=', $request->release_date_from);
        }
        if ($request->has('release_date_to') && $request->release_date_to != '') {
            $query->where('release_date', '<=', $request->release_date_to);
        }

       
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhereHas('genres', function($query) use ($search) {
                          $query->where('name', 'LIKE', "%{$search}%");
                      });

                
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
