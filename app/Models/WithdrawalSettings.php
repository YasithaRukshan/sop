<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalSettings extends Model
{
    use HasFactory;


    protected $fillable = [
        'wallet_id',
        'rate',
        'status',
    ];

}
