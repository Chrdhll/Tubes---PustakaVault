<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FadhilLoan;
use App\Models\FadhilBooks;
use App\Models\FadhilMember;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function store(Request $request, FadhilBooks $book)
    {
        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok buku ini sudah habis!');
        }

        $loan = new FadhilLoan();
        $loan->book_id = $book->id;
        $loan->user_id = Auth::id();
        $loan->loan_date = now();

        $loan->save();

        $book->decrement('stock');

        return redirect()->back()->with('success', 'Buku berhasil dipinjam!');
    }
}
