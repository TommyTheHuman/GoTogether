<?php
      session_start();
    include "./sessioncontrol.php";
    include_once'./dbconfig.php';

    if (!isLogged()){
		    header('Location: ../index.php');
		    exit;
    }	 
    $idproposta = mysqli_real_escape_string($conn,$_GET['proposta']);
    $idproponente = mysqli_real_escape_string($conn,$_GET['prop']);
    $idrichiedente = mysqli_real_escape_string($conn,$_SESSION['id']);
    $sql="insert into propostedaaccettare (IdProposta, IdRichiedente, IdProponente)values('$idproposta','$idrichiedente','$idproponente');";
    mysqli_query($conn,$sql);
    header(("location: ../homepage.php?Richiesta_Di_Partecipazione_Avvenuta_Con_Successo"));

?>
