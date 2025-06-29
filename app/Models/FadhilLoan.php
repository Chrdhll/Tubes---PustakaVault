<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FadhilLoan extends Model
{
    use HasFactory;
    
    protected $table = 'fadhil_loans';

    protected $fillable = [
        'book_id',
        'user_id',
        'loan_date',
        'return_date',
        'status',
        'due_date',
        'fine_amount'
    ];

    public function book()
    {
        return $this->belongsTo(FadhilBooks::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsOverdueAttribute(): bool
    {
        // Kondisinya: statusnya masih 'dipinjam' DAN tanggal hari ini sudah melewati tanggal jatuh tempo
        return $this->status === 'borrowed' && Carbon::now()->greaterThan($this->due_date);
    }

    public function getCurrentFineAttribute(): int
    {
        if (!$this->is_overdue) {
            return 0; // Jika tidak telat, tidak ada denda
        }

        // Hitung selisih hari antara hari ini dengan tanggal jatuh tempo
        $overdueDays = Carbon::now()->diffInDays($this->due_date);

        // Aturan denda: Rp 1.000 per hari keterlambatan
        $finePerDay = 1000;

        return $overdueDays * $finePerDay;
    }
    
}
