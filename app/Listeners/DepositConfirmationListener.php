<?php

namespace App\Listeners;

use App\Events\DepositConfirmationEvent;
use domain\Facades\TransactionFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DepositConfirmationListener implements ShouldQueue
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
     * @param  DepositConfirmationEvent  $event
     * @return void
     */
    public function handle(DepositConfirmationEvent $event)
    {
        $transaction = $event->transaction;

    }
    /**
     * tags
     *
     * @return void
     */
    public function tags()
    {
        return ['SOAX Deposit'];
    }
}
