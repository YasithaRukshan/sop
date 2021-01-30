<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    const TYPE = ["COR" => 1, "GEO" => 2, "OIGCC" => 3];

    protected $fillable = [
        'wallet_id',
        'points',
        'points_showing',
        'degree',
        'level',
        'type',
        'rewards',
        'rewards_red',
    ];

    /**
     * transactions
     *
     * @return void
     */
    public function transactions()
    {
        return $this->hasMany(RewardTransaction::class, 'reward_id');
    }
    /**
     * getByAuthAndLevel
     *
     * @param  mixed $customer_id
     * @param  mixed $level
     * @param  mixed $type
     * @return THIS
     */
    public function getByAuthAndLevelType($wallet_id, $degree, $type)
    {
        return $this->where('wallet_id', $wallet_id)->where('degree', $degree)->where('type', $type)->first();
    }
    /**
     * getLogs
     *
     * @param  mixed $degree
     * @param  mixed $wallet_id
     * @return void
     */
    public function getRAccountIds($degree, $wallet_id)
    {
        $query = $this->where('wallet_id', $wallet_id);
        if ($degree) {
            $query->where('degree', $degree);
        }
        return $query->pluck('id')->toArray();
    }
}
