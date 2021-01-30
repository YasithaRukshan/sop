<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardTransaction extends Model
{
    use HasFactory;

    const TYPE = ['COR' => 1, 'GEO' => 2, 'OIGCC' => 3,];
    protected $fillable = [
        'reward_id',
        'contract_id',
        'amount',
        'type',
        'status',
    ];
    /**
     * reward
     *
     * @return RewardTransaction
     */
    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id');
    }
    /**
     * contract
     *
     * @return Contract
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    /**
     * get By Reward AND Contract Type
     *
     * @param  int $reward_rec_id
     * @param  int $contract_id
     * @param  int $type
     * @return THIS
     */
    public function getByRewardANDContractType($reward_rec_id, $contract_id, $type)
    {
        return $this->where('reward_id', $reward_rec_id)->where('contract_id', $contract_id)->where('type', $type)->first();
    }
    /**
     * getByIds
     *
     * @param  mixed $ids
     * @return void
     */
    public function getByIds($ids)
    {
        return $this->whereIN('reward_id', $ids)->get();
    }
}
