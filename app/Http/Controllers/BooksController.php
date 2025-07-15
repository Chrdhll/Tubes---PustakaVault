<?php

namespace App\Http\Controllers;

use App\Models\FadhilBooks;
use App\Models\FadhilLoan;
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

        $books = FadhilBooks::with('categories')
            ->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%$searchTerm%")
                    ->orWhere('author', 'like', "%$searchTerm%")
                    ->orWhereHas('categories', function ($subQ) use ($searchTerm) {
                        $subQ->where('name', 'like', "%$searchTerm%");
                    });
            })
            ->latest()
            ->paginate(6);

        return view('books.home', compact('books'));
    }



    public function detail(FadhilBooks $book)
    {
        $book->load('categories', 'reviews.user');

        $user_can_review = false;
        $user_has_reviewed = false;

        // Cek apakah user yang sedang login sudah pernah mereview buku ini
        if (Auth::check()) {
            // Cek apakah user sudah pernah mereview
            $user_has_reviewed = $book->reviews()->where('user_id', Auth::id())->exists();

            // Cek apakah user boleh mereview (pernah pinjam & belum mereview)
            if (!$user_has_reviewed) {
                $user_can_review = FadhilLoan::where('user_id', Auth::id())
                    ->where('book_id', $book->id)
                    ->where('status', 'returned')
                    ->exists();
            }
        }

        return view('books.detail', compact('book', 'user_can_review', 'user_has_reviewed'));
    }
    public function showDetailPage(FadhilBooks $book)
    {
        $book->load('categories', 'reviews.user');

        $user_can_review = false;
        $user_has_reviewed = false;

        // Cek apakah user yang sedang login sudah pernah mereview buku ini
        if (Auth::check()) {
            // Cek apakah user sudah pernah mereview
            $user_has_reviewed = $book->reviews()->where('user_id', Auth::id())->exists();

            // Cek apakah user boleh mereview (pernah pinjam & belum mereview)
            if (!$user_has_reviewed) {
                $user_can_review = FadhilLoan::where('user_id', Auth::id())
                    ->where('book_id', $book->id)
                    ->where('status', 'returned')
                    ->exists();
            }
        }

        return view('books.detail_page', compact('book', 'user_can_review', 'user_has_reviewed'));
    }


    // Versi SETELAH Perbaikan
    public function byCategory($id)
    {
        $category = \App\Models\FadhilCategory::findOrFail($id);
        $books = $category->books()->latest()->paginate(6);
        return view('books.home', compact('books', 'category'));
    }
}
