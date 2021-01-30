<?php

namespace domain\Facades;

use domain\wallet\WithdrawalService\WithdrawalService;
use Illuminate\Support\Facades\Facade;

class WithdrawalFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Wallet\WithdrawalService\WithdrawalService';
    }
}