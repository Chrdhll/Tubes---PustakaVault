<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FadhilLoan extends Model
{
    use HasFactory;
    
    protected $table = 'fadhil_loans';

    protected $fillable = [
        'book_id',
        'member_id',
        'loan_date',
        'return_date',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(FadhilBooks::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
