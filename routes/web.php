<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ContentPage;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MovieController::class, 'index'])->name('index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contents', [MovieController::class, 'contents'])->name('contents');
Route::get('/content/{id}', [ContentPage::class, 'show'])->name('content.show');
Route::get('/people', [PeopleController::class, 'people'])->name('people');
Route::get('/people/{id}', [PeopleController::class, 'show'])->name('people.show');
Route::get('/search', [SearchController::class, 'search'])->name('search');

// User specific routes
Route::middleware(['auth'])->group(function () {
     Route::get('/user/{username}', [UserController::class, 'show'])->name('user.profile');
     Route::put('/user/{username}/password', [UserController::class, 'updatePassword'])->name('user.password.update');
     Route::delete('/user/{user}', [UserController::class, 'destroySelf'])->name('user.delete.self');
     Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
     Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
     Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist');
     Route::post('/watchlist/add/{content}', [WatchlistController::class, 'addToWatchlist'])->name('watchlist.add');
     Route::post('/watchlist/watched/{content}', [WatchlistController::class, 'markAsWatched'])->name('watchlist.watched');
     Route::post('/watchlist/not-watched/{content}', [WatchlistController::class, 'markAsNotWatched'])->name('watchlist.not-watched');
     Route::delete('/watchlist/remove/{content}', [WatchlistController::class, 'removeFromWatchlist'])->name('watchlist.remove');
 });
 
 // Admin specific routes
 Route::middleware(['auth', 'can:manage-users', 'can:manage-content'])->group(function () {
     Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
     Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
     Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
     Route::get('/admin/people', [AdminController::class, 'peopleIndex'])->name('admin.people.index');
     Route::put('/admin/people/{person}', [AdminController::class, 'updatePerson'])->name('admin.person.update');
     Route::post('/admin/people', [AdminController::class, 'createPerson'])->name('admin.person.create');
     Route::delete('/admin/people/{person}', [AdminController::class, 'destroyPerson'])->name('admin.person.destroy');
     Route::get('/admin/contents', [AdminController::class, 'contentsIndex'])->name('admin.contents.index');
     Route::post('/admin/contents', [AdminController::class, 'createContent'])->name('admin.content.create');
     Route::get('/admin/contents/{content}/edit', [AdminController::class, 'editContent'])->name('admin.content.edit');
     Route::put('/admin/contents/{content}', [AdminController::class, 'updateContent'])->name('admin.content.update');
     Route::delete('/admin/contents/{content}', [AdminController::class, 'destroyContent'])->name('admin.content.destroy');
     Route::get('/admin/contents/{content}/manage-cast', [AdminController::class, 'manageCast'])->name('admin.manage.cast');
     Route::post('/admin/contents/{content}/cast', [AdminController::class, 'addCastMember'])->name('admin.cast.add');
     Route::delete('/admin/contents/{content}/cast/{person}', [AdminController::class, 'removeCastMember'])->name('admin.cast.remove');
     Route::put('/admin/contents/{content}/cast/{person}', [AdminController::class, 'updateCastRole'])->name('admin.cast.update');
 });