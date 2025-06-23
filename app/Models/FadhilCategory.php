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
        return $this->hasMany(FadhilBooks::class, 'category_id');
    }
}
