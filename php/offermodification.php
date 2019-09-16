<?php
    session_start();
    include "./sessioncontrol.php";
     include_once'./dbconfig.php';
    if (!isLogged()){
		    header('Location: ./index.php');
		    exit;
    }
    
    $idproposta = mysqli_real_escape_string($conn,$_GET['proposta']);
    $Idrichiedente = mysqli_real_escape_string($conn,$_GET['richiedente']);
    $esito = mysqli_real_escape_string($conn,$_GET['accet']);
    if($esito == 'si'){
        $sql="UPDATE propostedaaccettare
            SET visualizzato = '1' , accettato = '1'
            WHERE Idproposta= '$idproposta'
            and IdRichiedente = '$Idrichiedente';";
    }
    else{
        $sql="UPDATE propostedaaccettare
            SET visualizzato = '1'
            WHERE Idproposta= '$idproposta'
            and IdRichiedente = '$Idrichiedente';";
    }
    $risultato = mysqli_query($conn, $sql);
    header('Location: ../profilo.php?mag=Hai accettato-rifiutato la proposta');
?>