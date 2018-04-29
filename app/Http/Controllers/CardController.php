<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use App\Events\OneCardDealt;
use App\Events\CardsShuffled;
use App\Events\NoMoreCards;
use App\Exceptions\NoMoreCards as NoMoreCardsException;

class CardController extends Controller
{

    /**
     * @param CardService $cs
     */
    public function dealOneCard(CardService $cs)
    {
        try {
            event(new OneCardDealt($cs->dealOneCard()));
        } catch (NoMoreCardsException $e) {
            event(new NoMoreCards());
        }
    }

    /**
     * @param CardService $cs
     */
    public function dealAll(CardService $cs)
    {
        $cs->dealAll();
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
