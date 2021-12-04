<?php

namespace app\filters;
//definition of an attribute
//it needs to be applied to be functional
#[\Attribute]
class Login	{
	function execute(){
		if (!isset($_SESSION['username'])) {
			header('location:/User/login');
			return true;
		}
		return false;
	}
}
