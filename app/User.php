<?php 
namespace App;
class User extends Table{
    protected $table = 'users';
    static $user = null;
    static  function getInstance(){
        if(self::$user==null)
            self::$user = new self();

        return self::$user;
    }
}