<?php

namespace domain\Contact;

use App\Models\CustomerContactUs;
use App\Rules\ReCaptchaRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: Speralabs
 * Date: 10/07/2020
 * Time: 02:10 PM
 */
class ContactService
{
    protected $contact;


    public function __construct()
    {
        $this->contact = new CustomerContactUs();
    }

    /**
     * Create contact
     */
    public function create(array $request)
    {
        Validator::make($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'g-recaptcha-response' => ['required', new   ReCaptchaRule]
        ])->validate();

        return $this->contact->create($request);
    }
}
