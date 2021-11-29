<?php
namespace app\models;

class User extends \app\core\Model{
	public $username;
	public $first_name;
	public $last_name;
	public $password_hash;
	public $password;
	public $favorite_color;
	public $size;

	public function __construct(){
		parent::__construct();
	}

/*
1. list primary keys, along witht he relationships of foreign keys
2. talk about normalization, how made the datbase with the least amount of table possible, with least amount of crazy curries possiuble
3. the server is alwasy on, so database on, should be fast cause its local, mention its going to be faster cause only the client is using it
	also mention that the server will be turned off most of the time, cause the client will use the application when needed
*/

	public function get($username){
		$SQL = 'SELECT * FROM user WHERE username LIKE :username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\User');
		return $STMT->fetch();//return the record
	}

	public function insert(){
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = 'INSERT INTO user(username, first_name, last_name, password_hash, favorite_color, size) VALUES (:username, :first_name, :last_name, 
			:password_hash, :favorite_color, :size)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$this->username, 'first_name'=>$this->first_name, 'last_name'=>$this->last_name, 'password_hash'=>$this->password_hash,
			'favorite_color'=>$this->favorite_color, 'size'=>$this->size]);//associative array with key => value pairs
	}

	public function update() {
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = 'UPDATE `user` SET password_hash=:password_hash WHERE username = :username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['password_hash' => $this->password_hash, 'username' => $this->username]);//associative array with key => value pairs
	}
}