<?php

namespace app\models;

class Orders extends \app\core\Model{
    public $order_id;
    public $seller_username;
    public $buyer_username;
    public $listing_id;
    public $quantity;
	public $email;
	public $address;
	public $address2;
	public $postal_code;
	public $city;
	public $province;
	public $country;
    public $timestamp;
	public $total_price;

    public function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $SQL = 'SELECT * FROM orders';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute([]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orders');
		return $STMT->fetchAll();//returns an array of all the records
    }

    public function get($order_id){
        $SQL = 'SELECT * FROM orders WHERE order_id = :order_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['order_id'=>$order_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orders');
		return $STMT->fetch();//return the record
    }

    public function getBySeller(){
        $SQL = 'SELECT * FROM orders WHERE seller_username = :seller_username AND timestamp IS NOT NULL';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['seller_username'=>$this->seller_username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orders');
		return $STMT->fetchAll();//return the record
    }

    public function getCart(){
        $SQL = 'SELECT * FROM orders WHERE buyer_username = :buyer_username AND timestamp IS NULL';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['buyer_username'=>$this->buyer_username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orders');
		return $STMT->fetchAll();//return the record
    }

	public function getByListingAndBuyer(){
		$SQL = 'SELECT * FROM orders WHERE listing_id = :listing_id AND buyer_username = :buyer_username AND timestamp IS NULL';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['listing_id'=>$this->listing_id,'buyer_username'=>$this->buyer_username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orders');
		return $STMT->fetch();//return the record
	}

	public function getBoughtOrders(){
		$SQL = 'SELECT * FROM orders WHERE buyer_username = :buyer_username AND timestamp IS NOT NULL';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['buyer_username'=>$this->buyer_username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orders');
		return $STMT->fetchAll();//return the record
	}

    public function insert(){
		//here we will have to add `` around field names
		$SQL = 'INSERT INTO orders(seller_username, buyer_username, listing_id, quantity)  
        VALUES (:seller_username, :buyer_username, :listing_id, :quantity)'; //TIMESTAMP IS NULL AS DEFAULT VALUE. AND TOTAL_PRICE IS NULL AS DEFAULT VALUE
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['seller_username' => $this->seller_username, 'buyer_username' => $this->buyer_username, 'listing_id' => $this->listing_id, 'quantity' => $this->quantity]);
	}

	public function delete(){//delete a message record
		$SQL = 'DELETE FROM `orders` WHERE order_id = :order_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['order_id'=>$this->order_id]);//associative array with key => value pairs
	}

	public function update(){//update an picture record but don't hange the FK value and don't change the picture filename either....
		$SQL = 'UPDATE `orders` SET `quantity`=:quantity, `email`=:email,`address`=:address,`address2`=:address2,`postal_code`=:postal_code,`city`=:city,province=:province,timestamp = UTC_TIMESTAMP(), total_price = :total_price WHERE order_id = :order_id';//always use the PK in the where clause
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['quantity'=>$this->quantity, 'email'=>$this->email,'address'=>$this->address,'address2'=>$this->address2,'postal_code'=>$this->postal_code,'city'=>$this->city,'province'=>$this->province, 'total_price'=>$this->total_price, 'order_id'=>$this->order_id]);//associative array with key => value pairs
	}
}