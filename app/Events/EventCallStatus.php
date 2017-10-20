<?php

namespace App\Events;

use App\Participant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventCallStatus implements ShouldBroadcast
{

    use Dispatchable, SerializesModels, InteractsWithSockets;

    public $participant;

    /**
     * Create a new event instance.
     *
     */
    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('medsitter-call-status');
    }
}
