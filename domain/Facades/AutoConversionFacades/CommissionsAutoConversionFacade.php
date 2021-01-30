<?php

namespace domain\Facades\AutoConversionFacades;

use Illuminate\Support\Facades\Facade;

class CommissionsAutoConversionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Wallet\AutoConversionService\CommissionsAutoConversionService';
    }
}
