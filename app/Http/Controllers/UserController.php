<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($username)
    {
        $user = User::with('reviews.content')->whereUsername($username)->firstOrFail();
        return view('user.profile', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function destroy(User $user)
    {
        // Anonymize user's reviews
        $user->reviews()->update(['user_id' => null, 'username' => 'user deleted']);

        // Delete the user
        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }


}
