<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CardsShuffled extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /** @var array $order */
    public $order;

    /**
     * CardsShuffled constructor.
     *
     * @param array $cardIds
     */
    public function __construct($cardIds)
    {
        $this->order = $cardIds;
    }

    public function broadcastOn()
    {
        return ['shuffle'];
    }
}
