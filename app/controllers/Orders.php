<?php
namespace app\controllers;

class Orders extends \app\core\Controller{

    public function boughtOrders(){
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);

        $orders = new \app\models\Orders();
        $orders->buyer_username = $user->username;
        $orders = $orders->getByBuyer();

        $this->view("\Orders\boughtOrders",["user"=>$user,"orders"=>$orders]);
    }

    public function soldOrders(){
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);

        $orders = new \app\models\Orders();
        $orders->buyer_username = $user->username;
        $orders = $orders->getBySeller();

        $this->view("\Orders\soldOrders",["user"=>$user,"orders"=>$orders]);
    }

    public function viewOrder(){
        
    }
}