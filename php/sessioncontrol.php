<?php
	
	function setSession($email, $userId){
		$_SESSION['id'] = $userId;
		$_SESSION['email'] = $email;
	}
	function isLogged(){		
		if(isset($_SESSION['id']))
			return $_SESSION['id'];
		else
			return false;
	}
?>