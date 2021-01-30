<?php

namespace domain\Facades;

use domain\ProductionService\OilPricesService\OilPriceService;
use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: Speralabs
 * Date: 10/07/2020
 * Time: 02:10 PM
 */
class OilPriceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OilPriceService::class;
    }
}
