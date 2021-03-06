<?php

use App\Exceptions\NoMoreCards;
use Codeception\TestCase\Test;
use Illuminate\Cache\Repository;
use App\Services\CardService;
use App\Card;

class CardServiceTest extends Test
{
    /** @var Repository $cache */
    protected $cache;

    public function _before()
    {
        parent::_before();
    }

    public function testShuffle()
    {
        $cs = new CardService(cache()->store());
        // Initial Shuffle
        $cs->shuffle();
        $idsInCacheBefore = $cs->getCardIdsInCache();

        // Another Shuffle
        $cs->shuffle();
        $idsInCacheAfter = $cs->getCardIdsInCache();

        $this->assertNotEquals($idsInCacheBefore, $idsInCacheAfter);

        // I think we are okay to assume this.
        // The changes a deck is shuffled perfectly is 1 in 80,658,175,170,943,878,571,660,636,856,403,766,975,289,505,440,883,277,824,000,000,000,000
        $this->assertNotEquals(range(1, 52), $idsInCacheAfter);
    }

    public function testDealCards()
    {
        $cs = new CardService(cache()->store());

        // Initial Shuffle
        $cs->shuffle();
        $idsInCache = $cs->getCardIdsInCache();

        $cardIdsDealt = [];
        for ($i = 0; $i < 52; $i++) {
            $cardIdsDealt[] = $cs->dealOneCard();
        }

        $this->assertEmpty($cs->getCardIdsInCache());

        for ($i = 0; $i < 52; $i++) {
            $this->assertContains($idsInCache[$i], $cardIdsDealt);
        }
        $this->expectException(NoMoreCards::class);
        $cs->dealOneCard();

    }

    public function testDealAll()
    {
        $cs = new CardService(cache()->store());
        $cs->shuffle();
        $cs->dealAll();

        $this->assertEmpty($cs->getCardIdsInCache());
    }

}