<?php

namespace domain\Facades\Convert;

use domain\Convert\BtcCService;
use Illuminate\Support\Facades\Facade;

class BtcRateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BtcCService::class;
    }
}
