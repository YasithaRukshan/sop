<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class ProductionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\ProductionService\ProductionServices\ProductionService';
    }
}
