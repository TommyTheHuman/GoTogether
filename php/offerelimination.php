<?php
    session_start();
    include "./sessioncontrol.php";
     include_once'./dbconfig.php';
    if (!isLogged()){
		    header('Location: ./index.php');
		    exit;
    }
    
	$idproposta = mysqli_real_escape_string($conn,$_GET['proposta']);
	$query = "SELECT p.image
				FROM proposte p
				WHERE Idproposta = '$idproposta';";
	$ris = mysqli_query($conn, $query);
	while($riga = mysqli_fetch_row($ris)) {
		$imm = $riga[0];
	}
	$ok = str_replace("php","",getcwd());
	$posizione = $ok . "immagini/background_proposte/" . $imm;
	unlink($posizione);
    $sql="DELETE
          FROM proposte
          WHERE Idproposta= '$idproposta';";
	$risultato = mysqli_query($conn, $sql);
	if(isset($_SESSION['client'])){
		header('Location: ../admin.php');
	}else{
		header('Location: ../profilo.php');
	}
?>