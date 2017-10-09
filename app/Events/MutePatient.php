<?php

namespace App\Events;

use App\Participant;
use App\Pod;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Symfony\Component\Finder\Iterator\PathFilterIterator;

class MutePatient implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $room_key;

    /**
     * Create a new event instance.
     *
     * @param Pod $pod
     * @param Participant $participant
     */
    public function __construct(Pod $pod, Participant $participant)
    {

        $this->room_key = $pod->id . '-' . $participant->id;

        return $this->room_key;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('medsitter-mute-toggle');
    }
}
