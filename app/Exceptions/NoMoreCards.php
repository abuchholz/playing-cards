<?php

namespace App\Exceptions;


class NoMoreCards extends \Exception
{

    public function __construct()
    {
        parent::__construct('There are no more cards!');
    }

}