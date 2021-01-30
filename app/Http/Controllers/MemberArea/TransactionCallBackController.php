<?php

namespace App\Http\Controllers\MemberArea;

use App\Http\Controllers\Controller;
use domain\Facades\BTCPaymentFacade;
use Illuminate\Http\Request;

class TransactionCallBackController extends Controller
{
    public function __construct(){
        // $this->middleware('BTCCallBackValidation');
    }
    /**
     * storeTransactionCallbackBTC
     *
     * @param  mixed $request
     * @return void
     */
    public function storeTransactionCallbackBTC(Request $request){
        BTCPaymentFacade::callbackNew($request);
    }
}
