<?php

namespace App\Listeners;

use App\Events\CardsShuffled;
use App\Services\CardService;
use App\Events\OneCardDealt;
use Illuminate\Contracts\Queue\ShouldQueue;

class CardSubscriber implements ShouldQueue
{

    protected $cs;

    /**
     * Shuffle constructor.
     *
     * @param CardService $cs
     */
    public function __construct(CardService $cs)
    {
        $this->cs = $cs;

    }

    public function shuffle(CardsShuffled $event)
    {
        // TODO: What now? Stuffs been shuffled, do we care?
    }

    public function oneCardDealt(OneCardDealt $event)
    {
        // TODO: What now? We've dealt a card...
    }


    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            CardsShuffled::class,
            'App\Listeners\CardSubscriber@shuffle'
        );

        $events->listen(
            OneCardDealt::class,
            'App\Listeners\CardSubscriber@oneCardDealt'
        );
    }

}