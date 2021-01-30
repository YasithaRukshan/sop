<?php

namespace App\Listeners;

use App\Events\NewReferrerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewReferrerEventListener implements ShouldQueue
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
     * @param  NewReferrerEvent  $event
     * @return void
     */
    public function handle(NewReferrerEvent $event)
    {
        //
    }
}
