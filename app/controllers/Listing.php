<?php
namespace app\controllers;

class Listing extends \app\core\Controller{

   public function index(){
       $user = new \app\models\User();
       $user = $user->get($_SESSION['username']);
       
       $listing = new \app\models\Listing();
       $listing = $listing->getBySeller($user->username);
       $this->view("Listing\index",["user"=>$user,"listings"=>$listing]);
   }

   public function getListingsByUsername(){
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);

        $listing = new \app\model\Listing();
        $listing = $listing->getBySeller($user->username);

        header("Location:\Listing\index\$listing");
   }
}