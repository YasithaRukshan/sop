<?php

namespace App\Listeners;

use App\Events\NewStakeEvent;
use domain\Facades\ContractsFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class stakeSOAXTransferListener implements ShouldQueue
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
        $wallet = $event->wallet;
        $contract = $event->contract;
        ContractsFacade::transferToStakedAccount($wallet, $contract);
    }
}
