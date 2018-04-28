<?php

namespace App\Services;

use App\Card;
use Illuminate\Cache\Repository;

class CardService
{
    protected $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    public function shuffle()
    {
        $ids = range(1, 52);
        shuffle($ids);
        \Log::debug('shuffling');

        $this->cache->forever('cards_ids', json_encode($ids));
    }
    
    /**
     * @return Card
     */
    public function dealOneCard()
    {

        \Log::debug('Dealing one card');
        $ids = $this->getIds();
        $id = array_pop($ids);

        $this->cache->forever('cards_ids', json_encode($ids));

        $card = Card::find($id);
        \Log::debug($id);

        return $card;
    }


    public function getIds()
    {
        return json_decode($this->cache->get('cards_ids'));
    }



}
