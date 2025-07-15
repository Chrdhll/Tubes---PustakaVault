<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FadhilCategory extends Model
{
    protected $table = 'fadhil_categories';

    protected $fillable = [
        'name',
    ];

    public function books()
    {
        return $this->belongsToMany(\App\Models\FadhilBooks::class, 'fadhil_book_category', 'fadhil_category_id', 'fadhil_books_id');
    }
}
