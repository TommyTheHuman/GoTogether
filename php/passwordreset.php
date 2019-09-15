<?php
    session_start();
    include_once 'dbconfig.php';
    $id = $_SESSION['id'];
	$vecchiaPass = mysqli_real_escape_string($conn,$_POST['vecchiapass']);
	$NuovaPass = mysqli_real_escape_string($conn,$_POST['nuovapass']);
	$query = "SELECT * FROM utente WHERE BINARY id = '".$id."' AND password = '".$vecchiaPass."' ;";
        $ris = mysqli_query($conn, $query);
		$numrighe= mysqli_num_rows($ris);
		echo $query;
		if ($numrighe>0){
			$sql = "update utente set password= '".$NuovaPass."' where id='".$id."';";
			mysqli_query($conn, $sql);
			header("Location: ../profilo.php?msg=Password cambiata con successo");
        }else {
			header("Location: ../profilo.php?errore=La vecchia password è sbagliata");
		}
?>