<?php

namespace App\Http\Controllers\MemberArea\Wallet;

use App\Http\Controllers\MemberArea\ParentController;
use App\Traits\UtilityHelper;
use App\Traits\WalletHelper;
use domain\Facades\BTCPaymentFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Http\Request;

class TransactionController extends ParentController
{
    // Use Traits
    use UtilityHelper;
    use WalletHelper;
    /**
     * create
     * @param  mixed $request
     * @return void
     */
    public function create(Request $request)
    {
        $response['tc'] = $this;
        return view('MemberArea.Pages.Wallet.Purchases.New.index')->with($response);
    }
    /**
     * storeTransaction
     *
     * @param  mixed $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return WalletFacade::storeTransaction($request->all());
    }
    /**
     * Store Transaction Call Back Eth
     *
     * @param  mixed $request
     * @return view
     */
    public function storeCallbackEth(Request $request)
    {
        WalletFacade::validateTransactionEth($request->all());
        return view('MemberArea.Pages.Wallet.Purchases.New.Components.transactionSuccess');
    }
    /**
     * BTCTransactionCallBackValidate
     *
     * @param  mixed $request
     * @return mixed
     */
    public function BTCTransactionCallBackValidate(Request $request)
    {
        return BTCPaymentFacade::callbackValidate($request);
    }
    /**
     * cAPP Transaction Call Back Validate
     *
     * @param  mixed $request
     * @return mixed
     */
    public function cAPPTransactionCallBackValidate(Request $request)
    {
        return TransactionFacade::cAppCallbackValidate($request);
    }
    /**
     * zelle Transaction Call Back Validate
     *
     * @param  mixed $request
     * @return mixed
     */
    public function zelleTransactionCallBackValidate(Request $request)
    {
        return TransactionFacade::zelleCallbackValidate($request);
    }
    /**
     *
     * conversion Rates
     *
     * @param  mixed $request
     * @return view
     */
    public function conversionRates(Request $request)
    {
        $response['eth'] = WalletFacade::convert('SOAX', 'ETH', 1);
        $response['btc'] = WalletFacade::convert('SOAX', 'BTC', 1);
        return view('MemberArea.Pages.Wallet.Purchases.New.Components')->with($response);
    }
    /**
     * conversion Rates Real
     *
     * @param  mixed $request
     * @return mixed
     */
    public function conversionRatesReal(Request $request)
    {
        $response['eth'] = 0;
        $response['btc'] = 0;
        $response['capp'] = 0;
        $response['zello'] = 0;
        if ($request->has('soax') && $request->soax > 0) {
            # code...
            $response['eth'] = WalletFacade::convert('SOAX', 'ETH', $request->soax);
            $response['btc'] = WalletFacade::convert('SOAX', 'BTC', $request->soax);
            $response['capp'] = WalletFacade::convert('SOAX', 'CApp', $request->soax);
            $response['zello'] = WalletFacade::convert('SOAX', 'Zelle', $request->soax);
        }
        return $response;
    }
    /**
     * Store Invoice
     *
     * @param  mixed $request
     * @return mixed
     */
    public function storeInvoice(Request $request)
    {
        if ($request->has('trId') && $request->has('invoice')) {
            $transaction = TransactionFacade::get($request->trId * 1);
            if ($transaction) {
                TransactionFacade::update($transaction, [
                    'thash' => $request->invoice,
                ]);
                return $request;
            }
        }
    }
}
