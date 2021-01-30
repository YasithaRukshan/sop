<?php

namespace App\Http\Controllers\MemberArea;

use App\Events\WalletModifyEvent;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Traits\FormHelper;
use App\Traits\StakingHelper;
use App\Traits\UtilityHelper;
use App\Traits\WalletHelper;
use domain\Facades\ContractsFacade;
use domain\Facades\MemberExWalletFacade;
use domain\Facades\SOAXStakeFacade;
use domain\Facades\OilPriceFacade;
use domain\Facades\PortfolioFacade;
use domain\Facades\ProductionManagementFacade;
use domain\Facades\StakeFacades\StakeRewardFacade;
use domain\Facades\WalletFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractsController extends ParentController
{
    use FormHelper;
    use WalletHelper;
    use StakingHelper;
    use UtilityHelper;

    /**
     * View All Contracts
     *
     * @return void
     */
    public function index()
    {
        $response['tc'] = $this;
        $response['contracts'] = ContractsFacade::getByAuth();
        return view('MemberArea.Pages.Contracts.all')->with($response);
    }

    /**
     * View Add New Portfolio
     *
     * @param  mixed $request
     * @return void
     */

    public function create()
    {
        $response['portfolios'] = PortfolioFacade::publishData();
        $response['tc'] = $this;
        return view('MemberArea.Pages.Contracts.new')->with($response);
    }
    /**
     * View Portfolio
     *
     * @return void
     */
    public function view($id)
    {
        $response['contract'] = ContractsFacade::getByEnId($id);
        if ($response['contract']) {
            $response['tc'] = $this;
            return view('MemberArea.Pages.Contracts.Show.show')->with($response);
        }

        // dd($response['contract']);
        // if ($response = ContractsFacade::view($id)) {
        // } else {
        $response['alert-danger'] = "Not fond this contract";
        return redirect()->route('contracts.all')->with($response);
        // }
    }

    /**
     * View store
     *
     * @return void
     */
    public function store(Request $request)
    {
        $request['customer_id'] = Auth::user()->id;
        ContractsFacade::create($request->all());
        $response['alert-success'] = "Successful add contract";
        return redirect()->route('contracts.all')->with($response);
    }

    /**
     * View store
     *
     * @return void
     */
    public function portfolio(Request $request)
    {
        return ContractsFacade::getPortfolioSummary($request->all());
    }

    /**
     * production
     *
     * @return void
     */
    public function production()
    {
        return ContractsFacade::getByAuthProduction();
    }
    /**
     * Calculator
     *
     * @return void
     */
    public function calculator()
    {
        return view('MemberArea.Pages.Contracts.Calculator.index');
    }

    /**
     * get contracts 
     *
     * @return void
     */
    public function getContracts(Request $request)
    {
        $response['tc'] = $this;
        $response['contracts']= ContractsFacade::getContractByProductId($request->id);
        return view('MemberArea.Pages.Contracts.Components.contract-table')->with($response);
    }
}
