<?php

namespace App\Http\Controllers;

use App\Models\FadhilBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{

    public function index()
    {
        $books = FadhilBooks::latest()->paginate(6);
        return view('books.home', compact('books'));
    }


    public function search(Request $request)
    {
        $searchTerm = $request->query('query');

        $books = FadhilBooks::with('category')
            ->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%$searchTerm%")
                    ->orWhere('author', 'like', "%$searchTerm%")
                    ->orWhereHas('category', function ($subQ) use ($searchTerm) {
                        $subQ->where('name', 'like', "%$searchTerm%");
                    });
            })
            ->latest()
            ->paginate(6);

        return view('books.home', compact('books'));
    }



    public function detail($id)
    {
        // Eager load relasi 'category' dan 'reviews' beserta 'user' dari setiap review
        $book = FadhilBooks::with(['category', 'reviews.user'])->findOrFail($id);

        // Cek apakah user yang sedang login sudah pernah mereview buku ini
        $userHasReviewed = false;
        if (Auth::check()) {
            $userHasReviewed = $book->reviews()->where('user_id', Auth::id())->exists();
        }

        return view('books.detail', compact('book', 'userHasReviewed'));
    }


    public function byCategory($id)
    {
        $category = \App\Models\FadhilCategory::findOrFail($id);
        $books = \App\Models\FadhilBooks::where('category_id', $id)->latest()->paginate(6);

        return view('books.home', compact('books', 'category'));
    }
}
