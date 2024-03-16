<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function usersIndex()
    {
        $users = User::all();
        return view('user-settings', compact('users'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroyUser(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Anonymize user's reviews
        $user->reviews()->update(['user_id' => null]);

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function peopleIndex()
    {
        $people = Person::all();
        return view('people-settings', compact('people'));
    }

    public function updatePerson(Request $request, Person $person)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'photo_url' => 'required|url',
        ]);
        
        $person->name = $validatedData['name'];
        $person->bio = $validatedData['bio'];
        $person->photo_url = $validatedData['photo_url'];
        $person->save();

        return redirect()->route('admin.people.index')->with('success', 'Person updated successfully.');
    }
}
