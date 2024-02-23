<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($username)
    {
        $user = User::with('reviews.content')->whereUsername($username)->firstOrFail();
        return view('user.profile', compact('user'));
    }
}
