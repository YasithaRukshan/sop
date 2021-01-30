<?php

namespace App\Http\Controllers\MemberArea;

use App\Http\Controllers\Controller;
use App\Traits\ContractHelper;
use App\Traits\ReferralsHelper;
use App\Traits\UtilityHelper;
use App\Traits\WalletHelper;
use domain\Facades\StakeFacades\RewardCollectFacade;
use domain\Facades\StakeFacades\RewardFacade;
use domain\Facades\StakeFacades\RewardRedemptionFacade;
use domain\Facades\StakeFacades\RewardTransactionFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class SocialImpactController extends ParentController
{
    use ReferralsHelper;
    use WalletHelper;
    use ContractHelper;
    use UtilityHelper;

    /**
     * View  Social Impacts
     *
     * @return void
     */
    public function index()
    {
        $response['tc'] = $this;
        $response['collectingReward'] = RewardFacade::getAllDgreeRewards();
        return view('MemberArea.Pages.SocialImpact.all')->with($response);
    }
    /**
     * View  Social Impacts logs with url data
     *
     * @return void
     */
    public function view(Request $request, $degree = null)
    {
        $response['transactions'] = RewardFacade::getLogs($degree, Auth::user()->wallet->id);
        $response['tc'] = $this;
        $response['degree'] = $degree;
        return view('MemberArea.Pages.SocialImpact.view')->with($response);
    }
    /**
     * createRedemption
     *
     * @return void
     */
    public function createRedemption()
    {
        // abort(401);
        $response['tc'] = $this;
        $response['can_redeem'] = RewardRedemptionFacade::canRedeem();
        return view('MemberArea.Pages.SocialImpact.Redemptions.new')->with($response);
    }
    /**
     * transactions
     *
     * @return void
     */
    public function transactions()
    {
        return view('MemberArea.Pages.SocialImpact.Redemptions.transactions');
    }
    /**
     * collectRewards
     *
     * @param  mixed $request
     * @return void
     */
    public function collectRewards(Request $request)
    {
        Session::flash('alert-success', 'Rewards Sent to main rewards wallet successfully');
        return RewardCollectFacade::collectTheRewards($request->all()['reward_id']);
    }
    /**
     * collectAllRewards
     *
     * @param  mixed $request
     * @return void
     */
    public function collectAllRewards()
    {
        Session::flash('alert-success', 'All Rewards Sent to main rewards wallet successfully');
        return RewardCollectFacade::collectAllRewards();
    }
    /**
     * storeRedemption
     *
     * @param  mixed $var
     * @return void
     */
    public function storeRedemption(Request $request)
    {

        $checkValue = RewardRedemptionFacade::storeRewardsRedemption($request);
        if ($checkValue) {
            $response['alert-success'] = 'Rewards redemption successfully';
            return redirect()->route('social.impact')->with($response);
        } else {
            $response['alert-danger'] = "You cantnot get getaer than your available for withdrawal";
            return redirect()->back()->with($response);
        }
    }
}
