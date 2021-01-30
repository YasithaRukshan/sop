<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'rate',
        'status',
    ];

   
    
}
