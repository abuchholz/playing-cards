<?php

namespace App\Services;

use App\Card;
use App\Exceptions\NoMoreCards as NoMoreCardsException;
use Illuminate\Cache\Repository;

class CardService
{
    protected $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Shuffles the deck using Fisher Yates and stores IDs in cache
     */
    public function shuffle()
    {
        $cardIds = $this->getAllCardIds();
        $count = count($cardIds);

        // Fisher Yates @ O(n)
        for ($i=$count-1; $i>0; $i--) {
            $j = random_int(0, $i);

            $temp = $cardIds[$i];
            $cardIds[$i] = $cardIds[$j];
            $cardIds[$j] = $temp;
        }
        \Log::debug($cardIds);
        $this->storeCardIdsInCache($cardIds);
    }

    /**
     * Deals one card off the top of the deck
     *
     * @return Card
     * @throws NoMoreCardsException
     */
    public function dealOneCard()
    {
        $cardIds = $this->getCardIdsInCache();
        if (empty($cardIds)) {
            throw new NoMoreCardsException();
        }
        $id = array_shift($cardIds);
        $card = Card::find($id);

        $this->storeCardIdsInCache($cardIds);

        return $card;
    }


    public function getAllCardIds()
    {
        return Card::all()->pluck('id')->toArray();
    }

    public function getCardIdsInCache()
    {
        return json_decode($this->cache->get('cards_ids'));
    }

    public function storeCardIdsInCache($cardIds)
    {
        $this->cache->forever('cards_ids', json_encode($cardIds));
    }



}
