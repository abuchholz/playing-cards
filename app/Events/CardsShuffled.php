<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class CardsShuffled extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /** @var array $order */
    public $order;

    /**
     * CardsShuffled constructor.
     *
     * @param $cardIds
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
