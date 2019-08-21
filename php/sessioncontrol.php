<?php
	
	//setSession: set $_SESSION properly
	function setSession($email, $userId){
		$_SESSION['id'] = $userId;
		$_SESSION['email'] = $email;
	}

	//isLogged: check if user has logged in and, if it is the case, returns the username
	function isLogged(){		
		if(isset($_SESSION['id']))
			return $_SESSION['id'];
		else
			return false;
	}

?>