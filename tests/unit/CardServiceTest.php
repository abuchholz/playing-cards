<?php

use App\User;
use App\Role;
use Codeception\TestCase\Test;

class CardServiceTest extends Test
{

    public function testShuffle()
    {
//        $this->user->roles()->sync([Role::ADMIN_ROLE_ID]);
//        $this->tester->cantSeeRecord('role_user', ['user_id' => $this->user->id, 'role_id' => Role::USER_ROLE_ID]);
//        $this->tester->seeRecord('role_user', ['user_id' => $this->user->id, 'role_id' => Role::ADMIN_ROLE_ID]);
        $this->assertTrue(true);
    }

    public function testDealOneCard()
    {
        $this->assertTrue(true);
    }
}