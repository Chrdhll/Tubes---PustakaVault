<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BooksController::class, 'index'])->name('books.index');
Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');
Route::get('/books/{id}/detail', [BooksController::class, 'detail'])->name('books.detail');
Route::get('/books/{id}/pinjam', [BooksController::class, 'borrow'])->name('books.borrow');
Route::get('/books/category/{id}', [BooksController::class, 'byCategory'])->name('books.category');
