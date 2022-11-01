<?php 
namespace Database;
use PDOException;
use PDO;
class Database{
   static protected ?PDO $pdo = null;
    protected $host;
    protected $user;
    protected $password;
    protected $dbname;
    private $config;
    function __construct()
    {   
        $this->config = require ('config/db.php');
        $this->host = $this->config['db_host'];
        $this->password = $this->config['db_password'];
        $this->user = $this->config['db_user'];
        $this->dbname = $this->config['db_name'];

        try{
            self::$pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            die('erreur '.$e->getMessage());
        }
    }
   static function getPdo(){
        if(self::$pdo == null){
            new self();
        }
        return self::$pdo;
    }

}