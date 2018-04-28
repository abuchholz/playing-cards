<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Functional extends \Codeception\Module
{

    public function seeTrue($arg1)
    {
        $this->assertTrue($arg1);
    }

    public function seeFalse($arg1)
    {
        $this->assertFalse($arg1);
    }

    public function seeEquals($arg1, $arg2)
    {
        $this->assertEquals($arg1, $arg2);
    }

    public function seeNotEquals($arg1, $arg2)
    {
        $this->assertNotEquals($arg1, $arg2);
    }
}
