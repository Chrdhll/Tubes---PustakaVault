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
        if (Auth::user()->role !== 'member') {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }
        $loans = FadhilLoan::where('user_id', Auth::id())
            ->with('book')
            ->latest()
            ->get();

        return view('loans.index', ['loans' => $loans]);
    }

    public function create(FadhilBooks $book)
    {
        if (Auth::user()->role !== 'member') {
            abort(403, 'HANYA MEMBER YANG BISA MEMINJAM BUKU.');
        }
        // Pengecekan stok lagi untuk keamanan
        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok buku untuk dipinjam sudah habis!');
        }

        // Tampilkan view 'pinjam.konfirmasi' dan kirim data buku ke sana
        return view('loans.konfirmasi', ['book' => $book]);
    }

    public function store(Request $request, FadhilBooks $book)
    {

        if (Auth::user()->role !== 'member') {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        $existingLoan = FadhilLoan::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->exists();

        if ($existingLoan) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini dan belum mengembalikannya.');
        }

        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok buku ini sudah habis!');
        }

        $loan = new FadhilLoan();
        $loan->book_id = $book->id;
        $loan->user_id = Auth::id();
        $loan->loan_date = now();
        $loan->due_date = now()->addDays(14);
        $loan->save();

        $book->decrement('stock');

        $message = "Buku '{$book->title}' berhasil dipinjam! Anda bisa melihatnya di daftar ini.";

        return redirect()->route('pinjam.index')->with('success', $message);
    }

    public function update(Request $request, FadhilLoan $loan)
    {
        if (Auth::user()->role !== 'member') {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        if (Auth::id() !== $loan->user_id) {
            abort(403, 'AKSES DITOLAK'); // Hentikan proses jika bukan pemilik
        }

        $loan->status = 'returned';
        $loan->return_date = now(); // Catat tanggal kembali adalah hari ini
        $loan->save();

        $loan->book->increment('stock');
        $successMessage = "Buku '{$loan->book->title}' berhasil dikembalikan. Terima kasih!";

        return redirect()->route('pinjam.index')
            ->with('success', $successMessage)
            ->with('show_review_prompt', [
                'book_title' => $loan->book->title,
                'detail_url' => route('books.detail_page', $loan->book->id)
            ]);
    }
}
