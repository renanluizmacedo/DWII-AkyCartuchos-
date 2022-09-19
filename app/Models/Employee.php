<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "users";

    use HasFactory;


    public function role()
    {
        return $this->belongsTo('\App\Models\Role');
    }    
}
