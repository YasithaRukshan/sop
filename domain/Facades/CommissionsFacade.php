<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class CommissionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Wallet\TransactionService\CommissionsServices\CommissionsService';
    }
}
