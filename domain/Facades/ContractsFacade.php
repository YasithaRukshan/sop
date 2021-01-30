<?php

namespace domain\Facades;

use domain\Contracts\ContractsService;
use Illuminate\Support\Facades\Facade;

class ContractsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ContractsService::class;
    }
}
