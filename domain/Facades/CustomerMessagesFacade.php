<?php

namespace domain\Facades;

/**
 * Created by PhpStorm.
 * User: Speralabs
 * Date: 10/07/2020
 * Time: 10:45 AM
 */
use Illuminate\Support\Facades\Facade;


class CustomerMessagesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Messages\CustomerMessagesService';
    }
}