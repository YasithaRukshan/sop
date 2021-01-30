<?php

namespace domain\Facades\Convert;

use Illuminate\Support\Facades\Facade;

class EthRateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Convert\Ethservice';
    }
}
