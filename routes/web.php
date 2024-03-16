<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
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
 });
 
 // Admin specific routes
 Route::middleware(['auth', 'can:manage-users'])->group(function () {
     Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
     Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
     Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
     Route::get('/admin/people', [AdminController::class, 'peopleIndex'])->name('admin.people.index');
     Route::put('/admin/people/{person}', [AdminController::class, 'updatePerson'])->name('admin.person.update');

 });
 
 
 