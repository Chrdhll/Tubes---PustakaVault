<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FadhilLoan extends Model
{
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

    public function member()
    {
        return $this->belongsTo(FadhilMember::class, 'member_id');
    }
    
}
