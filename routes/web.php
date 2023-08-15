<?php

use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/// method -> http request -> get , post
Route::get('/', function () {
    return view('welcome');
});

// create route /profile
Route::middleware(['auth', 'check-age'])->group(function () {
    // Route::get('books', [BookController::class, 'index'])->name('books.index');
    // Route::get('books/create', [BookController::class, 'create'])->name('books.create');
    // Route::post('books', [BookController::class, 'store'])->name('books.store');
    // Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
    // Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    // Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    // Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::resource('books', BookController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

