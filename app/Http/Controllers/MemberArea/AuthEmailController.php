<?php

namespace App\Http\Controllers\MemberArea;

use App\Events\ConfirmationEvent;
use App\Http\Controllers\Controller;
use domain\Facades\Customer\CustomerFacade;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthEmailController extends ParentController
{
    /**
     * User email Vilify
     *
     * @return void
     */
    public function verify(EmailVerificationRequest $request)
    {

        $request->fulfill();
        event(new ConfirmationEvent(Auth::user()));
        return redirect('/dashboard');
    }

    /**
     * Resend verification email
     *
     * @return void
     */
    public function resend(Request $request)
    {

        $request->user()->sendEmailVerificationNotification();
        return back()->with('emailStatus', 'verification-link-sent');
    }

    /**
     * getPuzzle
     *
     * @return void
     */
    public function getPuzzle()
    {
        return view('MemberArea.Pages.captcha.puzzel');
    }

    /**
     * emailVerification
     *
     * @return void
     */
    public function puzzleEmailVerification()
    {
        return CustomerFacade::verifyUser(Auth::user()->id);
    }
}
