<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class ETHPaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Wallet\TransactionService\EthPaymentService';
    }
}
