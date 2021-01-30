<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETHTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_deposit_id',
        'transaction_id',
        'amount',
        'status',
    ];
}
