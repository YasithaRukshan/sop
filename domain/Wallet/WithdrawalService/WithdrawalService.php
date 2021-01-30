<?php

namespace domain\wallet\WithdrawalService;

use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\OilPriceFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Auth;

class WithdrawalService
{
    protected $withdrawal;
    public function __construct()
    {
        $this->withdrawal = new Withdrawal();
    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        return $this->withdrawal->all();
    }

    /**
     * all
     *
     * @return void
     */
    public function getByAuth()
    {
        return $this->withdrawal->where("wallet_id", Auth::user()->wallet->id)->get();
    }
    /**
     * get
     *
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->withdrawal->find($id);
    }

    /**
     * make
     *
     * @param  mixed $date
     * @return mixed
     */
    public function make($request)
    {
        $converted = $this->conversion($request);
        $wallet = Auth::user()->wallet;
        if (($wallet->sopx) > ($request->sopx_amount)) {
            $wdRequest = $this->create([
                "customer_id" => Auth::user()->id,
                "wallet_id" => $wallet->id,
                "withdraw_type" => Withdrawal::TYPES[$request->redemptionType],
                "recipient_address" => $request->has('recipient') ? $request->recipient : "",
                "sopx_amount" => $request->sopx_amount,
                "acc_type" => $request->acc_type,
                "w_amount" => $converted['w_amount'],
                "w_charges" => $converted['w_charges'],
                "oil_price_id" => $converted['oil_price_id'],
                "status" => $converted['status'],
            ]);
            if ($request->acc_type == Withdrawal::ACCTYPES['SOAX']) {
                TransactionFacade::make([
                    "wallet_id" => $wallet->id,
                    "type" => WalletTransaction::TYPE["SOPX"],
                    "status" => WalletTransaction::STATUS["CONFIRMED"],
                    "value" =>  $request->sopx_amount,
                    "amount" => $converted['w_amount'],
                    "soax_transferred" => true, //don't want to pay commissions for this transaction
                ]);
                $wallet_amount = $wallet->amount + $converted['w_amount'];
            } else {
                $wallet_amount = $wallet->amount;
            }
            WalletFacade::update($wallet, [
                "sopx" => ($wallet->sopx - $request->sopx_amount),
                "amount" => $wallet_amount,
            ]);
            return true;
        } else {
            return false;
        }
    }
    public function conversion($request)
    {
        $sopx = $request->sopx_amount * 1;
        $temp_oil_price = OilPriceFacade::getLastPrice();
        $usd_value = ($sopx * ($temp_oil_price->price - 18));
        switch ($request->acc_type) {
            case Withdrawal::ACCTYPES['BTC']:
                // $amount =  WalletFacade::convert('USD', 'BTC', $usd_value);
                // $charges = $amount * config('payments.withdraw_charges');
                // $status = Withdrawal::STATUS['PENDING'];
                break;
            case Withdrawal::ACCTYPES['ETH']:
                $amount =  EthRateFacade::getLastEthRate($usd_value);
                $charges = EthRateFacade::getHandlingFee($usd_value)["fee"];
                $status = Withdrawal::STATUS['PENDING'];
                break;
            case Withdrawal::ACCTYPES['SOAX']:
                $amount = floor($usd_value / config('payments.soax_to_usd'));
                $charges = 0;
                $status = Withdrawal::STATUS['CONFIRMED'];
                break;
            case Withdrawal::ACCTYPES['DIRECT']:
                $amount = $sopx;
                $charges = $amount * config('payments.withdraw_charges');
                $status = Withdrawal::STATUS['PENDING'];
                break;
        }
        return ["w_amount" => $amount, "w_charges" => $charges, 'oil_price_id' => $temp_oil_price->id, 'status' => $status];
    }
    /**
     * create
     *
     * @param  mixed $date
     * @return mixed
     */
    public function create($date)
    {
        return $this->withdrawal->create($date);
    }
    /**
     * update
     *
     * @param  WithdrawalSettings $withdrawal
     * @param  mixed $data
     * @return void
     */
    public function update(Withdrawal $withdrawal, array $data)
    {
        $withdrawal->update($this->edit($withdrawal, $data));
    }
    /**
     * edit
     *
     * @param  WithdrawalSettings $withdrawal
     * @param  mixed $data
     * @return mixed
     */
    public function edit(Withdrawal $withdrawal, array $data)
    {
        return array_merge($withdrawal->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $withdrawals_setting = $this->get($id);
        $withdrawals_setting->delete();
    }

    /**
     * get By Auth Redeem success
     *
     * @return float
     */
    public function getByAuthRedeemed()
    {
        return $this->withdrawal->where("wallet_id", Auth::user()->wallet->id)
            ->where("status", Withdrawal::STATUS['CONFIRMED'])->sum('sopx_amount');
    }
    /**
     * get By Auth Redeem pending
     *
     * @return float
     */
    public function getByAuthRedeemPending()
    {
        return $this->withdrawal->where("wallet_id", Auth::user()->wallet->id)
            ->where("status", Withdrawal::STATUS['PENDING'])->sum('sopx_amount');
    }
    /**
     * getByAuthAvailable
     *
     * @return float
     */
    public function getByAuthRedeemAvailable()
    {
        return Auth::user()->wallet->sopx * 1;

        // return $balance - ($this->getByAuthRedeemed() + $this->getByAuthRedeemPending());
    }
}
