<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewStakeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $contract;
    public $wallet;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($contract,$wallet)
    {
        $this->contract = $contract;
        $this->wallet = $wallet;
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
