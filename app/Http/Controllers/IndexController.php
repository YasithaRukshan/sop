<?php

namespace App\Http\Controllers;

use domain\Facades\Customer\CustomerFacade;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('SaveReferrerCookie');
    }
    /**
     * View Public Index
     *
     * @return void
     */
    public function index()
    {
        if (request()->getHost() == "solaroilproject.com") {
            return view('PublicArea.Pages.demoHome.index');
        }
        return view('PublicArea.Pages.Index.index');
    }
    public function landing()
    {

        return view('PublicArea.Pages.Index.index');
    }
    /**
     * about
     *
     * @return void
     */
    public function aboutUs()
    {
        return view('PublicArea.Pages.AboutUs.index');
    }
    /**
     * privacyPolicy
     *
     * @return void
     */
    public function privacyPolicy()
    {
        return view('PublicArea.Pages.StanderdPages.privacy');
    }
    /**
     * termsAndConditions
     *
     * @return void
     */
    public function termsAndConditions()
    {
        return view('PublicArea.Pages.StanderdPages.termsAndConditions');
    }
    /**
     * dataSecurityPolicy
     *
     * @return void
     */
    public function dataSecurityPolicy()
    {
        return view('PublicArea.Pages.StanderdPages.dataSecurity');
    }
    /**
     * gdprDisclosurePolicy
     *
     * @return void
     */
    public function gdprDisclosure()
    {
        return view('PublicArea.Pages.StanderdPages.gdpr');
    }
    /**
     * RiskDisclosure
     *
     * @return void
     */
    public function riskDisclosure()
    {
        return view('PublicArea.Pages.StanderdPages.RiskDisclosure');
    }
    /**
     * kycPolicy
     *
     * @return void
     */
    public function kycPolicy()
    {
        return view('PublicArea.Pages.StanderdPages.kyc');
    }
    /**
     * amlPolicy
     *
     * @return void
     */
    public function amlPolicy()
    {
        return view('PublicArea.Pages.StanderdPages.aml');
    }
    /**
     * View Public login
     *
     * @return void
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * View Public register
     *
     * @return void
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Customer email validation
     *
     * @return void
     */
    public function email(Request $request)
    {
        return CustomerFacade::ValidateEmail($request);
    }

    /**
     * Customer user name validation
     *
     * @return void
     */
    public function userName(Request $request)
    {
        return CustomerFacade::ValidateUserName($request);
    }

    /**
     * Get customer user name
     *
     * @return void
     */
    public function getName(Request $request)
    {
        return CustomerFacade::getName($request['username']);
    }
}
