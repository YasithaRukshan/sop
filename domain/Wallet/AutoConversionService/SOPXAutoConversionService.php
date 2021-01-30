<?php

namespace domain\Wallet\AutoConversionService;

use App\Events\Wallet\SOPXAutoConversionEvent;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use domain\Facades\CommissionsFacade;
use domain\Facades\ContractProductionFacade;
use domain\Facades\ContractsFacade;
use domain\Facades\OilPriceFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;

class SOPXAutoConversionService
{

    public function __construct()
    {
    }

    /**
     * init Transactions
     *
     * @return void
     */
    public function initTransactions()
    {

        $wallets = WalletFacade::getWorkableWallets(config('payments.minimum_sopx'));
        foreach ($wallets as $key => $wallet) {
            // event(new SOPXAutoConversionEvent($wallet->id));
            WalletFacade::update($wallet, ['sopx_tjs' => Wallet::SPXTJS['HAS_JOB']]);
            $this->broadcastSOPXToWallets($wallet->id);
        }
    }
    /**
     * broadcast SOPX To Wallets
     *
     * @param  mixed $wallet_id
     * @return void
     */
    public function broadcastSOPXToWallets($wallet_id)
    {

        $wallet = WalletFacade::get($wallet_id);
        // return If not job exists
        if ($wallet->sopx_tjs == Wallet::SPXTJS['EMPTY_JOB']) {
            return false;
        }
        //check is sopx to soax auto conversion settings exists and enabled
        if (($auto_conversion_settings = $wallet->withdrawalSettings) && $wallet->withdrawalSettings->status == true) {
            $this->convertToSOAX($auto_conversion_settings, $wallet);
        } else {
            $this->transferToMainSOPXWallet($wallet, $wallet->tp_sopx, $wallet->tp_sopx);
        }
        WalletFacade::update($wallet, [
            "sopx_tjs" => Wallet::SPXTJS['EMPTY_JOB'],
        ]);
    }
    /**
     * convertToSOAX
     *
     * @param  mixed $auto_conversion_settings
     * @param  mixed $wallet
     * @return void
     */
    public function convertToSOAX($auto_conversion_settings, $wallet)
    {
        if ($oil_price = OilPriceFacade::currentPrice()) {

            $rate = $auto_conversion_settings->rate;
            $amount = $wallet->tp_sopx;
            $converted_sopx = $amount * $rate / 100;

            // Convert  sopx to soax
            $soax_amount = ($converted_sopx * ($oil_price->price - 18)) / config('payments.soax_to_usd');
            // get converted soax integer amount hence SOAX haven't decimal
            $integer_amount = floor($soax_amount);
            $decimal_amount = ($soax_amount - $integer_amount);
            // converted decimal portion again to sopx
            $decimal_amount_in_sopx = ($decimal_amount * config('payments.soax_to_usd')) / ($oil_price->price - 18);
            //save only soax integer amount. and resend decimal portion to sopx
            $final_converted_sopx = $converted_sopx - $decimal_amount_in_sopx;
            $transaction =  TransactionFacade::make([
                "wallet_id" => $wallet->id,
                "type" => WalletTransaction::TYPE["SOPXAUTO"],
                "status" => WalletTransaction::STATUS["CONFIRMED"],
                "value" =>  $final_converted_sopx,
                "amount" => $integer_amount,
                "soax_transferred" => true, //don't want to pay commissions for this transaction
            ]);
            //save soax value to wallet
            WalletFacade::update($wallet, [
                "amount" => $wallet->amount + $integer_amount,
                "static_amount" => $wallet->static_amount + $integer_amount,
                "is_stackable" => true,
            ]);
            //Generate Commissions For Transaction
            CommissionsFacade::SendSOAXCommissions($transaction);
            // update wallet sopx storage with rest data
            $rest_sopx = $amount - $final_converted_sopx;
            $this->transferToMainSOPXWallet($wallet, $rest_sopx, $amount, $rate);
        }
    }
    /**
     * transfer To Main SOPX Wallet
     *
     * @param  mixed $wallet
     * @param  mixed $amount
     * @param  mixed $full_amount
     * @return void
     */
    public function transferToMainSOPXWallet($wallet, $amount, $full_amount, $rate = 0)
    {
        // calculate real time value and save
        WalletFacade::update($wallet, [
            "sopx" => $wallet->sopx + $amount,
            "tp_sopx" => $wallet->tp_sopx - $full_amount,
        ]);

        $customer = $wallet->user;
        $productions = ContractProductionFacade::getByUserRateNull($customer->id);

        foreach ($productions as $key => $production) {

            ContractProductionFacade::update($production, [
                'rate' => $rate
            ]);
        }
    }
}
