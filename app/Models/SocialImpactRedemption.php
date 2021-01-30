<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialImpactRedemption extends Model
{
    use HasFactory;

    const TYPES = ['convert' => 1, 'transfer' => 2];
    const ACCTYPES = ['BTC' => 1, 'ETH' => 2, 'SOAX' => 3];
    const STATUS = ['PENDING' => 1, 'CONFIRMED' => 2, 'DECLINED' => 3,];


    protected $table = 'social_impact_redemptions';

    protected $fillable = [
        'amount',
        'address',
        'type',
        'status',
        'customer_id',
        'redemptionAmount',
        'w_charges',
        'acc_type',
        'rq_amount'
    ];
}
