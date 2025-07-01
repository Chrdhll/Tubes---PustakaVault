<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReviewController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BooksController::class, 'index'])->name('books.index');
Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');
Route::get('/books/{id}/detail', [BooksController::class, 'detail'])->name('books.detail');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('books.category');

Route::middleware('auth')->group(function () {
    Route::get('/pinjaman-saya', [LoanController::class, 'index'])->name('pinjam.index');

    Route::get('/pinjam/{book}/konfirmasi', [LoanController::class, 'create'])->name('pinjam.create');

    Route::post('/borrowings/{book}', [LoanController::class, 'store'])->name('loans.borrow');
    Route::put('/pinjaman-saya/{loan}/kembalikan', [LoanController::class, 'update'])->name('pinjam.return');
    Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])
     ->name('reviews.store')
     ->middleware('auth');
});

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
