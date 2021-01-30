<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardRedemption extends Model
{
    use HasFactory;

    const TYPES = ['CONVERT' => 1, 'TRANSFER' => 2];
    const ACCTYPES = ['BTC' => 1, 'ETH' => 2, 'SOAX' => 3];
    const STATUS = ['PENDING' => 1, 'CONFIRMED' => 2, 'DECLINED' => 3,];


    protected $table = 'reward_redemption';

    protected $fillable = [
        'amount',
        'address',
        'type',
        'status',
        'wallet_id',
        'red_amount',
        'w_charges',
        'acc_type',
        'rq_amount',
        'eth_rate_id'
    ];

    /**
     * get wallet data
     *
     * @return void
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

    /**
     * ethRate
     *
     * @return void
     */
    public function ethRate()
    {
        return $this->belongsTo(EthRate::class, 'eth_rate_id');
    }
}
