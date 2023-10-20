<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\OwnerController;
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




Route::get('/animals/create', [AnimalController::class, 'create'])->name('animals.create'); // we give it a name movies.create
Route::post('/animals', [AnimalController::class, 'store'])->name('animals.store'); // we give it a name movies.create
// using post we can just use movies in the url



Route::get('/animals/{animal}/edit', [AnimalController::class, 'edit'])->whereNumber('animal')->name('animals.edit');
Route::put('/animals/{animal}', [AnimalController::class, 'update'])->whereNumber('animal')->name('animals.update');
Route::delete('/animals/{animal}', [AnimalController::class, 'destroy'])->whereNumber('animal')->name('animals.destroy');
// ************DETAILS ROUTE***********************
Route::get('/animals/{animal_id}', [AnimalController::class, 'details'])->name('animals.details');

Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
