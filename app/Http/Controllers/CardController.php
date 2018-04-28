<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use App\Events\OneCardDealt;
use App\Events\CardsShuffled;

class CardController extends Controller
{

    /**
     * @param CardService $cs
     */
    public function dealOneCard(CardService $cs)
    {
        event(new OneCardDealt($cs->dealOneCard()));
    }

    /**
     * @param CardService $cs
     */
    public function shuffle(CardService $cs)
    {
        $cs->shuffle();
        event(new CardsShuffled($cs->getCardIdsInCache()));
    }

}
