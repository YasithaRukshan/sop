<?php

namespace domain\Facades\StakeFacades;

use Illuminate\Support\Facades\Facade;

class RewardRedemptionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Contracts\StakeRewardsServices\RewardRedemptionService';
    }
}
