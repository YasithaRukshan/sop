<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class BTCPaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Wallet\TransactionService\BtcPaymentService';
    }
}
