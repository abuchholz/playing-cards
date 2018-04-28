<?php

namespace App\Services;

use App\Card;
use Illuminate\Cache\Repository;

class CardService
{
    protected $redis;

    public function __construct(Repository $redis)
    {
        $this->redis = $redis;
    }

    public function shuffle()
    {
        $ids = range(1, 52);
        shuffle($ids);

        $this->redis->forever('cards_ids', json_encode($ids));
    }
    
    /**
     * @return Card
     */
    public function dealOneCard()
    {
        $ids = $this->getIds();
        $id = array_pop($ids);

        $this->redis->forever('cards_ids', json_encode($ids));

        $card = Card::find($id);
        \Log::debug($id);

        return $card;
    }


    public function getIds()
    {
        return json_decode($this->redis->get('cards_ids'));
    }



}
