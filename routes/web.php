<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');

Route::get('/search', [AnimalController::class, 'search'])->name('movies.search');

// Route::get('/movies', [MovieController::class, 'topRated'])->name('movie.top-rated-movies');
