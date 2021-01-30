<?php

namespace domain\Contracts\StakeRewardsServices;

use App\Models\RewardTransaction;

class RewardTransactionService
{
    protected $reward_transaction;
    public function __construct()
    {
        $this->reward_transactions = new RewardTransaction();
    }
    /**
     * Get By Id
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->reward_transactions->find($id);
    }
    public function getByIds($ids)
    {
        return $this->reward_transactions->getByIds($ids);
    }
    /**
     * getByRewardANDContractType
     *
     * @param  mixed $reward_rec_id
     * @param  mixed $contract_id
     * @return RewardTransaction
     */
    public function getByRewardANDContractType($reward_rec_id, $contract_id,$type)
    {
        return $this->reward_transactions->getByRewardANDContractType($reward_rec_id, $contract_id,$type);
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
        return $this->reward_transactions->create($date);
    }
    /**
     * update
     *
     * @param  RewardTransaction $reward_transaction
     * @param  mixed $data
     * @return void
     */
    public function update(RewardTransaction $reward_transaction, array $data)
    {
        $reward_transaction->update($this->edit($reward_transaction, $data));
    }
    /**
     * edit
     *
     * @param  RewardTransaction $reward_transaction
     * @param  mixed $data
     * @return mixed
     */
    public function edit(RewardTransaction $reward_transaction, array $data)
    {
        return array_merge($reward_transaction->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $reward_transaction = $this->get($id);
        $reward_transaction->delete();
    }
}
