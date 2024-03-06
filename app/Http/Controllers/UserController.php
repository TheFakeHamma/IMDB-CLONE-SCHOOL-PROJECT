<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($username)
    {
        $user = User::with('reviews.content')->whereUsername($username)->firstOrFail();
        return view('user.profile', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user(); // Only user owner can update user password
        Log::info('Initiating password update for user: ' . $user->id);

        // Validate the input
        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Debug: Log the hashed current password
        Log::debug('Hashed current password: ' . $user->password);

        // Check if the current password matches
        if (!Hash::check($validatedData['current_password'], $user->password)) {
           Log::warning('Current password mismatch for user: ' . $user->id);
           return back()->withErrors(['current_password' => 'Your current password does not match our records.']);
        }

       // Update the password
        $user->password = Hash::make($validatedData['password']);
        $user->save(); // Check later to fix this issue

       Log::info('Password updated successfully for user: ' . $user->id);
       return back()->with('success', 'Your password has been updated successfully.');
    }
    
    

    public function destroySelf(User $user)
    {
        if (auth()->id() !== $user->id) {
            abort(403);
        }

        // Anonymize user's reviews
        $user->reviews()->update(['user_id' => null]);

        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }

}
