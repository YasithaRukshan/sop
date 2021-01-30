<?php

namespace domain\Contracts\StakeRewardsServices;

use App\Models\RewardCollect;
use App\Models\SocialImpactRedemption;
use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use domain\Facades\StakeFacades\RewardFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Auth;

class RewardCollectService
{
    protected $reward_collect;
    public function __construct()
    {
        $this->reward_collect = new RewardCollect();
    }
    /**
     * Get By Id
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->reward_collect->find($id);
    }
    /**
     * collectTheRewards
     *
     * @param  mixed $reward_id
     * @return void
     */
    public function collectTheRewards($reward_id)
    {
        $reward = RewardFacade::get($reward_id);
        $wallet = Auth::user()->wallet;
        $amount = $reward->rewards - $reward->rewards_red;
        if ($amount>0) {
            $rc = $this->make([
                "wallet_id" => $wallet->id,
                "reward_id" => $reward->id,
                "amount" => $amount,
            ]);
            WalletFacade::update($wallet, [
                "rw_amount" => $wallet->rw_amount + $amount,
                "rw_amount_t" => $wallet->rw_amount_t + $amount,
            ]);
            RewardFacade::update($reward, [
                "rewards_red" => ($reward->rewards_red + $amount),
            ]);
            return $rc;
        }
    }
    /**
     * make
     *
     * @param  mixed $date
     * @return void
     */
    public function make($data)
    {
        return $this->create($data);
    }
    /**
     * create
     *
     * @param  mixed $date
     * @return void
     */
    public function create($date)
    {
        return $this->reward_collect->create($date);
    }
    /**
     * update
     *
     * @param  RewardCollect $reward_collect
     * @param  mixed $data
     * @return void
     */
    public function update(RewardCollect $reward_collect, array $data)
    {
        $reward_collect->update($this->edit($reward_collect, $data));
    }
    /**
     * edit
     *
     * @param  RewardCollect $reward_collect
     * @param  mixed $data
     * @return mixed
     */
    public function edit(RewardCollect $reward_collect, array $data)
    {
        return array_merge($reward_collect->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $reward_collect = $this->get($id);
        $reward_collect->delete();
    }
    /**
     * collectAllRewards
     *
     * @return void
     */
    public function collectAllRewards()
    {
        $RewardData = RewardFacade::getAuthRewards();
        foreach ($RewardData as $value) {
            $this->collectTheRewards($value->id);
        }
    }
}
