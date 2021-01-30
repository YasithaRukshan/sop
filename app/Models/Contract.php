<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'portfolio_id', 'amount', 'contract_address', 'transaction_id', 'soax_transferred'
    ];
    /**
     * Customer
     *
     * @return void
     */
    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    /**
     * Portfolio
     *
     * @return void
     */
    public function Portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'portfolio_id');
    }
    /**
     * get By PortFolio
     *
     * @param  mixed $portfolio_id
     * @return void
     */
    public function getByPortFolio($portfolio_id)
    {
        return $this->where('portfolio_id', $portfolio_id)->get();
    }
    /**
     * getProductionData
     *
     * @return void
     */
    public function getProductionData()
    {
        return $this->hasMany('App\Models\ContractProduction', 'contract_id');
    }
    /**
     * production
     *
     * @return void
     */
    public function production()
    {
        return $this->hasMany(ContractProduction::class, 'contract_id');
    }
    public function getAllStakedAMount($id)
    {
        return $this->where('customer_id', $id)->sum('amount');
    }
}
