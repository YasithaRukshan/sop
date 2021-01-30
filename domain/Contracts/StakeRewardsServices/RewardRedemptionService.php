<?php

namespace domain\Contracts\StakeRewardsServices;

use App\Events\DepositConfirmationEvent;
use App\Models\RewardCollect;
use App\Models\RewardRedemption;
use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\StakeFacades\RewardFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Auth;

class RewardRedemptionService
{
    protected $reward_redemption;
    public function __construct()
    {
        $this->reward_redemption = new RewardRedemption();
    }
    /**
     * Get By Id
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->reward_redemption->find($id);
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
     * can Redeem
     *
     * @return void
     */
    public function canRedeem()
    {
        $rw_amount = Auth::user()->wallet->rw_amount;
        if ($rw_amount > config('payments.redeem.minimum_rewards')) {
            return true;
        }
        return false;
    }
    /**
     * create
     *
     * @param  mixed $date
     * @return void
     */
    public function create($date)
    {
        return $this->reward_redemption->create($date);
    }
    /**
     * update
     *
     * @param  RewardRedemption $reward_collect
     * @param  mixed $data
     * @return void
     */
    public function update(RewardRedemption $reward_redemption, array $data)
    {
        $reward_redemption->update($this->edit($reward_redemption, $data));
    }
    /**
     * edit
     *
     * @param  RewardRedemption $reward_collect
     * @param  mixed $data
     * @return mixed
     */
    public function edit(RewardRedemption $reward_redemption, array $data)
    {
        return array_merge($reward_redemption->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $reward_redemption = $this->get($id);
        $reward_redemption->delete();
    }
    /**
     * storeRewardsRedemption
     *
     * @param  mixed $request
     * @return void
     */
    public function storeRewardsRedemption($request)
    {
        $converted = $this->conversion($request);
        $wallet = Auth::user()->wallet;
        if (Auth::user()->wallet->rw_amount < $converted['usd_value']) {
            return false;
        } else {
            $this->create([
                "amount" => $converted['usd_value'],
                "rq_amount" => $request->amount,
                "type" => $converted['type'],
                "acc_type" =>  $converted['acc_type'],
                "address" => $request->address,
                "red_amount" => $converted['w_amount'],
                "w_charges" => $converted['w_charges'],
                "status" => $converted['status'],
                "wallet_id" =>  $wallet->id,
                'eth_rate_id' => $request->eth_rate_id,
            ]);

            if ($request->acc_type == Withdrawal::ACCTYPES['SOAX']) {
                $transaction =  TransactionFacade::make([
                    "wallet_id" => $wallet->id,
                    "type" => WalletTransaction::TYPE["REWARD"],
                    "status" => WalletTransaction::STATUS["CONFIRMED"],
                    "value" =>  $request->amount,
                    "amount" => $converted['w_amount'],
                    "soax_transferred" => true, //don't want to pay commissions for this transaction
                ]);
                $wallet_amount = $wallet->amount + $converted['w_amount'];
                event(new DepositConfirmationEvent($transaction));
            } else {
                $wallet_amount = $wallet->amount;
            }
            WalletFacade::update($wallet, [
                "rw_amount" => ($wallet->rw_amount - (float) $converted['usd_value']),
                "amount" => $wallet_amount,
            ]);
            return true;
        }
    }
    /**
     * conversion
     *
     * @param  mixed $request
     * @return void
     */
    public function conversion($request)
    {
        $ETH_value = $request->amount * 1;
        $usd_value = EthRateFacade::getLastUSDRate($ETH_value);
        switch ($request->acc_type) {
            case RewardRedemption::ACCTYPES['BTC']:
                $amount =  WalletFacade::convert('USD', 'BTC', $usd_value);
                $charges = EthRateFacade::getHandlingFee($usd_value)["fee"];
                $status = RewardRedemption::STATUS['PENDING'];
                $acc_type = RewardRedemption::ACCTYPES['BTC'];
                $type = RewardRedemption::TYPES['TRANSFER'];
                break;
            case RewardRedemption::ACCTYPES['ETH']:
                $amount =  EthRateFacade::getLastEthRate($usd_value);
                $charges = EthRateFacade::getHandlingFee($usd_value)["fee"];
                $status = RewardRedemption::STATUS['PENDING'];
                $acc_type = RewardRedemption::ACCTYPES['ETH'];
                $type = RewardRedemption::TYPES['TRANSFER'];
                break;
            case RewardRedemption::ACCTYPES['SOAX']:
                $amount = floor($usd_value / config('payments.soax_to_usd'));
                $charges = 0;
                $status = RewardRedemption::STATUS['CONFIRMED'];
                $acc_type = RewardRedemption::ACCTYPES['SOAX'];
                $type = RewardRedemption::TYPES['CONVERT'];
                break;
        }

        $data['w_amount'] = (string)$amount;
        $data['usd_value'] = (string)$usd_value;
        $data['w_charges'] = $charges;
        $data['status'] = $status;
        $data['acc_type'] = $acc_type;
        $data['type'] = $type;
        return $data;
    }
}
