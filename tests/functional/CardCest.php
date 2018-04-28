<?php

use App\Card;
use App\Services\CardService;

class CardCest
{

    public function shuffleSuccessfully(FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/shuffle');

        /** @var CardService $cs */
        $cs = $I->grabService(CardService::class);
        $order = $cs->getIds();
        $I->assertEquals(52, count($order));

        $I->sendAjaxPostRequest('/shuffle');
        $new_order = $cs->getIds();
        $I->seeNotEquals($order, $new_order);
        $I->assertEquals(52, count($new_order));
    }

    public function getOneCardSuccessfully(FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/shuffle');

        /** @var CardService $cs */
        $cs = $I->grabService(CardService::class);
        $order = $cs->getIds();
        $I->assertEquals(52, count($order));

        $I->sendAjaxPostRequest('/deal-one-card');
        $new_order = $cs->getIds();
        $I->seeNotEquals($order, $new_order);
        $I->assertEquals(51, count($new_order));

        $I->sendAjaxPostRequest('/deal-one-card');
        $last_order = $cs->getIds();
        $I->assertEquals(50, count($last_order));
    }


}