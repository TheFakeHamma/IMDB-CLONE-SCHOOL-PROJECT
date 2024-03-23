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
        return view('admin.users.user-settings', compact('users'));
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
        return view('admin.people.people-settings', compact('people'));
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
        return view('admin.contents.contents-settings', compact('contents', 'genres'));
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

        return redirect()->route('admin.contents.index')->with('success', 'Content created successfully.');
    }

    public function editContent($id)
    {
        $content = Content::with('genres')->findOrFail($id);
        $allGenres = Genre::all();
        return view('admin.contents.edit', compact('content', 'allGenres'));
    }

    public function updateContent(Request $request, $id)
    {

        Validator::extend('dataurl', function ($attribute, $value, $parameters, $validator) {
            if (str_starts_with($value, 'data:image') && preg_match('/^data:image\/(\w+);base64,/', $value)) {
                return true;
            }
            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        });

        $content = Content::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'synopsis' => 'required|string',
            'type' => 'required|in:movie,tv_show',
            'photo_url' => 'required|dataurl',
            'trailer_url' => 'required|url',
            'genres' => 'required|array|min:1',
        ]);

        $content->update($validatedData);

        $content->genres()->sync($validatedData['genres']);

        return redirect()->route('admin.contents.index')->with('success', 'Content updated successfully.');
    }

    public function destroyContent($id)
    {
        $content = Content::findOrFail($id);
    
        $content->people()->detach();
        $content->genres()->detach();
    
        $content->delete();

        return redirect()->route('admin.contents.index')->with('success', 'Content deleted successfully.');
    }

    public function manageCast($contentId, Request $request)
    {
        $content = Content::with('people')->findOrFail($contentId);
        $genres = Genre::all();

        $searchCurrentCast = $request->query('search_current_cast');
        $currentCastQuery = $content->people()->withPivot('role');
        if ($searchCurrentCast) {
            $currentCastQuery->where('name', 'like', '%'.$searchCurrentCast.'%');
        }
        $currentCast = $currentCastQuery->paginate(10);

        $searchAddCast = $request->query('search_add_cast');

        $currentCastIds = $content->people->pluck('id')->toArray();

        $allPeople = Person::whereNotIn('id', $currentCastIds)
                            ->when($searchAddCast, function ($query) use ($searchAddCast) {
                                return $query->where('name', 'like', '%'.$searchAddCast.'%');
                            })
                            ->paginate(10);

        return view('admin.contents.manageCast', compact('content', 'currentCast', 'allPeople', 'genres'));
    }

    public function addCastMember(Request $request, $contentId)
    {
        $content = Content::findOrFail($contentId);
        $personId = $request->input('person_id');
        $role = $request->input('role');

        $content->people()->attach($personId, ['role' => $role]);

        return back()->with('success', 'Cast member added.');
    }

    public function removeCastMember($contentId, $personId)
    {
        $content = Content::findOrFail($contentId);

        $content->people()->detach($personId);

        return back()->with('success', 'Cast member removed.');
    }

    public function updateCastRole(Request $request, $contentId, $personId)
    {
        $content = Content::findOrFail($contentId);
        $role = $request->input('role');

        $content->people()->updateExistingPivot($personId, ['role' => $role]);

        return back()->with('success', 'Cast role updated successfully.');
    }

    public function genresIndex()
    {
        $genres = Genre::all();
        return view('admin.genres.genres-settings', compact('genres'));
    }

    public function genreCreate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre = new Genre;
        $genre->name = $validatedData['name'];
        $genre->save();

        return redirect()->route('admin.genres.index')->with('success', 'Genre created successfully.');
    }

    public function genreUpdate(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->update($validatedData);

        return redirect()->route('admin.genres.index')->with('success', 'Genre updated successfully.');
    }

    public function genreDestroy($id)
    {
        $genre = Genre::findOrFail($id);

        $genre->contents()->detach();

        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'Genre deleted successfully.');
    }
}
