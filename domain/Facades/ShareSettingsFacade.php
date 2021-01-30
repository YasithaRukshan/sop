<?php

namespace domain\Facades;

use domain\Wallet\TransactionService\CommissionsServices\Redemption\ShareSettingsService;
use Illuminate\Support\Facades\Facade;

class ShareSettingsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ShareSettingsService::class;
    }
}
