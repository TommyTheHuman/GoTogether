<?php
    session_start();
    include "./sessioncontrol.php";
     include_once'./dbconfig.php';
    if (!isLogged()){
		    header('Location: ./index.php');
		    exit;
    }
    
    $idproposta = mysqli_real_escape_string($conn,$_GET['proposta']);
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