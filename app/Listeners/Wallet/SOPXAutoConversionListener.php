<?php

namespace App\Listeners\Wallet;

use App\Events\Wallet\SOPXAutoConversionEvent;
use domain\Facades\SOPXAutoConversionFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SOPXAutoConversionListener implements ShouldQueue
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
     * @param  SOPXAutoConversionEvent  $event
     * @return void
     */
    public function handle(SOPXAutoConversionEvent $event)
    {
        SOPXAutoConversionFacade::broadcastSOPXToWallets($event->wallet_id);
    }
       /**
     * Get the tags that should be assigned to the job.
     *
     * @return array
     */
    public function tags()
    {
        return ['SOPX','Auto Conversion'];
    }
}
