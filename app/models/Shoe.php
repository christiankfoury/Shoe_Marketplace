<?php

namespace app\models;

class Shoe extends \app\core\Model{
    public $shoe_id;
    public $brand;
    public $model;
    public $color;
    public $previously_sold_price;

    public function __construct(){
        parent::__construct();
    }

    public function getShoeByBrandModel($brand, $model){
        $SQL = 'SELECT * FROM shoe WHERE brand = :brand AND name = :name';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['brand'=>$brand, 'name'=>$model]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Shoe');
		return $STMT->fetch();//return the record	
    }

    public function getShoeByShoeId($shoe_id){
        $SQL = 'SELECT * FROM shoe WHERE shoe_id = :shoe_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['shoe_id'=>$shoe_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Shoe');
        return $STMT->fetch();//return the record
    }
}