<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NoMoreCards extends Event implements ShouldBroadcast
{

    public function broadcastOn()
    {
        return ['no-more-cards'];
    }

}
