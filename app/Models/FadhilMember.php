<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FadhilMember extends Model
{
    protected $table = 'fadhil_members';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function loans()
    {
        return $this->hasMany(FadhilLoan::class, 'member_id');
    }
}
