<?php
namespace app\controllers;

class User extends \app\core\Controller{

	public function index(){
		$user = new \app\models\User();
		$user = $user->get($_SESSION['username']);
		$this->view('User/index',$user);
	}

	public function login(){
		//TODO: register session variables to stay logged in
		if(isset($_POST['action'])){//verify that the user clicked the submit button
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);

			if($user!=false && password_verify($_POST['password'], $user->password_hash)){
				$_SESSION['username'] = $user->username;

				$username = new \app\models\User();
				$username = $username->get($_SESSION['username']);
				header("Location:/User/index");
				
			}else{
				$this->view('User/login','Wrong username and password combination!');
			}

		}else //1 present a form to the user
			$this->view('User/login');
	}
	
	public function register(){
		if(isset($_POST['action'])){//verify that the user clicked the submit button
			if (trim($_POST['username']) == '' || trim($_POST['password']) == '' || trim($_POST['first_name']) == ''
					|| trim($_POST['last_name']) == '') {
				$this->view('User/register', "Make sure that all fields are filled up!");
				return;
			}
			$user = new \app\models\User();
			if ($user->get($_POST['username'])) {
				$this->view('User/register', "This username already exists");
				return;
			}
			if ($_POST['password'] != $_POST['password_confirm']) {
				$this->view('User/register', "The passwords do not match");
				return;
			}

			$user->username = $_POST['username'];
			$user->first_name = $_POST['first_name'];
			$user->last_name = $_POST['last_name'];
			$user->favorite_color = $_POST['favorite_color'];
			$user->size = $_POST['size'];
			$user->password = $_POST['password'];
			$user->insert(); 
			header("location:/User/login");

		}else //1 present a form to the user
			$this->view('User/register');
	}

	// #[\app\filters\Login]
	// public function changePassword() {
	// 	$profile = new \app\models\Profile();
	// 	$profile = $profile->get($_SESSION['user_id']);
	// 	$user = new \app\models\User();
	// 	$user = $user->get($_SESSION['username']);


	// 	if (isset($_POST['action'])) {
	// 		if ($_POST['new_password'] == '' || $_POST['password_confirm'] == '') {
	// 			$this->view('User/changePassword', ['profile' => $profile, 'error' => 'The new password must not be empty']);
	// 			return;
	// 		}
	// 		if (password_verify($_POST['current_password'], $user->password_hash) && $_POST['new_password'] == $_POST['password_confirm']) { 
	// 			$user->password = $_POST['new_password'];
	// 			// echo $user->password_hash;
	// 			$user->update();
	// 			header("Location:/Profile/index");
	// 		}
	// 		else {
	// 			$this->view('User/changePassword', ['profile' => $profile, 'error' => 'The password(s) do not correspond']);
	// 		}
	// 	}
	// 	else {
	// 		$this->view('User/changePassword', ['profile' => $profile]);
	// 	}
	// }
}