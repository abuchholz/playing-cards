<?php

namespace App\Listeners;

use App\Events\CardsShuffled;
use App\Events\NoMoreCards;
use App\Events\OneCardDealt;
use Illuminate\Contracts\Queue\ShouldQueue;

class CardSubscriber implements ShouldQueue
{

    public function shuffle(CardsShuffled $event)
    {
        // TODO: What now? Stuffs been shuffled, do we care?
    }

    public function oneCardDealt(OneCardDealt $event)
    {
        // TODO: What now? We've dealt a card...
    }

    public function noMoreCards(NoMoreCards $event)
    {
        // TODO: What now? We don't have any cards left...
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

        $events->listen(
            NoMoreCards::class,
            'App\Listeners\CardSubscriber@noMoreCards'
        );
    }

}