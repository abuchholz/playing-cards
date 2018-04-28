<?php

namespace App\Events;

use App\Card;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OneCardDealt extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /** @var $card Card */
    public $card;

    /**
     * OneCardDealt constructor.
     *
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function broadcastOn()
    {
        return ['deal-one-card'];
    }

}
