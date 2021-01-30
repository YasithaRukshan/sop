<?php

namespace domain\Contracts\StakeRewardsServices;

use App\Models\Reward;
use App\Models\RewardTransaction;
use domain\Facades\ContractsFacade;
use domain\Facades\StakeFacades\RewardFacade;
use domain\Facades\StakeFacades\RewardSettingsFacade;
use domain\Facades\StakeFacades\RewardTransactionFacade;

class StakeRewardService
{
    public function __construct()
    {
    }

    /**
     * initialize Rewards
     *
     * @param  mixed $contract_id
     * @return void
     */
    public function initializeRewards($contract_id)
    {
        //get contract by id
        $contract = ContractsFacade::get($contract_id);
        //get get contract owner
        $user = $contract->Customer;
        // get relative portfolio from contract
        $portfolio = $contract->Portfolio;
        //Find Referrer who will received rewards
        $this->findReferrerAndGenerateRewards($contract, $portfolio, $user);
    }
    /**
     * find Referrer And Generate Rewards
     *
     * @param  mixed $contract
     * @param  mixed $portfolio
     * @param  mixed $user
     * @return void
     */
    public function findReferrerAndGenerateRewards($contract, $portfolio, $user)
    {
        //we don't generate rewards for direct referrals. this 6levels are the levels after direct referrals
        if ($direct_referrer = $user->referrer) {
            if ($payable_referrer = $direct_referrer->referrer) {
                $degree = 1; //$degree = current level
                while ($degree <= config('rewards.levels')) {
                    //check is referer exists for this level.
                    if ($payable_referrer) {
                        $this->initializeReferrerRewards($contract, $portfolio, $payable_referrer, $degree);
                        $payable_referrer = $payable_referrer->referrer;
                    }
                    $degree++;
                }
            }
        }
    }
    /**
     * initialize Referrer Rewards
     *
     * @param  mixed $contract
     * @param  mixed $portfolio
     * @param  mixed $payable_referrer
     * @param  mixed $degree
     * @return void
     */
    public function initializeReferrerRewards($contract, $portfolio, $payable_referrer, $degree)
    {

        //initialize carbon offset rewards [COR]
        $this->initializeCOR($contract, $portfolio, $payable_referrer, $degree);
        // initialize Grid energy offset rewards [GEO]
        $this->initializeGEO($contract, $portfolio, $payable_referrer, $degree);
        // initialize  [OIGCC]
        $this->initializeOIGCC($contract, $portfolio, $payable_referrer, $degree);
    }
    /**
     * initialize carbon offset rewards [COR]
     *
     * @param  mixed $contract
     * @param  mixed $portfolio
     * @param  mixed $user
     * @return void
     */
    public function initializeCOR($contract, $portfolio, $payable_referrer, $degree)
    {
        //cor rate
        $rate = config("rewards.cor.max") / ($portfolio->cor > 0 ? $portfolio->cor : 950);
        //reward amount
        $amount = $rate * $contract->amount;
        if ($wallet = $payable_referrer->wallet) {
            //Get Related Reward Account Of Referrer
            $reward_rec = RewardFacade::getByAuthAndLevelType($wallet->id, $degree, Reward::TYPE['COR']);
            if (!$reward_rec) {
                //Create Related Reward Account Of Referrer if Not Exists
                $reward_rec = RewardFacade::make([
                    "wallet_id" => $wallet->id,
                    "degree" => $degree,
                    "type" => Reward::TYPE['COR'],
                ]);
            }
            if (!RewardTransactionFacade::getByRewardANDContractType($reward_rec->id, $contract->id,RewardTransaction::TYPE['COR'])) {
                RewardTransactionFacade::make([
                    "reward_id" => $reward_rec->id,
                    "contract_id" => $contract->id,
                    "amount" => $amount,
                    "type" => RewardTransaction::TYPE['COR'],
                    "status" => true,
                ]);

                $all_points = $reward_rec->points + $amount;
                $points_showing = $all_points % config("rewards.cor.max");
                $new_level =  ($all_points - $points_showing) / config("rewards.cor.max");
                $new_reward_amount = $reward_rec->rewards + (($new_level - $reward_rec->level) * RewardSettingsFacade::getRate(Reward::TYPE['COR'], $degree));
                RewardFacade::update($reward_rec, [
                    "points" => $all_points,
                    "points_showing" => $points_showing,
                    "level" => $new_level,
                    "rewards" => $new_reward_amount
                ]);
            }
        }
    }
    public function initializeGEO($contract, $portfolio, $payable_referrer, $degree)
    {
        //cor rate
        $rate = config("rewards.geo.max") / ($portfolio->geo > 0 ? $portfolio->geo : 2700);
        //reward amount
        $amount = $rate * $contract->amount;

        if ($wallet = $payable_referrer->wallet) {
            //Get Related Reward Account Of Referrer
            $reward_rec = RewardFacade::getByAuthAndLevelType($wallet->id, $degree, Reward::TYPE['GEO']);

            if (!$reward_rec) {
                //Create Related Reward Account Of Referrer if Not Exists
                $reward_rec = RewardFacade::make([
                    "wallet_id" => $wallet->id,
                    "degree" => $degree,
                    "type" => Reward::TYPE['GEO'],
                ]);
            }

            if (!RewardTransactionFacade::getByRewardANDContractType($reward_rec->id, $contract->id,RewardTransaction::TYPE['GEO'])) {
                RewardTransactionFacade::make([
                    "reward_id" => $reward_rec->id,
                    "contract_id" => $contract->id,
                    "amount" => $amount,
                    "type" => RewardTransaction::TYPE['GEO'],
                    "status" => true,
                ]);
                $all_points = $reward_rec->points + $amount;
                $points_showing = $all_points % config("rewards.geo.max");
                $new_level =  ($all_points - $points_showing) / config("rewards.geo.max");
                $new_reward_amount = $reward_rec->rewards + (($new_level - $reward_rec->level) * RewardSettingsFacade::getRate(Reward::TYPE['GEO'], $degree));
                RewardFacade::update($reward_rec, [
                    "points" => $all_points,
                    "points_showing" => $points_showing,
                    "level" => $new_level,
                    "rewards" => $new_reward_amount
                ]);
            }
        }
    }
    public function initializeOIGCC($contract, $portfolio, $payable_referrer, $degree)
    {
        //cor rate
        $rate = config("rewards.oigcc.max") / ($portfolio->oigcc > 0 ? $portfolio->oigcc : 6600);
        //reward amount
        $amount = $rate * $contract->amount;
        if ($wallet = $payable_referrer->wallet) {
            //Get Related Reward Account Of Referrer
            $reward_rec = RewardFacade::getByAuthAndLevelType($wallet->id, $degree, Reward::TYPE['OIGCC']);
            if (!$reward_rec) {
                //Create Related Reward Account Of Referrer if Not Exists
                $reward_rec = RewardFacade::make([
                    "wallet_id" => $wallet->id,
                    "degree" => $degree,
                    "type" => Reward::TYPE['OIGCC'],
                ]);
            }
            if (!RewardTransactionFacade::getByRewardANDContractType($reward_rec->id, $contract->id,RewardTransaction::TYPE['OIGCC'])) {
                RewardTransactionFacade::make([
                    "reward_id" => $reward_rec->id,
                    "contract_id" => $contract->id,
                    "amount" => $amount,
                    "type" => RewardTransaction::TYPE['OIGCC'],
                    "status" => true,
                ]);

                $all_points = $reward_rec->points + $amount;
                $points_showing = $all_points % config("rewards.oigcc.max");
                $new_level =  ($all_points - $points_showing) / config("rewards.oigcc.max");
                $new_reward_amount = $reward_rec->rewards + (($new_level - $reward_rec->level) * RewardSettingsFacade::getRate(Reward::TYPE['OIGCC'], $degree));
                RewardFacade::update($reward_rec, [
                    "points" => $all_points,
                    "points_showing" => $points_showing,
                    "level" => $new_level,
                    "rewards" => $new_reward_amount
                ]);
            }
        }
    }
}
