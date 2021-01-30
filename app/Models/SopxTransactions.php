<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopxTransactions extends Model
{
    use HasFactory;

    const STATUS = ['PENDING' => 1, 'COMPLETED' => 2, 'REJECTED' => 3];
    const TYPE = ['PRODUCTION'=>1,'ADMIN_ACTION'=>2,];

    protected $table = 'sopx_transactions';

    protected $fillable = [
        'amount',
        'type',
        'status',
        'customer_id'
    ];
}
