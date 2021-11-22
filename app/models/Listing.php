<?php

namespace app\models;

class Listing extends \app\core\Model{
    public $listing_id;
    public $shoe_id;
    public $seller_username;
    public $size;
    public $stock;
    public $price;
    public $filename;

    public function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $SQL = 'SELECT * FROM listing';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute([]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Message');
		return $STMT->fetchAll();//returns an array of all the records
    }

    public function get($listing_id){
        $SQL = 'SELECT * FROM listing WHERE lising_id = :listing_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['listing_id'=>$listing_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orders');
		return $STMT->fetch();//return the record
    }

    public function getBySeller(){
        $SQL = 'SELECT * FROM listing WHERE seller_username = :seller_username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['seller_username'=>$this->seller_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orders');
		return $STMT->fetch();//return the record
    }

    public function insert(){
		//here we will have to add `` around field names
		$SQL = 'INSERT INTO orders(seller_username, buyer_username, listing_id, quantity, timestamp) 
        VALUES (:seller_username, :buyer_username, :listing_id, :quantity, UTC_TIMESTAMP())';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['seller_username'=>$this->seller_username, 'buyer_username'=>$this->buyer_username,'listing_id'=>$this->listing_id,'quantity'=>$this->quantity]);
	}

	public function delete(){//delete a message record
		$SQL = 'DELETE FROM `orders` WHERE order_id = :order_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['order_id'=>$this->order_id]);//associative array with key => value pairs
	}
}