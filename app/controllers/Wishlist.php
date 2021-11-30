<?php

namespace app\controllers;

class Wishlist extends \app\core\Controller
{
    public function index()
    {
        $wishlists = new \app\models\Wishlist();
        $wishlists = $wishlists->getByUsername($_SESSION['username']);

        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);

        $listing = new \app\models\Listing();

        $wishlistListings = [];

        foreach($wishlists as $wishlist){
            $listing->shoe_id = $wishlist->shoe_id;
            $listing->color = $wishlist->color;
            $listing->size = $user->size;
            $wishlistListings = $listing->getByWishlist();
        }

        $this->view('/Wishlist/index',$wishlistListings);
    }

    public function add($shoe_id,$color,$listing_id){
        $wishlist = new \app\models\Wishlist();
        $wishlist->shoe_id = $shoe_id;
        $wishlist->color = $color;
        $wishlist->username = $_SESSION['username'];
        $wishlist->insert();
        header("Location:/Listing/viewListing/$listing_id");
    }

    public function remove($shoe_id,$color,$listing_id){
        $wishlist = new \app\models\Wishlist();
        $wishlist->shoe_id = $shoe_id;
        $wishlist->color = $color;
        $wishlist->username = $_SESSION['username'];
        $wishlist = $wishlist->getByShoeAndColor();
        $wishlist->delete();
        header("Location:/Listing/viewListing/$listing_id");
    }
    
}
