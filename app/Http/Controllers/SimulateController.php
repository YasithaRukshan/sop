<?php

namespace App\Http\Controllers;

use domain\Facades\Customer\CustomerFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimulateController extends Controller
{

    /**
     * simulateUser
     *
     * @param  mixed $hash
     * @return void
     */
    public function simulateUser($hash)
    {
        $user = CustomerFacade::getBySimulate($hash);
        if ($user) {
            Auth::logout();
            Auth::login($user, true);
            return redirect()->route('dashboard');
        } else {
            abort(401, "Authorization Failed");
        }
    }
}
