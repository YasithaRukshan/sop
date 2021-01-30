<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class AccountFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Wallet\AccountsService';
    }
}
