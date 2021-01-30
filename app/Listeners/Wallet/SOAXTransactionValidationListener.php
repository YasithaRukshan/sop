<?php

namespace App\Listeners\Wallet;

use App\Events\Wallet\SOAXTransactionValidationEvent;
use domain\Facades\BTCPaymentFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SOAXTransactionValidationListener implements ShouldQueue
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
     * @param  SOAXTransactionValidationEvent  $event
     * @return void
     */
    public function handle(SOAXTransactionValidationEvent $event)
    {
        // run validations
        BTCPaymentFacade::validateInvoice($event->invoice_id);
    }
       /**
     * Get the tags that should be assigned to the job.
     *
     * @return array
     */
    public function tags()
    {
        return ['SOAX','BTC','Validation'];
    }
}
