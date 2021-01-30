<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

        const TYPES = ['convert'=>1,'transfer'=>2];
        const ACCTYPES = ['BTC'=>1,'ETH'=>2,'SOAX'=>3,'DIRECT'=>4];
        const STATUS = ['PENDING'=>1,'CONFIRMED'=>2,'DECLINED'=>3,];

    protected $fillable = [
        'sopx_amount',
        'recipient_address',
        'withdraw_type',
        'acc_type',
        'customer_id',
        'status',
        'reject_reason',
        'wallet_id',
        'w_amount',
        'w_charges'
    ];

    /**
     * get customer id
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    /**
     * deposits
     *
     * @return void
     */
    public function transactions()
    {
        return $this->hasMany(WalletDeposit::class, 'wallet_id');
    }
    /**
     * settings
     *
     * @return void
     */
    public function settings()
    {
        return $this->hasOne(WithdrawalSettings::class, 'wallet_id');
    }
}
