<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class OwnerContactFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\OwnerContactServices\OwnerContactServices';
    }
}

?>