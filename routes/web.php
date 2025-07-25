<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BooksController::class, 'index'])->name('books.index');
Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');
Route::get('/books/{book}/detail', [BooksController::class, 'detail'])->name('books.detail');
Route::get('/books/{book}/detail-page', [BooksController::class, 'showDetailPage'])->name('books.detail_page');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('books.category');

Route::middleware('auth')->group(function () {
    Route::get('/pinjaman-saya', [LoanController::class, 'index'])->name('pinjam.index');

    Route::get('/pinjam/{book}/konfirmasi', [LoanController::class, 'create'])->name('pinjam.create');

    Route::post('/borrowings/{book}', [LoanController::class, 'store'])->name('loans.borrow');
    Route::put('/pinjaman-saya/{loan}/kembalikan', [LoanController::class, 'update'])->name('pinjam.return');
    Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
