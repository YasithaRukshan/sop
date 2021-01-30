<?php

namespace domain\Facades;

use domain\Wallet\TransactionService\CommissionsServices\Redemption\ShareRedemptionService;
use Illuminate\Support\Facades\Facade;

class ShareRedemptionsFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return  ShareRedemptionService::class;
    }
}
