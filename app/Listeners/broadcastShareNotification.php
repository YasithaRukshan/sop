<?php

namespace App\Listeners;

use App\Events\ProductionInitEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class broadcastShareNotification implements ShouldQueue
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
     * @param  ProductionInitEvent  $event
     * @return void
     */
    public function handle(ProductionInitEvent $event)
    {
        //
    }
       /**
     * Get the tags that should be assigned to the job.
     *
     * @return array
     */
    public function tags()
    {
        return ['Notification', 'Production'];
    }
}
