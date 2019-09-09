<?php
    include_once'dbconfig.php';
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn,$_POST['surname']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $birthDate = mysqli_real_escape_string($conn,$_POST['birthDate']);
    $gender = mysqli_real_escape_string($conn,$_POST['Sesso']);
	$query = "select count(*)
				from utente 
				where email = '$email';";
	echo $query;
	$ris = mysqli_query($conn,$query);
	$numrighe= mysqli_num_rows($ris);
	if($email == "admin@admin.com"){
		header("location: ../index.php?Non puoi registrare quasta email");
	}else if ($numrighe > 0){
		header("location: ../index.php?Email già registrata");
	} else {
		$sql="insert into utente (nome, cognome, email, password, datanascita, gender)values('$name','$surname','$email','$password','$birthDate','$gender');";
		mysqli_query($conn,$sql);

		header("location: ../index.php?Registrazione Avvenuta Con Successo");
	}
?>