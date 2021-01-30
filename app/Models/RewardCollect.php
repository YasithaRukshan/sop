<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardCollect extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'reward_id',
        'amount'
    ];

    /**
     * wallet
     *
     * @return void
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }
    /**
     * reward
     *
     * @return void
     */
    public function reward()
    {
        return $this->belongsTo(Reward::class, 'wallet_id');
    }
}
