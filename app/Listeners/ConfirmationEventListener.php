<?php

namespace App\Listeners;

use App\Events\ConfirmationEvent;
use App\Mail\UserWelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ConfirmationEventListener implements ShouldQueue
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
     * @param  ConfirmationEvent $event
     * @return void
     */
    public function handle(ConfirmationEvent  $event)
    {
        $registered_user = $event->user;
        Mail::to($registered_user->email)->send(new UserWelcomeEmail($registered_user));
    }
}
