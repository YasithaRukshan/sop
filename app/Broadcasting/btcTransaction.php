<?php

namespace App\Broadcasting;

use App\Models\Customer;
use domain\Facades\TransactionFacade;

class btcTransaction
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\Customer  $user
     * @return array|bool
     */
    public function join(Customer $user,string $address)
    {
        if ($transaction = TransactionFacade::getByAddress($address)) {

            return $user->id == $transaction->wallet->user;
        }
        return false;
    }
}
