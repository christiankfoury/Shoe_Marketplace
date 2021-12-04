<?php

namespace app\controllers;

class Orders extends \app\core\Controller
{

    #[\app\filters\Login]
    public function addToCart($listing_id)
    {
        $listing = new \app\models\Listing();
        $listing = $listing->get($listing_id);
        $order = new \app\models\Orders();
        $order->listing_id = $listing->listing_id;
        $order->buyer_username = $_SESSION['username'];
        $checkOrder = $order->getByListingAndBuyer();
        if ($checkOrder != false) {
            header("Location:/Listing/viewListing/$listing_id");
        } else {
            $order->seller_username = $listing->seller_username;
            $order->quantity = 1;
            $order->insert();
            header("Location:/Listing/viewListing/$listing_id");
        }
    }

    #[\app\filters\Login]
    public function viewCart()
    {
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else {
            $orders = new \app\models\Orders();
            $orders->buyer_username = $_SESSION['username'];
            $orders = $orders->getCart();
            $this->view('/Orders/viewCart', $orders);
        }
    }

    #[\app\filters\Login]
    public function boughtOrders()
    {
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else {
            $user = new \app\models\User();
            $user = $user->get($_SESSION['username']);

            $orders = new \app\models\Orders();
            $orders->buyer_username = $user->username;
            $orders = $orders->getBoughtOrders();

            $this->view("\Orders\boughtOrders", ["user" => $user, "orders" => $orders]);
        }
    }

    #[\app\filters\Login]
    public function soldOrders()
    {
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else {
            $user = new \app\models\User();
            $user = $user->get($_SESSION['username']);

            $orders = new \app\models\Orders();
            $orders->seller_username = $_SESSION['username'];
            $orders = $orders->getBySeller();
            print_r($orders);

            $this->view("\Orders\soldOrders", ["user" => $user, "orders" => $orders]);
        }
    }

    #[\app\filters\Login]
    public function removeFromCart($order_id, $listing_id)
    {
        $order = new \app\models\Orders();
        $order = $order->get($order_id);
        $order->delete();
        header("Location:/Listing/viewListing/$listing_id");
    }

    #[\app\filters\Login]
    public function removeItemFromCart($order_id, $listing_id)
    {
        $order = new \app\models\Orders();
        $order = $order->get($order_id);
        $order->delete();
        header("Location:/Orders/viewCart");
    }

    #[\app\filters\Login]
    public function checkout($order_id)
    {
        $order = new \app\models\Orders();
        $order = $order->get($order_id);
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else if (isset($_POST['action'])) {

            
            $postal_code = preg_replace('/\s+/', '', $_POST['postal_code']);
            $card_number = preg_replace('/\s+/', '', $_POST['card_number']);
            $regexPostalCode = '/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/';
            $regexCardNumber = '/^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/';
            $validPostalCode = (bool) preg_match($regexPostalCode,$postal_code);
            $card_number = (bool) preg_match($regexCardNumber,$card_number);

            if (
                $_POST['email'] == "" || $_POST['address'] == "" || $_POST['postal_code'] == ""
                || $_POST['province'] == "" || $_POST['card_number'] == ""
                || $_POST['card_name'] == "" || $_POST['expiration'] == "" || $_POST['security_code'] == ""
            ) {
                $this->view("\Orders\checkout", ['order' => $order, 'user' => $user, "error" => "Please fill out all fields"]);
            }
            else if($validPostalCode == false){
                $this->view("\Orders\checkout", ['order' => $order, 'user' => $user, "error" => "Please make sure that the postal code is in the right format! (EX: A1A 1A1)"]);
                return;
            }
            else if($card_number == false){
                $this->view("\Orders\checkout", ['order' => $order, 'user' => $user, "error" => "Please make sure that the card number only contains digits and that it is the correct format! (EX: 1111 2222 3333 4444)"]);
                return;
            } else {
                $listing = new \app\models\Listing();
                $listing = $listing->get($order->listing_id);

                $order = new \app\models\Orders();
                $order = $order->get($order_id);
                $order->quantity = $_POST['quantity'];
                $order->email = $_POST['email'];
                $order->address = $_POST['address'];
                $order->address2 = $_POST['address2'];
                $order->postal_code = $_POST['postal_code'];
                $order->province = $_POST['province'];
                $order->city = $_POST['city'];
                $order->total_price = $listing->price * $order->quantity;
                $order->update();

                $listing = new \app\models\Listing();
                $listing = $listing->get($order->listing_id);
                $listing->stock = $listing->stock - $order->quantity;
                $listing->update();

                $shoe = new \app\models\Shoe();
                $shoe->shoe_id = $listing->shoe_id;
                $shoe->previously_sold_price = $listing->price;
                $shoe->updatePreviouslySoldPrice($listing->shoe_id, $listing->price);

                header("Location:/Orders/boughtOrders");
            }
        } else {
            $this->view('/Orders/checkout', ['order' => $order, 'user' => $user]);
        }
    }

    public function createOrder()
    {
    }

    public function viewOrder()
    {
    }
}
