<?php

use App\Http\Controllers\ReviewController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MovieController::class, 'index'])->name('index');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contents', [MovieController::class, 'contents'])->name('contents');

Route::get('/content/{id}', [ContentPage::class, 'show'])->name('content.show');

Route::get('/user/{username}', [UserController::class, 'show'])
     ->name('user.profile');

Route::put('/user/{username}/password', [UserController::class, 'updatePassword'])
     ->name('user.password.update');

     //fix delete function
Route::delete('/user/{username}', [UserController::class, 'destroy'])
     ->name('user.delete')->middleware(['auth', 'can:delete,user']);

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy')->middleware('auth');
