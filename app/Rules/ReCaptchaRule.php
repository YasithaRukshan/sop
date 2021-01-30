<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class ReCaptchaRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        // Validate ReCaptcha
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/'
        ]);
        $response = $client->post('siteverify', [
            'query' => [
                'secret' => config('services.google_recaptcha.secret_key'),
                'response' => $value
            ]
        ]);
        $respBody = $response->getBody();

        if ($respBody && (json_decode($respBody)->success == true)) {
            return json_decode($respBody)->success;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please Verify Recaptcha Correctly.';
    }
}
