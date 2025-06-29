<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FadhilReview extends Model
{
    use HasFactory;

    protected $table = 'fadhil_reviews';

    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        // Ganti App\Models\Book dengan nama model bukumu jika berbeda
        return $this->belongsTo(FadhilBooks::class, 'book_id');
    }
}