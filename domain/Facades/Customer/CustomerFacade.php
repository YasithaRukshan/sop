<?php

namespace domain\Facades\Customer;

use domain\Customer\CustomerService;
use Illuminate\Support\Facades\Facade;

class CustomerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CustomerService::class;
    }
}