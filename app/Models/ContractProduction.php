<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ContractProduction extends Model
{
    use HasFactory;
    protected $table = 'contract_production';

    public $primaryKey = 'id';

    protected $fillable = [
        'contract_id', 'date', 'amount', 'customer_id', 'oil_price_id', 'production_id', 'rate'
    ];

    /**
     * Contract
     *
     * @return void
     */
    public function Contract()
    {
        return $this->belongsTo('App\Models\Contract', 'contract_id', 'id');
    }

    /**
     * Customer
     *
     * @return void
     */
    public function Customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
    /**
     * getByUserRateNull
     *
     * @param  mixed $customer_id
     * @return void
     */
    public function getByUserRateNull($customer_id)
    {
        return $this->where('customer_id', $customer_id)->whereNull('rate')->get();
    }

    /**
     * production
     *
     * @return void
     */
    public function production()
    {
        return $this->hasOne(Production::class, 'id', 'production_id');
    }
    /**
     * get By Contract Production
     *
     * @param  mixed $contract_id
     * @param  mixed $production_id
     * @return void
     */
    public function getByContractProduction($contract_id, $production_id)
    {
        return $this->where('contract_id', $contract_id)->where('production_id', $production_id)->first();
    }

    /**
     * get sopx Produced
     *
     * @param  mixed $production_id
     * @return void
     */
    public function getSopxProduced($production_id)
    {
        return $this->where('customer_id', Auth::user()->id)->where('production_id', '=', $production_id)->sum('amount');
    }

    /**
     * get contracts by production id
     *
     * @param  mixed $production_id
     * @return void
     */
    public function getContractByProductId($production_id)
    {
        return $this->where('customer_id', Auth::user()->id)->where('production_id', '=', $production_id)->get();
    }
}
