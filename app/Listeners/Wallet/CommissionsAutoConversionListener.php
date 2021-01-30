<?php

namespace App\Listeners\Wallet;

use App\Events\Wallet\CommissionsAutoConversionEvent;
use domain\Facades\AutoConversionFacades\CommissionsAutoConversionFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommissionsAutoConversionListener implements ShouldQueue
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
     * @param  CommissionsAutoConversionEvent  $event
     * @return void
     */
    public function handle(CommissionsAutoConversionEvent $event)
    {
        CommissionsAutoConversionFacade::broadcastCommissionsWallets($event->wallet_id);
    }
}
