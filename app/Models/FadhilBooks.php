<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FadhilBooks extends Model
{
    use HasFactory;

    protected $table = 'fadhil_books';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'blurb',
        'stock',
        'image',
        'year',
    ];

    protected static function booted()
    {
        static::deleting(function ($book) {
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }
        });
    }

    public function categories()
    {
        return $this->belongsToMany(FadhilCategory::class, 'fadhil_book_category', 'fadhil_books_id', 'fadhil_category_id');
    }

    // Satu Buku bisa memiliki banyak peminjaman (loans)
    public function loans()
    {
        return $this->hasMany(FadhilLoan::class);
    }

    // Satu Buku bisa memiliki banyak ulasan (reviews)
    public function reviews()
    {
        return $this->hasMany(FadhilReview::class, 'book_id');
    }
}
