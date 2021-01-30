<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use App\Models\User;
use App\Rules\ReCaptchaRule;
use domain\Facades\Customer\CustomerFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => $this->passwordRules(),
            'g-recaptcha-response' => ['required', new   ReCaptchaRule]
        ])->validate();

        $referrer = null;
        if ($rfid = Cookie::get('rfid')) {
            $referrer = CustomerFacade::getByUsername($rfid);
        } else {
            $username = config('register.default_referral');
            $referrer = CustomerFacade::getByUsername($username);
        }
        $data = Customer::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'parent_id' => $referrer ? $referrer->id : null,
        ]);
        $walletData['customer_id'] = $data['id'];
        WalletFacade::make($walletData, false);
        return $data;
    }
}
