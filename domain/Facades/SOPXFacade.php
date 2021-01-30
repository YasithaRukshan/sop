<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class SOPXFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\MainRPC20Services\MainSOPXService\SOPXServices';
    }
}
