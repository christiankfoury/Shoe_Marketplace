<?php

namespace app\models;

class Wishlist extends \app\core\Model{
    public $wishlist_id;
    public $shoe_id;
	public $color;
    public $username;

    public function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $SQL = 'SELECT * FROM wishlist';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute([]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Wishlist');
		return $STMT->fetchAll();//returns an array of all the records
    }

    public function getByUsername(){
        $SQL = 'SELECT * FROM wishlist WHERE username = :username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$this->username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Wishlist');
		return $STMT->fetchAll();//return the record
    }

	public function getByShoeAndColor(){
		$SQL = 'SELECT * FROM wishlist WHERE shoe_id = :shoe_id AND color = :color AND username = :username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['shoe_id'=>$this->shoe_id,'color'=>$this->color, 'username'=>$this->username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Wishlist');
		return $STMT->fetch();//return the record
	}

    public function insert(){
		//here we will have to add `` around field names
		$SQL = 'INSERT INTO Wishlist(shoe_id, color, username) 
        VALUES (:shoe_id,:color,:username)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['shoe_id'=>$this->shoe_id, 'color'=>$this->color, 'username'=>$this->username]);
	}

	public function delete(){//delete a message record
		$SQL = 'DELETE FROM `wishlist` WHERE wishlist_id = :wishlist_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['wishlist_id'=>$this->wishlist_id]);//associative array with key => value pairs
	}
}