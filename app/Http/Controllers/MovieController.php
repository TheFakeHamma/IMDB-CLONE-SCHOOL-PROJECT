<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        $movies = Content::where('type', 'movie')->take(8)->get();
        return view('index', compact('contents', 'movies'));
    }
}
