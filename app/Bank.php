<?php

namespace App;

class Bank extends Table
{
    protected $table = 'bank_coords';
    static $bank = null;
    static  function getInstance()
    {
        if (self::$bank == null)
            self::$bank = new self();

        return self::$bank;
    }
}
