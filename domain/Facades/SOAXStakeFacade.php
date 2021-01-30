<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class SOAXStakeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\MainRPC20Services\MainSOAXService\SOAXStakeServices';
    }
}
