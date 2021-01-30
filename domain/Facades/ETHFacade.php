<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Created by Vs COde.
 * Date: 11/04/2020
 * Time: 02:10 PM
 */
class ETHFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Wallet\ETHTransactionService';
    }
}
