<?php

namespace App\Events;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Orders $order)
    {
        $this->order    = $order;
        $this->user     = $user;
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
