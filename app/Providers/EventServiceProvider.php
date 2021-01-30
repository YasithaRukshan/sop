<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\ConfirmationEvent' => [
            'App\Listeners\ConfirmationEventListener',
        ],
        'App\Events\NewReferrerEvent' => [
            'App\Listeners\NewReferrerEventListener',
        ],
        'App\Events\OrderPlacedEvent' => [
            'App\Listeners\OrderPlacedEventListener',
        ],
        'App\Events\PaymentStatusEvent' => [
            'App\Listeners\PaymentStatusEventListener',
        ],
        'App\Events\WalletBalanceEvent' => [
            'App\Listeners\WalletBalanceEventListener',
        ],
        'App\Events\WelcomeEvent' => [
            'App\Listeners\WelcomeEventListener',
        ],
        'App\Events\WithdrawCreateEvent' => [
            'App\Listeners\WithdrawCreateEventListener',
        ],
        'App\Events\TransactionConfirmedEvent' => [
            // 'App\Listeners\SendShipmentNotification',
        ],
        'App\Events\DepositConfirmationEvent' => [
            'App\Listeners\DepositConfirmationListener',
            'App\Listeners\PayCommissionsListener',
            'App\Listeners\DepositConfirmationNotification',
        ],
        'App\Events\WalletModifyEvent' => [
            // 'App\Listeners\accountsInitializeListener',
        ],
        'App\Events\NewStakeEvent' => [
            'App\Listeners\stakeSOAXTransferListener',
            'App\Listeners\newStakeNotification',
            'App\Listeners\Rewards\rewardsBroadcastListener',
        ],
        'App\Events\ProductionInitEvent' => [
            'App\Listeners\broadcastShareListener',
            'App\Listeners\broadcastShareNotification',
        ],
        'App\Events\Wallet\SOPXAutoConversionEvent' => [
            'App\Listeners\Wallet\SOPXAutoConversionListener',
        ],
        'App\Events\Wallet\CommissionsAutoConversionEvent' => [
            'App\Listeners\Wallet\CommissionsAutoConversionListener',
        ],
        'App\Events\Wallet\SOAXTransactionValidationEvent' => [
            'App\Listeners\Wallet\SOAXTransactionValidationListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
