<?php
namespace app\controllers;

class Listing extends \app\core\Controller{

   public function index(){
       $user = new \app\models\User();
       $user = $user->get($_SESSION['username']);
       
       $listing = new \app\models\Listing();
       $listing->seller_username = $user->username;
       $listing = $listing->getBySeller($user->username);
       $this->view("Listing/index",["user"=>$user,"listings"=>$listing]);
   }

   public function getListingsByUsername(){
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);

        $listing = new \app\model\Listing();
        $listing = $listing->getBySeller($user->username);

        header("Location:/Listing/index/$listing");
   }

   public function createListing(){
       if(isset($_POST['action'])){

       }
       else{
           $user = new \app\models\User();
           $user = $user->get($_SESSION['username']);
           $this->view('Listing/createListing',$user);
       }
   }

   public function viewListing($listing_id){
        $listing = new \app\models\Listing();
        $listing = $listing->get($listing_id);
        $this->view('/Listing/viewListing',$listing);
   }
}