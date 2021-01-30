<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    CONST SPXTJS = ['EMPTY_JOB'=>false,'HAS_JOB'=>true];
    CONST COMMISSIONSTJS = ['EMPTY_JOB'=>false,'HAS_JOB'=>true];

    protected $fillable = [
        'amount', //SOAX Amount
        'status',
        'customer_id',
        'commissions',
        'sopx',
        'tp_sopx', //temporary token
        'cb_sopx', // convertible token
        'sopx_tjs', //sopx temporary token Transaction Job status
        'static_amount',
        'tp_commissions', //temporary commissions storage
        'commissions_tjs', //commissions temporary job status
        'rw_amount',
        'rw_amount_t',
        'is_stackable'
    ];

    /**
     * deposits
     *
     * @return void
     */
    public function deposits()
    {
        return $this->hasMany(WalletTransaction::class, 'wallet_id');
    }
    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    /**
     * withdrawal Settings
     *
     * @return void
     */
    public function withdrawalSettings()
    {
        return $this->hasOne(WithdrawalSettings::class, 'wallet_id');
    }
    /**
     * withdrawalSettings
     *
     * @return void
     */
    public function shareSettings()
    {
        return $this->hasOne(ShareSettings::class, 'wallet_id');
    }
    /**
     * get Workable Wallets
     *
     * @param  mixed $min_limit
     * @return void
     */
    public function getWorkableWallets($min_limit)
    {
        return $this->where('tp_sopx', '>=', $min_limit)->where('sopx_tjs',self::SPXTJS['EMPTY_JOB'])->get();
    }
    /**
     * get Commissions Initialize Wallets
     *
     * @param  mixed $min_limit
     * @return void
     */
    public function getCommissionsInitializeWallets($min_limit)
    {
        return $this->where('tp_commissions', '>', $min_limit)->where('commissions_tjs',self::SPXTJS['EMPTY_JOB'])->get();
    }
    /**
     * allStackable
     *
     * @return void
     */
    public function allStackable(){
        return $this->where('is_stackable',true)->where('amount','>=', config('smartcontract.min_contract_soax'))->get();
    }

}
