<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    use HasFactory;
    
    protected $table = "items";

    public function itemType()
    {
        return $this->belongsTo('\App\Models\itemType');
    }
}
