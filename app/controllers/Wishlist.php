<?php

namespace app\controllers;

class Wishlist extends \app\core\Controller
{
    #[\app\filters\Login]
    public function index()
    {
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else if (isset($_POST['searchBrandButton'])) {
            header("Location:/User/searchBrand/{$_POST['searchBrand']}");
        } else {
            $wishlist = new \app\models\Wishlist();
            $wishlist->username = $_SESSION['username'];
            $wishlists = $wishlist->getByUsername();

            $user = new \app\models\User();
            $user = $user->get($_SESSION['username']);

            $listing = new \app\models\Listing();

                $listing->color = $user->favorite_color;
                $listing->size = $user->size;
                $listing->seller_username = $user->username;

            $wishlistListings = $listing->getByWishlist();
            // foreach ($wishlists as $wishlist) {
            //     $listing->shoe_id = $wishlist->shoe_id;
            //     $listing->color = $wishlist->color;
            //     $listing->size = $user->size;
            //     $listing->seller_username = $user->username;
            //     // $wishlistListings = $listing->getByWishlist();
            //     $listingsToAdd = $listing->getByWishlist();
            //     foreach ($listingsToAdd as $listingToAdd) {
            //         array_push($wishlistListings, $listingToAdd);
            //     }
            // }
            // 2 listings: same color, same size, same shoe_id

            $this->view('/Wishlist/index', $wishlistListings);
        }
    }

    #[\app\filters\Login]
    public function add($shoe_id, $color, $listing_id)
    {
        $wishlist = new \app\models\Wishlist();
        $wishlist->shoe_id = $shoe_id;
        $wishlist->color = $color;
        $wishlist->username = $_SESSION['username'];
        $wishlist->insert();
        header("Location:/Listing/viewListing/$listing_id");
    }

    #[\app\filters\Login]
    public function remove($shoe_id, $color, $listing_id)
    {
        $wishlist = new \app\models\Wishlist();
        $wishlist->shoe_id = $shoe_id;
        $wishlist->color = $color;
        $wishlist->username = $_SESSION['username'];
        $wishlist = $wishlist->getByShoeAndColor();
        $wishlist->delete();
        header("Location:/Listing/viewListing/$listing_id");
    }
}
