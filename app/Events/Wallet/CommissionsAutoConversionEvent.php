<?php

namespace App\Events\Wallet;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommissionsAutoConversionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $wallet_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($wallet_id)
    {
        $this->wallet_id = $wallet_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
