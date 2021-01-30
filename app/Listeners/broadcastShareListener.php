<?php

namespace App\Listeners;

use App\Events\ProductionInitEvent;
use domain\Facades\ProductionManagementFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class broadcastShareListener implements ShouldQueue
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
        ProductionManagementFacade::shareTheProductions($event->production_id);
    }
      /**
     * Get the tags that should be assigned to the job.
     *
     * @return array
     */
    public function tags()
    {
        return ['Share', 'Production'];
    }
}
