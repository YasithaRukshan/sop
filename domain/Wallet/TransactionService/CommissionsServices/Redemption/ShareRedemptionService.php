<?php

namespace domain\Wallet\TransactionService\CommissionsServices\Redemption;

use App\Events\DepositConfirmationEvent;
use App\Models\RewardCollect;
use App\Models\ShareRedemptions;
use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use domain\Facades\CommissionsFacade;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Auth;

class ShareRedemptionService
{
    protected $share_redemption;
    public function __construct()
    {
        $this->share_redemption = new ShareRedemptions();
    }
    /**
     * Get By Id
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->share_redemption->find($id);
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
        return $this->share_redemption->create($date);
    }
    /**
     * check customer commissions redeemable access
     *
     * @return void
     */
    public function canRedeem()
    {
        $commission = Auth::user()->wallet->commissions;
        if ($commission > config('payments.redeem.minimum_share')) {
            return true;
        }
        return false;
    }
    /**
     * update
     *
     * @param  ShareRedemptions $reward_collect
     * @param  mixed $data
     * @return void
     */
    public function update(ShareRedemptions $share_redemption, array $data)
    {
        $share_redemption->update($this->edit($share_redemption, $data));
    }
    /**
     * edit
     *
     * @param  ShareRedemptions $reward_collect
     * @param  mixed $data
     * @return mixed
     */
    public function edit(ShareRedemptions $share_redemption, array $data)
    {
        return array_merge($share_redemption->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $share_redemption = $this->get($id);
        $share_redemption->delete();
    }
    /**
     * storeRewardsRedemption
     *
     * @param  mixed $request
     * @return void
     */
    public function storeShareRedemption($request)
    {
        $converted = $this->conversion($request);
        $wallet = Auth::user()->wallet;
        if ($wallet->commissions < $converted['usd_value']) {
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
                $transaction = TransactionFacade::make([
                    "wallet_id" => $wallet->id,
                    "type" => WalletTransaction::TYPE["COMMISSIONS"],
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
                "commissions" => ((float) ($wallet->commissions) - (float) $converted['usd_value']),
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
            case ShareRedemptions::ACCTYPES['BTC']:
                $amount =  WalletFacade::convert('USD', 'BTC', $usd_value);
                $charges = EthRateFacade::getHandlingFee($usd_value)["fee"];
                $status = ShareRedemptions::STATUS['PENDING'];
                $acc_type = ShareRedemptions::ACCTYPES['BTC'];
                $type = ShareRedemptions::TYPES['TRANSFER'];
                break;
            case ShareRedemptions::ACCTYPES['ETH']:
                $amount =  EthRateFacade::getLastEthRate($usd_value);
                $charges = EthRateFacade::getHandlingFee($usd_value)["fee"];
                $status = ShareRedemptions::STATUS['PENDING'];
                $acc_type = ShareRedemptions::ACCTYPES['ETH'];
                $type = ShareRedemptions::TYPES['TRANSFER'];
                break;
            case ShareRedemptions::ACCTYPES['SOAX']:
                $amount = floor($usd_value / config('payments.soax_to_usd'));
                $charges = 0;
                $status = ShareRedemptions::STATUS['CONFIRMED'];
                $acc_type = ShareRedemptions::ACCTYPES['SOAX'];
                $type = ShareRedemptions::TYPES['CONVERT'];
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
