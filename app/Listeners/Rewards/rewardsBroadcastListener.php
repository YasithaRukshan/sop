<?php

namespace App\Listeners\Rewards;

use App\Events\NewStakeEvent;
use domain\Facades\StakeFacades\StakeRewardFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class rewardsBroadcastListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewStakeEvent  $event
     * @return void
     */
    public function handle(NewStakeEvent $event)
    {
        StakeRewardFacade::initializeRewards($event->contract->id);
    }
}
