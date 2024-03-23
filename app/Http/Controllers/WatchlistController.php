<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Genre;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function index(Request $request)
    {
        $query = Watchlist::query()->with('content.genres', 'content.reviews');

        $query->where('user_id', auth()->id());

        if ($genres = $request->input('genres')) {
            $query->whereHas('content.genres', function ($query) use ($genres) {
                $query->whereIn('id', $genres);
            });
        }

        if ($type = $request->input('type')) {
            $query->whereHas('content', function ($query) use ($type) {
                $query->where('type', $type);
            });
        }

        if ($releaseDateFrom = $request->input('release_date_from')) {
            $query->whereHas('content', function ($query) use ($releaseDateFrom) {
                $query->where('release_date', '>=', $releaseDateFrom);
            });
        }

        if ($releaseDateTo = $request->input('release_date_to')) {
            $query->whereHas('content', function ($query) use ($releaseDateTo) {
                $query->where('release_date', '<=', $releaseDateTo);
            });
        }

        if ($watchedStatus = $request->input('watched_status')) {
            switch ($watchedStatus) {
                case 'watched':
                    $query->where('watched', true);
                    break;
                case 'not_watched':
                    $query->where('watched', false);
                    break;
                case 'all':
                default:
                    break;
            }
        }

        $watchlistItems = $query->paginate(10);

        $genres = Genre::all();
        $types = ['movie', 'tv_show'];

        return view('user.watchlist', compact('watchlistItems', 'genres', 'types'));
    }

    public function addToWatchlist($contentId)
    {
        $userId = Auth::id();
        Watchlist::create([
            'user_id' => $userId,
            'content_id' => $contentId,
        ]);

        return back()->with('success', 'Content added to your watchlist.');
    }

    public function markAsWatched($contentId)
    {
        $userId = Auth::id();
        $watchlistItem = Watchlist::where('user_id', $userId)->where('content_id', $contentId)->firstOrFail();
        $watchlistItem->update(['watched' => true]);

        return back()->with('success', 'Content marked as watched.');
    }

    public function markAsNotWatched($contentId)
    {
        $userId = Auth::id();
        $watchlistItem = Watchlist::where('user_id', $userId)->where('content_id', $contentId)->firstOrFail();
        $watchlistItem->update(['watched' => false]);

        return back()->with('success', 'Content marked as not watched.');
    }

    public function removeFromWatchlist($contentId)
    {
        $userId = Auth::id();
        Watchlist::where('user_id', $userId)->where('content_id', $contentId)->delete();

        return back()->with('success', 'Content removed from your watchlist.');
    }
}
