<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo('\App\Models\Customer');
    }
}
