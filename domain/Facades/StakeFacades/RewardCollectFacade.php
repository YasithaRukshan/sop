<?php

namespace domain\Facades\StakeFacades;

use Illuminate\Support\Facades\Facade;

class RewardCollectFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Contracts\StakeRewardsServices\RewardCollectService';
    }
}
