<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class ProductionManagementFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\ProductionService\ProductionServices\ProductionManagementService';
    }
}
