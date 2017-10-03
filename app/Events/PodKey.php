<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PodKey implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $token, $room_key, $pod_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($token, $room_key, $pod_id)
    {
        $this->token = $token;
        $this->room_key = $room_key;
        $this->pod_id = $pod_id;

        return $this;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('medsitter-pod-key');
    }
}
