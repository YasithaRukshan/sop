<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WalletTransaction extends Model
{
    use HasFactory;

    const STATUS = [
        'PENDING' => 1,
        'COMPLETED' => 2,
        'REJECTED' => 3,
        'PAID' => 4,
        'CONFIRMED' => 5,
        'PARTIALLY_CONFIRMED' => 6,
        'CANCELLED' => 7,
        'OVER_CONFIRMED' => 8,
        'LATE_PAYMENT' => 9,
    ];
    const TYPE = [
        'ETH' => 1,
        'BTC' => 2,
        'SOPXAUTO' => 3,
        'SOPX' => 4,
        'ADMIN_ACTION' => 5,
        'AUTOCOMMISSIONS' => 6,
        'COMMISSIONS' => 7,
        'REWARD' => 8,
        'CAPP' => 9,
        'ZELLE' => 10,
    ];
    const PJOB = [
        "TRUE" => 1,
        "FALSE" => 0,
    ];
    protected $fillable = [
        'wallet_id',
        'amount',
        'rq_amount',
        'type',
        'status',
        'depkey',
        'address',
        'value',
        'gas',
        'thash',
        'admin_status',
        'soax_transferred',
        'pjob'
    ];

    /**
     * ethTransactions
     *
     * @return void
     */
    public function ethTransactions()
    {
        return $this->hasOne('App\Models\ETHTransaction', 'wallet_deposit_id');
    }
    /**
     * getByKey
     *
     * @param  mixed $key
     * @return void
     */
    public function getByKey($key, $status)
    {
        return $this->where('depkey', $key)->where('status', $status)->first();
    }


    /**
     * attempts
     * !important This method valid only for BTC
     * @return void
     */
    public function attempts()
    {
        return $this->hasMany('App\Models\WalletTransactionAttempt', 'wallet_transaction_id');
    }

    /**
     * paidValue
     * !important This method valid only for BTC
     * @return void
     */
    public function paidValue()
    {
        return $this->hasMany('App\Models\WalletTransactionAttempt', 'wallet_transaction_id')->sum('value');
    }

    /**
     * getByAddress
     * !important This method valid only for BTC
     * @param  mixed $address
     * @return void
     */
    public function getByAddress($address)
    {
        return $this->where('address', $address)->first();
    }
    /**
     * wallet
     *
     * @return void
     */
    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet', 'wallet_id');
    }
    /**
     * getByTypeAndAuth
     *
     * @param  mixed $type
     * @return void
     */
    public function getByTypeAndAuth($type)
    {
        return $this->where('type', $type)->where('wallet_id', Auth::user()->wallet->id)->sum('value');
    }
    /**
     * getWithAuth
     *
     * @param  mixed $id
     * @return void
     */
    public function getWithAuth($id)
    {
        return $this->where('id', $id)->where('wallet_id', Auth::user()->wallet->id)->first();
    }
    /**
     * getWithTxIdAndId
     *
     * @param  mixed $id
     * @param  mixed $txid
     * @return void
     */
    public function getWithTxIdAndId($id, $txid)
    {
        return $this->where('id', $id)->where('thash', $txid)->first();
    }
    /**
     * getByInvoiceId
     *
     * @param  mixed $txid
     * @return this
     */
    public function getByInvoiceId($txid)
    {
        return $this->where('thash', $txid)->first();
    }
    /**
     * notConfirmedBtcTransactionsOverTime
     *
     * @return void
     */
    public function notConfirmedBtcTransactionsOverTime()
    {
        return $this->whereIN('status', [
            self::STATUS['PENDING'],
            self::STATUS['PAID'],
        ])->where('type', self::TYPE['BTC'])
            ->where('pjob', self::PJOB['FALSE'])
            ->where('created_at', '<', Carbon::NOW()->subMinutes(60))->get();
    }
    /**
     * Not Confirmed ETh Transactions Over Time
     *
     * @return void
     */
    public function notConfirmedEThTransactionsOverTime()
    {
        return $this->whereIN('status', [
            self::STATUS['PAID'],
            self::STATUS['PENDING'],
        ])->where('type', self::TYPE['ETH'])
            ->where('pjob', self::PJOB['FALSE'])
            ->where('created_at', '<', Carbon::NOW()->subMinutes(20))
            ->get();
    }
    /**
     * notConfirmedBtcTransactionsOverTimeTest
     *
     * @return void
     */
    public function notConfirmedBtcTransactionsOverTimeTest()
    {
        return $this->whereIN('status', [
            self::STATUS['PENDING'],
            self::STATUS['PAID'],
            self::STATUS['CANCELLED'],
        ])->where('type', self::TYPE['BTC'])
            ->where('pjob', self::PJOB['FALSE'])
            ->where('created_at', '<', Carbon::NOW()->subMinutes(60))->get();
    }
    /**
     * get Eth Transactions
     *
     * @return void
     */
    public function getEthTransactions()
    {
        return $this->whereIN('status', [
            self::STATUS['PENDING'],
        ])->where('type', self::TYPE['ETH'])
            ->where('pjob', self::PJOB['FALSE'])
            ->where('created_at', '<', Carbon::NOW()->subMinutes(30))
            ->get();
    }
    /**
     * getPendingTransactions
     *
     * @return void
     */
    public function getPendingTransactions()
    {
        return $this->where('wallet_id', Auth::user()->wallet->id)->where('status', self::STATUS['PAID'])->sum('amount');
    }
    /**
     * commission
     *
     * @return void
     */
    public function commission()
    {
        return $this->hasOne(Commission::class, 'transaction_id', 'id');
    }
}
