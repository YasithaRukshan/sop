<?php

namespace domain\Wallet\AutoConversionService;

use App\Events\Wallet\CommissionsAutoConversionEvent;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;

class CommissionsAutoConversionService
{

    public function __construct()
    {
    }

    /**
     * init Transactions
     *
     * @return void
     */
    public function initCommissions()
    {

        $wallets = WalletFacade::getCommissionsInitializeWallets(config('payments.minimum_commissions_to_convert'));
        foreach ($wallets as $key => $wallet) {
            event(new CommissionsAutoConversionEvent($wallet->id));
            WalletFacade::update($wallet, ['commissions_tjs' => Wallet::COMMISSIONSTJS['HAS_JOB']]);
        }
    }
    /**
     * broadcast Commissions To Wallets
     *
     * @param  mixed $wallet_id
     * @return void
     */
    public function broadcastCommissionsWallets($wallet_id)
    {

        $wallet = WalletFacade::get($wallet_id);
        // return If not job exists
        if ($wallet->commissions_tjs == Wallet::COMMISSIONSTJS['EMPTY_JOB']) {
            return false;
        }
        //check is commissions to soax auto conversion settings exists and enabled
        if (($auto_conversion_settings = $wallet->shareSettings) && $wallet->shareSettings->status == true) {
            $this->convertToSOAX($auto_conversion_settings, $wallet);
        } else {
            $this->transferToMainCommissionsWallet($wallet, $wallet->tp_commissions, $wallet->tp_commissions);
        }
        WalletFacade::update($wallet, [
            "commissions_tjs" => Wallet::COMMISSIONSTJS['EMPTY_JOB'],
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
        $rate = $auto_conversion_settings->rate;
        $amount = $wallet->tp_commissions;
        $converted_commissions = $amount * $rate / 100;

        // Convert  Commissions to soax
        $soax_amount = $converted_commissions / config('payments.soax_to_usd');
        // get converted soax integer amount hence SOAX haven't decimal
        $integer_amount = floor($soax_amount);
        $decimal_amount = ($soax_amount - $integer_amount);
        // converted decimal portion again to commissions
        $decimal_amount_in_commissions = ($decimal_amount * config('payments.soax_to_usd'));
        //save only soax integer amount. and resend decimal portion to commissions
        $final_converted_commissions = $converted_commissions - $decimal_amount_in_commissions;
        TransactionFacade::make([
            "wallet_id" => $wallet->id,
            "type" => WalletTransaction::TYPE["AUTOCOMMISSIONS"],
            "status" => WalletTransaction::STATUS["CONFIRMED"],
            "value" =>  $final_converted_commissions,
            "amount" => $integer_amount,
            "soax_transferred" => true, //don't want to pay commissions for this transaction
        ]);
        //save soax value to wallet
        WalletFacade::update($wallet, [
            "amount" => $wallet->amount + $integer_amount,
        ]);
        // update wallet Commissions storage with rest data
        $rest_commissions = $amount - $final_converted_commissions;
        $this->transferToMainCommissionsWallet($wallet, $rest_commissions, $amount);
    }
    /**
     * transfer To Main Commissions Wallet
     *
     * @param  mixed $wallet
     * @param  mixed $amount
     * @param  mixed $full_amount
     * @return void
     */
    public function transferToMainCommissionsWallet($wallet, $amount, $full_amount)
    {
        // calculate real time value and save
        WalletFacade::update($wallet, [
            "commissions" => ($wallet->commissions * 1) + $amount,
            "tp_commissions" => $wallet->tp_commissions - $full_amount,
        ]);
    }
}
