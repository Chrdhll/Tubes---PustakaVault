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
    public function index()
    {
        $member = FadhilMember::where('user_id', Auth::id())->first();

        if (!$member) {
            return redirect()->route('books.index')->with('error', 'Anda belum terdaftar sebagai member.');
        }

        $loans = FadhilLoan::with(['book', 'member'])
            ->where('member_id')
            ->get();

        return view('loans.index', compact('loans'));
    }

    public function borrow(FadhilBooks $book)
    {
        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis.');
        }

        $member = FadhilMember::where('user_id', Auth::id())->first();

        if (!$member) {
            return back()->with('error', 'Anda belum terdaftar sebagai member.');
        }

        FadhilLoan::create([
            'book_id' => $book->id,
            // 'member_id' => $member->id,
            'loan_date' => Carbon::now(),
            'return_date' => null,
            'status' => 'borrowed',
        ]);

        $book->decrement('stock');

        return redirect()->route('loans.index')->with('success', 'Berhasil meminjam buku.');
    }
}
