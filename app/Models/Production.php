<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Production extends Model
{
    use HasFactory;
    const USERSTATUS = ['PENDING' => 1, 'JOBCREATED' => 2, 'COMPLETED' => 3];
    protected $table = 'production';

    protected $fillable = [
        'owner_id',
        'portfolio_id',
        'count_of_barrel',
        'price_of_barrel',
        'date',
        'user_status',
        'status'
    ];
    /**
     * Get Portfolio
     *
     */
    public function portfolio()
    {
        return $this->belongsTo('App\Models\Portfolio', 'portfolio_id', 'id');
    }
    /**
     * get All new portfolio productions which not created jobs still
     *
     * @return void
     */
    public function getAllNew()
    {
        return $this->where('status', self::USERSTATUS['PENDING'])->get();
    }

    /**
     * Get Portfolio
     *
     */
    public function contractProductions()
    {
        return $this->hasMany(ContractProduction::class, 'production_id', 'id');
    }
    /**
     * transferredRate
     *
     * @param  mixed $user_id
     * @return void
     */
    public function transferredRate($user_id, $date)
    {
        return ContractProduction::where('customer_id', $user_id)->where('date', $date)->where('production_id', $this->id)->first();
    }

    /**
     * get all production by portfolio
     *
     * @return void
     */
    public function getProductionByPortfolio($portfolio_id)
    {
        return $this->whereHas('contractProductions', function ($q) {
            $q->where('customer_id', Auth::user()->id);
        })->where('portfolio_id', $portfolio_id)->get();
    }
}
