<?php

namespace App\Listeners;

use App\Events\WalletModifyEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class accountsInitializeListener
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
     * @param  WalletModifyEvent  $event
     * @return void
     */
    public function handle(WalletModifyEvent $event)
    {
        //
    }
}
