<?php

namespace App\Http\Controllers\MemberArea;

use App\Http\Controllers\MemberArea\ParentController;
use App\Traits\ContractHelper;
use App\Traits\ReferralsHelper;
use App\Traits\UtilityHelper;
use App\Traits\WalletHelper;
use domain\Facades\Customer\CustomerFacade;
use domain\Facades\Customer\ReferralFacade;
use domain\Facades\ShareRedemptionsFacades;
use domain\Facades\ShareSettingsFacade;
use domain\Facades\WithdrawalFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralsController extends ParentController
{
    use ReferralsHelper;
    use ContractHelper;
    use WalletHelper;
    use UtilityHelper;

    /**
     * View Referrals
     *
     * @return void
     */
    public function index($id = null)
    {
        $response['authData'] = ReferralFacade::getAuthReferrals();
        $response['authDataID'] = ReferralFacade::getAuthReferralsID();
        $response['tc'] = $this;
        return view('MemberArea.Pages.Referral.all')->with($response);
    }
    /**
     * View Referrals
     *
     * @return void
     */
    public function checkNext(Request $request)
    {
        return ReferralFacade::checkNext($request);
    }

    /**
     * View Referrals
     *
     * @return void
     */
    public function setNext(Request $request)
    {
        return ReferralFacade::setNext($request);
    }

    /**
     * View Referrals
     *
     * @return void
     */
    public function setFirst()
    {
        return ReferralFacade::setFirst();
    }


    /**
     * View Referrals
     *
     * @return void
     */
    public function loadData(Request $request)
    {
        $response['data'] = CustomerFacade::getReferralsData($request['value']);
        $response['value'] = $request['value'];
        return view('MemberArea.Pages.Referral.Components.single_row')->with($response);
    }
    /**
     * View Referrals
     *
     * @return void
     */
    public function loadModal(Request $request)
    {
        $response['data'] = ReferralFacade::getAllReferralsData($request['value'], $request['level']);
        $response['tc'] = $this;
        return view('MemberArea.Pages.Referral.Components.modal_row')->with($response);
    }
    /**
     * View Referrals
     *
     * @return void
     */
    public function childLoadModal(Request $request)
    {
        $response['data'] = ReferralFacade::childReferralsData($request);
        $response['tc'] = $this;
        return view('MemberArea.Pages.Referral.Components.child_row')->with($response);
    }

    /**
     * settings
     *
     * @return void
     */
    public function settings()
    {
        abort(401); //we don't maintaining this page anymore
        $response['settings'] = [];
        if (Auth::user()->wallet && $settings = Auth::user()->wallet->shareSettings) {
            $response['settings'] = $settings;
        }
        return view('MemberArea.Pages.Referral.settings')->with($response);
    }
    /**
     * share Settings Store
     *
     * @param  mixed $request
     * @return void
     */
    public function settingsStore(Request $request)
    {
        ShareSettingsFacade::make($request->all());
        return redirect()->back()->with('alert-success', 'Updated Successfully');
    }
    /**
     * redemptions
     *
     * @param  mixed $request
     * @return void
     */
    public function redemptions()
    {
        $response['tc'] = $this;
        $response['can_redeem'] = ShareRedemptionsFacades::canRedeem();
        return view('MemberArea.Pages.Referral.Redemptions.redemption')->with($response);
    }

    /**
     * redemptionsStore
     *
     * @param  mixed $request
     * @return void
     */
    public function redemptionsStore(Request $request)
    {
        $checkValue = ShareRedemptionsFacades::storeShareRedemption($request);
        if ($checkValue) {
            $response['alert-success'] = 'Share commissions redemption successfully';
            return redirect()->route('referrals')->with($response);
        } else {
            $response['alert-danger'] = "Limit exceeded";
            return redirect()->back()->with($response);
        }
    }
    /**
     * transactions
     *
     * @return void
     */
    public function transactions()
    {
        return view('MemberArea.Pages.Referral.transactions');
    }
    public function logs(Request $request)
    {
        $response['name'] = "";
        if ($request->has('first_name')) {
            $response['name'] = $request->first_name;
        }
        return view('MemberArea.Pages.Referral.logs')->with($response);
    }
}
