<?php

namespace App\Traits;

use App\Models\Commission;
use App\Models\Customer;
use Carbon\Carbon;
use domain\Facades\CommissionsFacade;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Auth;

trait ReferralsHelper
{
    /**
     * referrals
     *
     * @param $id
     * @return void
     */
    public function referrals()
    {
        return Auth::user()->referrals;
    }
    /**
     * commissions Rewards
     *
     * @return void
     */
    public function commissionsRewards()
    {
        // dd(Auth::user()->wallet);
        if ($wallet = Auth::user()->wallet) {
            return ['main' => $wallet->commissions, 'temp' => $wallet->tp_commissions];
        }
        return ['main' => 0, 'temp' => 0];
    }
    /**
     * get all users count
     *
     * @param $id
     * @return void
     */
    public function dayName($date)
    {
        $name = Carbon::parse($date)->format(' M, d Y');
        return $name;
    }

    /**
     * get count by user id
     *
     * @param $id
     * @return void
     */
    public function countUsers($count)
    {
        if ($count > 0) {
            return  '<span class="badge badge-success" style=" font-size: 1em;">' . $count . '</span>';
        } else {
            return  '<span class="badge" style=" font-size: 1em;">0</span>';
        }
    }

    /**
     * get count by user id
     *
     * @param $id
     * @return void
     */
    public function viewLink($user)
    {
        if (count($user->referrals) > 0) {
            return '<button onclick="showChild(\'' . md5($user["id"]) . '\')"  type="button" class="btn btn-sm btn-primary" >
          View  </button>';
        }
    }

    /**
     *get balance total staked
     *
     * @param $created_at
     * @return void
     */
    public function sopxNumberFormat($value)
    {
        return number_format($value, 4);
    }
    /**
     * getRLSource
     *
     * @param  mixed $transaction
     * @return void
     */
    public function getRLSource($transaction)
    {

        $contract = $transaction->contract;
        $portfolio = $contract->Portfolio;
        $customer = $contract->Customer;

        return $customer->first_name . '' . $customer->last_name . '&apos;s' . ' Stake For <span class="badge badge-dark">' . $portfolio->title . '</span>';
    }
    /**
     * getDegree
     *
     * @param  mixed $transaction
     * @return void
     */
    public function getDegree($transaction)
    {
        dd($transaction);
    }


    /**
     * getReferralsCommissions
     *
     * @param  mixed $parent_wallet_id
     * @param  mixed $wallet_id
     * @return void
     */
    public function getReferralsCommissions($wallet_id, $parent_wallet_id)
    {
        $CommissionAmount = CommissionsFacade::getReferralsCommissions($wallet_id, $parent_wallet_id);
        return 'Eth ' . EthRateFacade::getLastEthRate($CommissionAmount);
    }
}
