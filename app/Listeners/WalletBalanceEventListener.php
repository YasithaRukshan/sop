<?php

namespace App\Listeners;

use App\Events\WalletBalanceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WalletBalanceEventListener implements ShouldQueue
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
     * @param  WalletBalanceEvent  $event
     * @return void
     */
    public function handle(WalletBalanceEvent $event)
    {
        //
    }
}
