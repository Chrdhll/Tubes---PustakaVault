<?php

namespace App\Http\Controllers;

use App\Models\FadhilBooks;
use App\Models\FadhilLoan;
use App\Models\FadhilReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(Request $request, FadhilBooks $book)
    {
        // Cek dulu apakah user ini pernah meminjam buku ini
        $hasBorrowed = FadhilLoan::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'returned')
            ->exists();

        if (!$hasBorrowed) {
            // Jika tidak ada riwayat pinjaman, tolak dengan error 403 (Forbidden)
            return response()->json([
                'success' => false,
                'message' => 'Anda harus meminjam buku ini terlebih dahulu untuk memberi ulasan.'
            ], 403);
        }

        if (Auth::user()->role !== 'member') {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        $validator = Validator::make($request->all(), [
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $existingReview = FadhilReview::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->exists();

        if ($existingReview) {
            return response()->json(['success' => false, 'message' => 'Anda sudah pernah memberikan ulasan.'], 403);
        }

        $review = FadhilReview::create([
            'book_id' => $book->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $review->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas ulasan Anda!',
            'review' => $review
        ]);
    }
}
