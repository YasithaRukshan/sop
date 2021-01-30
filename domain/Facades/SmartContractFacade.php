<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class SmartContractFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\wallet\SmartContractService';
    }
}
