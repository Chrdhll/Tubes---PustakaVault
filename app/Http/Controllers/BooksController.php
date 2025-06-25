<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FadhilBooks;

class BooksController extends Controller
{

    public function index()
    {
        $books = FadhilBooks::latest()->paginate(6);
        return view('books.home', compact('books'));
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $books = FadhilBooks::where('title', 'like', "%$query%")
            ->orWhere('author', 'like', "%$query%")
            ->paginate(6);
        return view('books.home', compact('books'));
    }


    public function detail($id)
    {
        $book = FadhilBooks::with('category')->findOrFail($id);
        return view('books.detail', compact('book'));
    }


    public function borrow($id)
    {
        $book = FadhilBooks::findOrFail($id);
        return view('books.borrow', compact('book'));
    }

    public function byCategory($id)
    {
        $category = \App\Models\FadhilCategory::findOrFail($id);
        $books = \App\Models\FadhilBooks::where('category_id', $id)->latest()->paginate(6);

        return view('books.home', compact('books', 'category'));
    }
}
