<?php
namespace app\controllers;

class Orders extends \app\core\Controller{

    public function addToCart($listing_id){
        $listing = new \app\models\Listing();
        $listing = $listing->get($listing_id);
        $order = new \app\models\Orders();
        $order->listing_id = $listing->listing_id;
        $order->buyer_username = $_SESSION['username'];
        $checkOrder = $order->getByListingAndBuyer();
        if($checkOrder != false){
            header("Location:/Listing/viewListing/$listing_id");
        }
        else{
            $order->seller_username = $listing->seller_username;
            $order->quantity = 1;
            $order->insert();
            header("Location:/Listing/viewListing/$listing_id");
        }
    }

    public function viewCart(){
        $orders = new \app\models\Orders();
        $orders->buyer_username = $_SESSION['username'];
        $orders = $orders->getCart();
        $this->view('/Orders/viewCart',$orders);
    }

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
        $orders->buyer_username = $_SESSION['username'];
        $orders = $orders->getBySeller();

        $this->view("\Orders\soldOrders",["user"=>$user,"orders"=>$orders]);
    }

    public function removeFromCart($order_id,$listing_id){
        $order = new \app\models\Orders();
        $order = $order->get($order_id);
        $order->delete();
        header("Location:/Listing/viewListing/$listing_id");
    }

    public function removeItemFromCart($order_id,$listing_id){
        $order = new \app\models\Orders();
        $order = $order->get($order_id);
        $order->delete();
        header("Location:/Orders/viewCart");
    }

    public function checkout($order_id){
        $order = new \app\models\Orders();
        $order = $order->get($order_id);
    }

    public function viewOrder(){
        
    }
}