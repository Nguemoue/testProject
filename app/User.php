<?php 
namespace App;
class User extends Table{
    protected $table = 'users';
    static $user = null;
    static  function getUser(){
        if(self::$user==null)
            self::$user = new self();

        return self::$user;
    }
}