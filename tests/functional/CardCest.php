<?php
use App\User;
use App\Role;
use App\Card;

class CardCest
{
    private $user;

    public function _before()
    {
//        $this->user = factory(User::class)->create();
//        $this->user->roles()->sync([Role::USER_ROLE_ID]);
//        factory(Card::class)->create(['user_id' => $this->user->id]);
    }

    public function shuffleSuccessfully(FunctionalTester $I)
    {
        $I->amOnPage('/');
//        $I->click('Create New Post');

//        $I->seeCurrentUrlEquals('/post');
        $I->see('Cards');
    }

    public function getOneCardSuccessfully(FunctionalTester $I)
    {
    }

}