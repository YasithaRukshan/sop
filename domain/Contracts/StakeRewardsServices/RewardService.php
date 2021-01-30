<?php

namespace domain\Contracts\StakeRewardsServices;

use App\Models\Reward;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\StakeFacades\RewardTransactionFacade;
use Illuminate\Support\Facades\Auth;

class RewardService
{
    protected $reward;
    public function __construct()
    {
        $this->rewards = new Reward();
    }
    /**
     * Get By Id
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->rewards->find($id);
    }
    public function getLogs($degree, $wallet_id)
    {
        $ids = $this->rewards->getRAccountIds($degree, $wallet_id);
        return RewardTransactionFacade::getByIds($ids);
    }
    /**
     * get By Auth And Level
     *
     * @param  mixed $customer_id
     * @param  mixed $degree
     * @param  mixed $type
     * @return Reward
     */
    public function getByAuthAndLevelType($wallet_id, $degree, $type)
    {
        return $this->rewards->getByAuthAndLevelType($wallet_id, $degree, $type);
    }
    /**
     * get By Auth And Level Type Or Create
     *
     * @param  mixed $wallet_id
     * @param  mixed $degree
     * @param  mixed $type
     * @return void
     */
    public function getByAuthAndLevelTypeOrCreate($wallet_id, $degree, $type)
    {
        $reward = $this->getByAuthAndLevelType($wallet_id, $degree, $type);
        if (!$reward) {
            $reward = $this->make([
                "wallet_id" => $wallet_id,
                "degree" => $degree,
                "type" => $type,
                "level" => 0,
            ]);
        }
        return $reward;
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
        return $this->rewards->create($date);
    }
    /**
     * update
     *
     * @param  Reward $reward
     * @param  mixed $data
     * @return void
     */
    public function update(Reward $reward, array $data)
    {
        $reward->update($this->edit($reward, $data));
    }
    /**
     * edit
     *
     * @param  Reward $reward
     * @param  mixed $data
     * @return mixed
     */
    public function edit(Reward $reward, array $data)
    {
        return array_merge($reward->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $reward = $this->get($id);
        $reward->delete();
    }
    /**
     * getAllDgreeRewards
     *
     * @return void
     */
    public function getAllDgreeRewards()
    {
        $rewardsData = $this->rewards->where('wallet_id', Auth::user()->wallet->id)->get();
        $collectingReward =  $rewardsData->sum('rewards');
        $rewards_red =  $rewardsData->sum('rewards_red');
        return EthRateFacade::getLastEthRate((float) ($collectingReward - $rewards_red));
    }
    /**
     * getAuthRewards
     *
     * @return void
     */
    public function getAuthRewards()
    {
        $rewardsData = $this->rewards->where('wallet_id', Auth::user()->wallet->id)->get();
        return $rewardsData;
    }
}
