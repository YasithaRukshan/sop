<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class Web3Facade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'web3\web3';
    }
}
