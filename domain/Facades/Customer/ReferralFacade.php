<?php

namespace domain\Facades\Customer;

use domain\Customer\ReferralService;
use Illuminate\Support\Facades\Facade;

class ReferralFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ReferralService::class;
    }
}