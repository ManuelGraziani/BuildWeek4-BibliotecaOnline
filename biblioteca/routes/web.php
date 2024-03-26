<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/books/create', [\App\Http\Controllers\BookController::class, 'create'])->middleware(['auth', 'verified'])->name('books.create');

Route::middleware('auth')->group(function () {
    Route::get('/books', [\App\Http\Controllers\BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [\App\Http\Controllers\BookController::class, 'show'])->name('books.show');
    Route::post('/books', [\App\Http\Controllers\BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [\App\Http\Controllers\BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [\App\Http\Controllers\BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [\App\Http\Controllers\BookController::class, 'destroy'])->name('books.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
