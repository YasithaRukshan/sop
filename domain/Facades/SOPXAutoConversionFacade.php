<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class SOPXAutoConversionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Wallet\AutoConversionService\SOPXAutoConversionService';
    }
}
