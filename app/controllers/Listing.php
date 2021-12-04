<?php

namespace app\controllers;

class Listing extends \app\core\Controller
{
    private $folder = 'uploads/';

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
        } else {
            $user = new \app\models\User();
            $user = $user->get($_SESSION['username']);

            $listing = new \app\models\Listing();
            $listing->seller_username = $user->username;
            $listing = $listing->getBySeller($user->username);
            $this->view("Listing/index", ["user" => $user, "listings" => $listing]);
        }
    }

    // public function getListingsByUsername()
    // {
    //     $user = new \app\models\User();
    //     $user = $user->get($_SESSION['username']);

    //     $listing = new \app\models\Listing();
    //     $listing = $listing->getBySeller($user->username);

    //     header("Location:/Listing/index/$listing");
    // }

    #[\app\filters\Login]
    public function createListing()
    {
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else if (isset($_POST['action'])) {
            //get the form data and process it
            if (isset($_FILES['newPicture']) && $_FILES['newPicture']['size'] != 0 && trim($_POST['size']) != "" && trim($_POST['stock']) != "" && trim($_POST['price']) != "" 
                 && trim($_POST['price']) >= 0 && trim($_POST['description']) != "" && trim($_POST['color']) != "") {
                $check = getimagesize($_FILES['newPicture']['tmp_name']);

                $mime_type_to_extension = [
                    'image/jpeg' => '.jpg',
                    'image/gif' => '.gif',
                    'image/bmp' => '.bmp',
                    'image/png' => '.png'
                ];

                if ($check !== false && isset($mime_type_to_extension[$check['mime']])) {
                    $extension = $mime_type_to_extension[$check['mime']];
                } else {
                    $this->view('Picture/newPost', ['error' => "Bad file type", 'pictures' => []]);
                    return;
                }

                $filename = uniqid() . $extension;
                $filepath = $this->folder . $filename;

                if ($_FILES['newPicture']['size'] > 4000000) {
                    $this->view('Picture/newPost', ['error' => "File too large", 'pictures' => []]);
                    return;
                }
                if (move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)) {
                    $shoe = new \app\models\Shoe();
                    $shoe_id = $shoe->getShoeByBrandModel($_POST['brand'], $_POST['model'])->shoe_id;
                    $listing = new  \app\models\Listing();
                    $listing->shoe_id = $shoe_id;
                    $listing->seller_username = $_SESSION['username'];
                    $listing->size = $_POST['size'];
                    $listing->stock = $_POST['stock'];
                    $listing->price = $_POST['price'];
                    $listing->description = $_POST['description'];
                    $listing->color = $_POST['color'];
                    $listing->filename = $filename;
                    $listing->insert();
                    header("location:/Listing/index");
                } else
                    echo "There was an error";
            }
            else{
                $user = new \app\models\User();
            $user = $user->get($_SESSION['username']);
            $this->view('Listing/createListing', ['user'=>$user,'error'=>'Make sure that everything is filled out!']);
            }
        } else {
            $user = new \app\models\User();
            $user = $user->get($_SESSION['username']);
            $this->view('Listing/createListing', ['user'=>$user]);
        }
    }

    #[\app\filters\Login]
    public function viewListing($listing_id)
    {
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else {
            $listing = new \app\models\Listing();
            $listing = $listing->get($listing_id);

            $review = new \app\models\Review();
            $reviews = $review->getByShoeId($listing->shoe_id);
            if (isset($_POST['actionReview'])) {
                $review = new \app\models\Review();
                $review->username = $_SESSION['username'];
                $review->shoe_id = $listing->shoe_id;
                $review->message = $_POST['message'];
                $review->insert();
                header("location:/Listing/viewListing/$listing_id");
            } else {
                $this->view('Listing/viewListing', ['listing' => $listing, 'reviews' => $reviews]);
            }
        }
    }

    #[\app\filters\Login]
    public function allListings()
    {
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else {
            $listing = new \app\models\Listing();
            $listing->seller_username = $_SESSION['username'];
            $listings = $listing->getAllExceptUser();
            $this->view('Listing/allListings', ['listings' => $listings]);
        }
    }

    #[\app\filters\Login]
    public function editListing($listing_id){

        $listing = new \app\models\Listing();
        $listing = $listing->get($listing_id);
        $shoe = new \app\models\Shoe();
        $shoe = $shoe->getShoeByShoeId($listing->shoe_id);

        if(isset($_POST['edit'])){
            if(trim($_POST['price']) <= 0 || trim($_POST['description']) == ""){
                 $this->view('Listing/editListing', ['listing'=>$listing,'shoe'=>$shoe,'error'=>'Make sure that everything is filled out!']);
                 return;
            }
            if (isset($_FILES['newPicture']) && $_FILES['newPicture']['size'] != 0) {

                $check = getimagesize($_FILES['newPicture']['tmp_name']);

                $mime_type_to_extension = [
                    'image/jpeg' => '.jpg',
                    'image/gif' => '.gif',
                    'image/bmp' => '.bmp',
                    'image/png' => '.png'
                ];

                if ($check !== false && isset($mime_type_to_extension[$check['mime']])) {
                    $extension = $mime_type_to_extension[$check['mime']];
                } else {
                    $this->view('Picture/newPost', ['error' => "Bad file type", 'pictures' => []]);
                    return;
                }

                $filename = uniqid() . $extension;
                $filepath = $this->folder . $filename;

                if ($_FILES['newPicture']['size'] > 4000000) {
                    $this->view('Picture/newPost', ['error' => "File too large", 'pictures' => []]);
                    return;
                }
                if (move_uploaded_file($_FILES['newPicture']['tmp_name'], $filepath)) {
                    $listing = new \app\models\Listing();
                    $listing = $listing->get($listing_id);
                    $listing->size = $_POST['size'];
                    $listing->stock = $_POST['stock'];
                    $listing->price = $_POST['price'];
                    $listing->description = $_POST['description'];;
                    $listing->filename = $filename;
                    $listing->updateListing();
                    header("Location:/Listing/index");

                } else
                    echo "There was an error";
            }
            else{
                if(trim($_POST['price']) <= 0 || trim($_POST['description']) == ""){
                    $this->view('Listing/editListing', ['listing'=>$listing,'shoe'=>$shoe,'error'=>'Make sure that everything is filled out!']);
                }
                else{
                    $listing = new \app\models\Listing();
                    $listing = $listing->get($listing_id);
                    $listing->size = $_POST['size'];
                    $listing->stock = $_POST['stock'];
                    $listing->price = $_POST['price'];
                    $listing->description = $_POST['description'];;
                    $listing->updateListing();
                    header("Location:/Listing/index");
                }
            }
        }
        else{
            $this->view('Listing/editListing', ['listing'=>$listing,'shoe'=>$shoe]);
        }
    }

    #[\app\filters\Login]
    public function deleteListing($listing_id){
        $listing = new \app\models\Listing();
        $listing = $listing->get($listing_id);
        $listing->delete();
        header("Location:/Listing/index");
    }
}
