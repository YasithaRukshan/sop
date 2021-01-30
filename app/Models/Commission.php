<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    const STATUS = ["PENDING"=>1, "CONFIRMED"=>2,"CHARGEDBACK"=>3,"CANCELED"=>4,];
    use HasFactory;
    protected $fillable = [
        'wallet_id',
        'parent_wallet_id',
        'transaction_id',
        'amount',
        'level',
        'status',
        'reason',
    ];

    /**
     * getByTrIdAndUserId
     *
     * @param  mixed $wallet_id
     * @param  mixed $transaction_id
     * @return void
     */
    public function getByTrIdAndUserId($wallet_id,$transaction_id){

        return $this->where('transaction_id',$transaction_id)->where('wallet_id',$wallet_id)->first();

    }

    /**
     * wallet
     *
     * @return void
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'parent_wallet_id');
    }
    /**
     * transaction
     *
     * @return void
     */
    public function transaction()
    {
        return $this->belongsTo(WalletTransaction::class, 'transaction_id');
    }    
    /**
     * commissionAuth
     *
     * @return void
     */
    public function commissionReferral()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }
}
