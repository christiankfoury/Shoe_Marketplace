<?php

namespace app\models;

class Review extends \app\core\Model
{
    public $review_id;
    public $username;
    public $shoe_id;
    public $message;

    public function __construct()
    {
        parent::__construct();
    }

    public function getByShoeId($shoe_id) {
        $SQL = 'SELECT * FROM review WHERE shoe_id = :shoe_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['shoe_id'=>$shoe_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Review');
        return $STMT->fetchAll(); //returns an array of all the records
    }

    public function insert() {
        $SQL = 'INSERT INTO review (username, shoe_id, message) VALUES (:username, :shoe_id, :message)';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['username'=>$this->username, 'shoe_id'=>$this->shoe_id, 'message'=>$this->message]);
    }

    public function deleteReview($review_id) {
        $SQL = 'DELETE FROM review WHERE review_id = :review_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['review_id'=>$review_id]);
    }

    public function get($review_id)
    {
        $SQL = 'SELECT * FROM review WHERE review_id = :review_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['review_id'=>$review_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Review');
        return $STMT->fetch(); //returns an array of all the records
    }

    public function update() {
        $SQL = 'UPDATE review SET message = :message WHERE review_id = :review_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['message'=>$this->message, 'review_id'=>$this->review_id]);
    }
}
