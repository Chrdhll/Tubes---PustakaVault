<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BooksController::class, 'index'])->name('books.index');
Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');
Route::get('/books/{id}/detail', [BooksController::class, 'detail'])->name('books.detail');
Route::get('/books/{id}/pinjam', [BooksController::class, 'borrow'])->name('books.borrow');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('books.category');

