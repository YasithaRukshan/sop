<?php

namespace App\Listeners;

use App\Events\NewStakeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class newStakeNotification
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
        //
    }
}
