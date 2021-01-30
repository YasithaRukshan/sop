<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'code',
        'type',
    ];

}
