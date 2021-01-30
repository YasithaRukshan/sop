<?php

namespace domain\Facades;

use domain\ProductionService\ContractProductionServices\ContractProductionService;
use Illuminate\Support\Facades\Facade;

class ContractProductionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ContractProductionService::class;
    }
}
