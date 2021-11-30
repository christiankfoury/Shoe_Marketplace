<?php

namespace app\controllers;

class Wishlist extends \app\core\Controller
{
    public function index()
    {
        $wishlist = new \app\models\Wishlist();
        $wishlist->username = $_SESSION['username'];
        $wishlists = $wishlist->getByUsername();

        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);

        $listing = new \app\models\Listing();

        $wishlistListings = [];
        echo "heloo";
        foreach($wishlists as $wishlist){
            $listing->shoe_id = $wishlist->shoe_id;
            $listing->color = $wishlist->color;
            $listing->size = $user->size;
            $listing->seller_username = $user->username;
            $wishlistListings = $listing->getByWishlist();
        }
        // 2 listings: same color, same size, same shoe_id

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
