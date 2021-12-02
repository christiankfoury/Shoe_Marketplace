<?php

namespace app\controllers;

class User extends \app\core\Controller
{

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
			$user = new \app\models\User();
			$user = $user->get($_SESSION['username']);

			$listing = new \app\models\Listing();
			$listing->color = $user->favorite_color;
			$listing->size = $user->size;
			$listing->seller_username = $_SESSION['username'];

			$listingsColor = $listing->getListingsByColor();
			$listingsColorSize = $listing->getListingsByColorSize();

			$this->view('User/index', ['user' => $user, 'listingsColor' => $listingsColor, 'listingsColorSize' => $listingsColorSize]);
		}
	}

	public function login()
	{
		//TODO: register session variables to stay logged in
		if (isset($_POST['action'])) { //verify that the user clicked the submit button
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);

			if ($user != false && password_verify($_POST['password'], $user->password_hash)) {
				$_SESSION['username'] = $user->username;

				$username = new \app\models\User();
				$username = $username->get($_SESSION['username']);
				header("Location:/User/index");
			} else {
				$this->view('User/login', 'Wrong username and password combination!');
			}
		} else //1 present a form to the user
			$this->view('User/login');
	}

	public function register()
	{
		if (isset($_POST['action'])) { //verify that the user clicked the submit button
			if (
				trim($_POST['username']) == '' || trim($_POST['password']) == '' || trim($_POST['first_name']) == ''
				|| trim($_POST['last_name']) == ''
			) {
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
		} else //1 present a form to the user
			$this->view('User/register');
	}

	public function settings()
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
			$this->view('User/settings', $user);
		}
	}

	#[\app\filters\Login]
	public function changePassword()
	{
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
			if ($_POST['new_password'] == '' || $_POST['password_confirm'] == '') {
				$this->view('User/changePassword', ['user' => $user, 'error' => 'The new password must not be empty']);
				return;
			}
			if (password_verify($_POST['current_password'], $user->password_hash) && $_POST['new_password'] == $_POST['password_confirm']) {
				$user->password = $_POST['new_password'];
				// echo $user->password_hash;
				$user->update();
				header("Location:/Profile/index");
			} else {
				$this->view('User/changePassword', ['user' => $user, 'error' => 'The password(s) do not correspond']);
			}
		} else {
			$this->view('User/changePassword', ['user' => $user]);
		}
	}

	public function search($search)
	{
		$listing = new \app\models\Listing();
		$listing = $listing->getBySearch($search);
		$this->view('Listing/searchResults', $listing);
	}

	public function searchBrand($brand)
	{
		$shoe = new \app\models\Shoe();
		$shoes = $shoe->getByBrand($brand);
		$listing = new \app\models\Listing();		
		$listings = [];

		foreach ($shoes as $shoe) {
			$listingsToAdd = $listing->getByShoeId($shoe->shoe_id);
			if ($listingsToAdd != false && count($listingsToAdd) > 0) {
				foreach ($listingsToAdd as $listingToAdd) {
					array_push($listings, $listingToAdd);
				}
			}
		}
		print_r($listings);

		// $listing = $listing->getByBrand($brand);
		$this->view('Listing/searchResults', $listings);
	}

	public function logout()
	{
		session_destroy();
		header("Location:/User/login");
	}
}
