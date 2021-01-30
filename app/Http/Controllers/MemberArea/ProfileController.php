<?php

namespace App\Http\Controllers\MemberArea;

use App\Http\Controllers\Controller;
use App\Traits\FormHelper;
use domain\Facades\Customer\CustomerFacade;
use Illuminate\Http\Request;
use Countries;
use CountryState;
use DougSisk\CountryState\CountryState as CountryStateCountryState;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class ProfileController extends  ParentController
{
    use FormHelper;
    /**
     * View My Profile
     *
     * @return void
     */
    public function index()
    {
        $response['countries'] = Countries::getList('en', 'php');
        return view('MemberArea.Pages.Profile.all')->with($response);
    }
    /**
     * Update My Profile
     *
     * @return void
     */
    public function update(Request $request)
    {
        $response = CustomerFacade::updateData($request->all());
        $response['alert-success'] = $response['msg'];
        return redirect()->route('profile')->with($response);
    }

    /**
     * check Password
     *
     * @return void
     */
    public function checkPassword(Request $request)
    {
        $response = CustomerFacade::checkPassword($request);
        return $response;
    }

    /**
     * update username
     *
     * @return void
     */
    public function updateUsername(Request $request)
    {
        $response = CustomerFacade::updateUsername($request->all());
        return redirect()->back();
    }

    /**
     * Get States For Selected Country
     *@param Request $request
     */
    public function getStates(Request $request)
    {
        return Cookie::queue('countryValue', $request->country, 9500);
    }
}
