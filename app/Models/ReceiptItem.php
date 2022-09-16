<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    protected $table = "receipts_items";

    use HasFactory;
    public function receipt()
    {
        return $this->belongsTo('\App\Models\Receipt');
    }
    public function item()
    {
        return $this->belongsTo('\App\Models\item');
    }
}
