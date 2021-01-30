<?php

namespace App\Traits;

use App\Models\WalletTransaction;
use domain\Facades\WalletFacade;
use Illuminate\Support\Str;

trait modalHelper
{
    public function TransactionStatus(){
        return WalletTransaction::STATUS;

    }
    /**
     * soaxAmount
     *!important This method valid only for BTC
     * @param  mixed $transaction
     * @return void
     */
    public function payableSOAXAmount($transaction){
        if ($transaction->status == WalletTransaction::STATUS['COMPLETED']) {
            return 'SOAX '.$transaction->amount;
        }else{
            return 'SOAX '.$transaction->rq_amount;
        }
    }


    /**
     * btcAmount
     *!important This method valid only for BTC
     * @param  mixed $transaction
     * @return void
     */
    public function payableBTCAmount($transaction){
        if ($transaction->status == WalletTransaction::STATUS['COMPLETED']) {
            return 'BTC '.$transaction->value;
        }else{
            return 'BTC '.WalletFacade::convert('SOAX', 'BTC', $transaction->rq_amount);
        }
    }



    /**
     * transferredSOAXAmount
     *!important This method valid only for BTC
     * @param  mixed $transaction
     * @return void
     */
    public function transferredSOAXAmount($transaction){
        $btc = $transaction->paidValue();
        return 'SOAX '.WalletFacade::convert('BTC', 'SOAX', $btc);
    }

    /**
     * transferredBTCAmount
     * !important This method valid only for BTC
     * @param  mixed $transaction
     * @return void
     */
    public function transferredBTCAmount($transaction){
        return 'BTC '.$transaction->paidValue();
    }


    /**
     * minimumRestBTCAmount
     * !important This method valid only for BTC
     * @param  mixed $transaction
     * @return void
     */
    public function minimumRestBTCAmount($transaction){
        $btc = $transaction->paidValue();
        $soax = WalletFacade::convert('BTC', 'SOAX', $btc);
        $minimum_req_soax = config('payments.minimum_soax');
        $soax= $minimum_req_soax - $soax;
        return 'BTC '.WalletFacade::convert('SOAX', 'BTC', $soax);
    }

    /**
     * minimumRestSOAXAmount
     * !important This method valid only for BTC
     * @param  mixed $transaction
     * @return void
     */
    public function minimumRestSOAXAmount($transaction){
        $btc = $transaction->paidValue();
        $soax = WalletFacade::convert('BTC', 'SOAX', $btc);
        $minimum_req_soax = config('payments.minimum_soax');
        return 'SOAX '.($minimum_req_soax - $soax);
    }


    /**
     * requestedRestBTCAmount
     *!important This method valid only for BTC
     * @param  mixed $transaction
     * @return void
     */
    public function requestedRestBTCAmount($transaction){
        $btc = $transaction->paidValue();
        $soax = WalletFacade::convert('BTC', 'SOAX', $btc);
        $soax= $transaction->amount - $soax;
        return 'BTC '.WalletFacade::convert('SOAX', 'BTC', $soax);
    }

    /**
     * requestedRestSOAXAmount
     *!important This method valid only for BTC
     * @param  mixed $transaction
     * @return void
     */
    public function requestedRestSOAXAmount($transaction){
        $btc = $transaction->paidValue();
        $soax = WalletFacade::convert('BTC', 'SOAX', $btc);
        return 'SOAX '.($transaction->amount - $soax);
    }




}
