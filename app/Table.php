<?php 
namespace App;

use PDOException;
use Database\Database;

class Table{
   protected $table= '' ;
   protected $pdo;
   function __construct()
   {
       $this->pdo = Database::getPdo();
   }
  
   function  find(int $id): Array{
    $sql = "select * from ". $this->table. " where id = $id";
    try{
        $req = $this->pdo->query($sql);
        $req->execute();
    }catch(PDOException $e){
        var_dump($e->getMessage());
    }
    $res = $req->fetch();
    return $res;
}

function insert($data):int{
    $pdo = $this->pdo;
    $keys = implode(",",array_keys($data));
    $data = array_map(function($item) use($pdo){
        if(is_string($item) and !str_contains($item,"(")){
            $item = $pdo->quote($item);
        }
        return $item;
    },$data);
    $values =  implode(" , ",$data);
    $sql = "insert into  ".$this->table." (".$keys.") values (".$values.")";
    try{
        $result = $pdo->exec($sql);
    }catch(PDOException $e){
        return 0;
    }
    return $result;            
}
function update($data,$where = null):int{
    $pdo = $this->pdo;
    $sql = "";
    $data = array_map(function($item) use($pdo){
        if(is_string($item) and !str_contains($item,"(")){
            $item = $pdo->quote($item);
        }
        return $item;
    },$data);
    foreach($data as $k=>$v){
        $sql.=", $k = $v ";
    }
    $sql = substr($sql,1,-1);
    $sql = "update ".$this->table." set ".$sql."  ".$where;
    try{
        $result = $pdo->exec($sql);
    }catch(PDOException $e){
        return 0;
    }
    return $result;            
}
function all(){
    $sql = "select * from ".$this->table ;
    $req = $this->pdo->query($sql);
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

}