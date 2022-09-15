<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function address()
    {
        return $this->belongsTo('\App\Models\Address');
    }
    public function receipt()
    {
        return $this->hasMany('\App\Models\Receipt');
    }
}
