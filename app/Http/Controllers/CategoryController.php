<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FadhilBooks;
use App\Models\FadhilCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = FadhilCategory::all();
        return view('category.category', compact('categories'));
    }

    public function show($id)
    {
        $category = FadhilCategory::findOrFail($id);
        $books = FadhilBooks::where('category_id', $id)->paginate(6);
        return view('books.home', compact('books', 'category'));
    }
}
