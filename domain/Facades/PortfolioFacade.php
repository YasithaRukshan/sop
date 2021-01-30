<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: Speralabs
 * Date: 10/07/2020
 * Time: 02:10 PM
 */
class PortfolioFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Portfolio\PortfolioService';
    }
}