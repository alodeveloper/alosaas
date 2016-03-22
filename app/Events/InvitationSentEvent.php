<?php

namespace App\Events;

use App\Events\Event;
use App\Invitation;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InvitationSentEvent extends Event
{
    use SerializesModels;

    public $invitation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Invitation $invitation)
    {
      $this->invitation = $invitation;
    }

    /*
     * Get the channels the event should be broadcast on.
     *
     * @return array

    public function broadcastOn()
    {
        return [];
    }*/
}
