<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Genre;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('dataurl', function ($attribute, $value, $parameters, $validator) {
            if (str_starts_with($value, 'data:image') && preg_match('/^data:image\/(\w+);base64,/', $value)) {
                return true;
            }
            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        });

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'photo_url' => 'required|dataurl',
        ]);
        
        $person->name = $validatedData['name'];
        $person->bio = $validatedData['bio'];
        $person->photo_url = $validatedData['photo_url'];
        $person->save();

        return redirect()->route('admin.people.index')->with('success', 'Person updated successfully.');
    }

    public function createPerson(Request $request)
    {
        Validator::extend('dataurl', function ($attribute, $value, $parameters, $validator) {
            if (str_starts_with($value, 'data:image') && preg_match('/^data:image\/(\w+);base64,/', $value)) {
                return true;
            }
            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        });

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'photo_url' => 'required|dataurl',
        ]);

        $person = new Person;
        $person->name = $validatedData['name'];
        $person->bio = $validatedData['bio'];
        $person->photo_url = $validatedData['photo_url'];
        $person->save();

        return redirect()->route('admin.people.index')->with('success', 'Person created successfully.');
    }

    public function destroyPerson($id)
    {
        $person = Person::findOrFail($id);

        $person->delete();

        return redirect()->route('admin.people.index')->with('success', 'Person deleted successfully.');
    }

    public function contentsIndex()
    {
        $contents = Content::all();
        $genres = Genre::all();
        return view('contents-settings', compact('contents', 'genres'));
    }

    public function createContent(Request $request)
    {
        Validator::extend('dataurl', function ($attribute, $value, $parameters, $validator) {
            if (str_starts_with($value, 'data:image') && preg_match('/^data:image\/(\w+);base64,/', $value)) {
                return true;
            }
            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        });

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'synopsis' => 'required|string',
            'type' => 'required|in:movie,tv_show',
            'photo_url' => 'required|dataurl',
            'trailer_url' => 'required|url',
            'genres' => 'required|array|min:1', // Make sure at least one genre is selected
        ]);

        $content = new Content;
        $content->title = $validatedData['title'];
        $content->release_date = $validatedData['release_date'];
        $content->synopsis = $validatedData['synopsis'];
        $content->type = $validatedData['type'];
        $content->photo_url = $validatedData['photo_url'];
        $content->trailer_url = $validatedData['trailer_url'];
        $content->save();

        // Attach genres to the content
        $content->genres()->sync($validatedData['genres']);

        return redirect()->route('admin.contents.index')->with('success', 'Person created successfully.');
    }
}
