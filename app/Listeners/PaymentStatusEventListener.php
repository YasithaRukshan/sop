<?php

namespace App\Listeners;

use App\Events\PaymentStatusEvent;
use App\Mail\PaymentStatusEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PaymentStatusEventListener implements ShouldQueue
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
     * @param  PaymentStatusEvent  $event
     * @return void
     */
    public function handle(PaymentStatusEvent $event)
    {
        $data = $event->data;
        Mail::to($data['user']['email'])->send(new PaymentStatusEmail($data));
    }
}
