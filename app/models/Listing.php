<?php

namespace app\models;

class Listing extends \app\core\Model{
    public $listing_id;
    public $shoe_id;
    public $seller_username;
    public $size;
    public $stock;
    public $price;
	public $description;
	public $color;
	public $available;
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
        $SQL = 'SELECT * FROM listing WHERE listing_id = :listing_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['listing_id'=>$listing_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetch();//return the record
    }

    public function getBySeller(){
        $SQL = 'SELECT * FROM listing WHERE seller_username = :seller_username AND available = :available';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['seller_username'=>$this->seller_username, 'available'=>'yes']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetchAll();//return the record
    }

    public function insert(){
		//here we will have to add `` around field names
		$SQL = 'INSERT INTO listing(shoe_id, seller_username, size, stock, price, description, color, filename) 
        VALUES (:shoe_id, :seller_username, :size, :stock, :price, :description, :color, :filename)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['shoe_id'=>$this->shoe_id, 'seller_username'=>$this->seller_username, 'size'=>$this->size, 
			'stock'=>$this->stock, 'price'=>$this->price, 'description'=>$this->description, 'color'=>$this->color, 'filename'=>$this->filename]);
	}

	public function deleteAvailable(){//delete a message record
		$SQL = 'UPDATE `listing` SET available = :available WHERE listing_id = :listing_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['available'=>'no', 'listing_id'=>$this->listing_id]); //associative array with key => value pairs

		$SQL = 'DELETE FROM `orders` WHERE listing_id = :listing_id AND timestamp is NULL';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['listing_id' => $this->listing_id]);//associative array with key => value pairs
	}

	public function getListingsByColor() {
		$SQL = 'SELECT * FROM listing WHERE color = :color AND size != :size AND seller_username != :seller_username AND available = :available';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['color'=>$this->color, 'size'=>$this->size, 'seller_username'=>$this->seller_username, 'available'=>'yes']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetchAll();//return the record
	}

	public function getListingsByColorSize() {
		$SQL = 'SELECT * FROM listing WHERE color = :color AND size = :size AND seller_username != :seller_username AND available = :available';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['color'=>$this->color, 'size'=>$this->size, 'seller_username'=>$this->seller_username, 'available'=>'yes']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetchAll();//return the record	
	}

	public function getAllExceptUser() {
		$SQL = 'SELECT * FROM listing WHERE seller_username != :seller_username AND available = :available';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['seller_username'=>$this->seller_username , 'available'=>'yes']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetchAll();//return the record
	}

	public function getBySearch($search){
		$SQL = 'SELECT * FROM listing WHERE (seller_username LIKE :seller_username OR size LIKE :size OR price LIKE :price OR description LIKE :description OR color LIKE :color) AND available = :available';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['seller_username' => "%$search%", 'size'=> "%$search%", 'price'=> "%$search%", 'description' => "%$search%", 'color' => "%$search%", 'available' => "yes"]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetchAll();//return the record	
	}

	public function getByWishlist(){
		$SQL = 'SELECT * FROM listing JOIN wishlist ON listing.shoe_id = wishlist.shoe_id WHERE wishlist.username = :username AND listing.size = :size AND listing.color = :color AND listing.available = :available AND listing.seller_username != :seller_username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['size' => $this->size, 'color' => $this->color, 'available' => 'yes', 'seller_username' => $this->seller_username, 'username' => $this->seller_username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetchAll();//return the record
	}

	public function update() {
		$SQL = 'UPDATE listing SET stock = :stock WHERE listing_id = :listing_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['stock'=>$this->stock, 'listing_id'=>$this->listing_id]);

		if ($this->stock == 0) {
			$SQL = 'UPDATE listing SET available = :available WHERE listing_id = :listing_id';
			$STMT = self::$_connection->prepare($SQL);
			$STMT->execute(['available'=>'no', 'listing_id'=>$this->listing_id]);
		}
	}

	public function updateListing(){
		$SQL = 'UPDATE listing SET size = :size, stock = :stock, price = :price, description = :description, filename = :filename WHERE listing_id = :listing_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['size'=>$this->size, 'stock'=>$this->stock, 'price'=>$this->price, 'description'=>$this->description, 'filename'=>$this->filename,'listing_id'=>$this->listing_id]);
	}

	public function getByShoeId($shoe_id) {
        $SQL = 'SELECT * FROM listing WHERE shoe_id = :shoe_id AND available = :available';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['shoe_id'=>$shoe_id, 'available'=>'yes']);
        $STMT->setFetchMode(\PDO::FETCH_CLASS,'app\models\Listing');
        return $STMT->fetchAll();//return the record
    }

	public function getByShoeBrand($brand) {
		$SQL = 'SELECT * FROM listing JOIN shoe ON listing.shoe_id = shoe.shoe_id WHERE shoe.brand = :brand AND listing.available = :available';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['brand'=>$brand, 'available'=>'yes']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Listing');
		return $STMT->fetchAll();//return the record
	}
}