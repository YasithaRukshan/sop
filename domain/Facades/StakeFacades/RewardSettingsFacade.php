<?php

namespace domain\Facades\StakeFacades;

use Illuminate\Support\Facades\Facade;


class RewardSettingsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\Contracts\StakeRewardsServices\RewardSettingsService';
    }
}
