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
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetchAll();//returns an array of all the records
    }

    public function get($listing_id){
        $SQL = 'SELECT * FROM listing WHERE lising_id = :listing_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['listing_id'=>$listing_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetch();//return the record
    }

    public function getBySeller(){
        $SQL = 'SELECT * FROM listing WHERE seller_username = :seller_username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['seller_username'=>$this->seller_username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetchAll();//return the record
    }

    public function insert(){
		//here we will have to add `` around field names
		$SQL = 'INSERT INTO listing(shoe_id, seller_username, size, stock, price, filename) 
        VALUES (:shoe_id, :seller_username, :size, :stock, :price, :filename)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['shoe_id'=>$this->shoe_id, 'seller_username'=>$this->seller_username, 'size'=>$this->size, 'stock'=>$this->stock, 'price'=>$this->price, 'filename'=>$this->filename]);
	}

	public function delete(){//delete a message record
		$SQL = 'DELETE FROM `listing` WHERE listing_id = :listing_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['listing_id'=>$this->listing_id]);//associative array with key => value pairs
	}
}