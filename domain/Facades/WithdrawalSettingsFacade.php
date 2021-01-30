<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class WithdrawalSettingsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Wallet\WithdrawalService\WithdrawalSettingsService';
    }
}
