<?php
session_start();
include_once'dbconfig.php';
include_once'sessioncontrol.php';


$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$errorMessage = login($email, $password);
echo $errorMessage;
	if($errorMessage == null){
		header('location: ../homepage.php');
	}else if ($errorMessage == 1){
		header('location: ../admin.php');
	}else{
		header('location: ../index.php?errorMessage=' . $errorMessage );
	}


function login($email, $password){
	if($email == "admin@admin.com" && $password == "admin") {
			$_SESSION['nome'] = "Admin";
			$_SESSION['cognome'] = "Admin";
			$_SESSION['immagine'] = "placeholder.png";
			$_SESSION['id'] = "Admin";
			$_SESSION['client'] = "Admin";
			return true;
		};
	
	if ($email != null && $password != null){
			$userId = authenticate($email, $password);
    		if ($userId > 0){
    			setSession($email, $userId);
    			return null;
    		}

    }else{
        return 'Devi riempire i campi';
    }
    	
    	return 'Username o password non validi';
	
}


function authenticate ($email, $password){
        global $conn;
		$query = "SELECT * FROM utente WHERE BINARY email = '".$email."' AND password = '".$password."' ;";
        $ris = mysqli_query($conn, $query);
		$numrighe= mysqli_num_rows($ris);
		if ($numrighe>0){
            $userRow = mysqli_fetch_row($ris);
            $_SESSION['nome']=$userRow[1];
            $_SESSION['cognome']=$userRow[2];
			$_SESSION['immagine']=$userRow[6];
			$_SESSION['client'] = "user";
            return $userRow[0];
        }
	}
