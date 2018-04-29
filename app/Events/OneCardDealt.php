<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OneCardDealt extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var int $cardId
     */
    public $cardId;

    /**
     * OneCardDealt constructor.
     *
     * @param integer $cardId
     */
    public function __construct($cardId)
    {
        $this->cardId = $cardId;
    }

    public function broadcastOn()
    {
        return ['deal-one-card'];
    }


}
