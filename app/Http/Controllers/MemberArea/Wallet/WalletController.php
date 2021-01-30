<?php

namespace App\Http\Controllers\MemberArea\Wallet;

use App\Http\Controllers\MemberArea\ParentController;
use App\Traits\modalHelper;
use App\Traits\UtilityHelper;
use App\Traits\WalletHelper;
use domain\Facades\BTCPaymentFacade;
use domain\Facades\CommissionsFacade;
use domain\Facades\ContractsFacade;
use domain\Facades\SOPXAutoConversionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Http\Request;

class WalletController extends ParentController
{
    use WalletHelper;
    use modalHelper;
    use UtilityHelper;
    /**
     * View  Wallet
     *
     * @return void
     */
    public function index()
    {
        $response['tc'] = $this;
        return view('MemberArea.Pages.Wallet.all')->with($response);
    }
    /**
     * View production
     *
     * @param  mixed $request
     * @return void
     */
    public function production(Request $request)
    {

        $response['tc'] = $this;
        $response['contracts'] = ContractsFacade::getByAuth();
        $response['portfolios'] = ContractsFacade::getByAuthPortfolios();
        $response['view'] = view('MemberArea.Pages.Wallet.Components.product')->with($response);
        $response['count'] = count($response['contracts']);
        return view('MemberArea.Pages.Contracts.Production.all')->with($response);
    }
    /**
     * All purchases
     *
     * @param  mixed $request
     * @return void
     */
    public function purchaseAll(Request $request)
    {
        $response['purchases'] = WalletFacade::purchaseData($request->all());
        $response['tc'] = $this;
        return view('MemberArea.Pages.Wallet.Purchases.all')->with($response);
    }
    /**
     * View purchases by id
     *
     * @param  mixed $request
     * @return void
     */
    public function purchaseView($id)
    {
        $response['purchase'] = WalletFacade::purchaseViewData($id);
        if ($response['purchase']) {

            $response['commissions'] = CommissionsFacade::authCommissionsData();
            $response['tc'] = $this;
            return view('MemberArea.Pages.Wallet.Purchases.view')->with($response);
        }
        $response['alert-danger'] = "Not fond this purchase";
        return redirect()->route('wallet.purchase')->with($response);
    }
    /**
     * walletData
     *
     * @return void
     */
    public function walletData()
    {
        return WalletFacade::getWalletData();
    }
}
