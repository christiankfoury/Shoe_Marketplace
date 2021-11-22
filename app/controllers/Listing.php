<?php
namespace app\controllers;

class Listing extends \app\core\Controller{

   public function index(){
       $user = new \app\models\User();
       $user = $user->get($_SESSION['username']);
   }
}