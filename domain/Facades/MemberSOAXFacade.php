<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class MemberSOAXFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\MainRPC20Services\MemberSOAXServices';
    }
}
