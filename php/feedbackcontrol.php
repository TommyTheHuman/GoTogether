<?php
session_start();
include_once'dbconfig.php';
include_once'sessioncontrol.php';

$idrecensito = $_GET['idprop'];
$idrecensore = $_GET['idutente'];
$voto = $_POST['Voto_Generale'];
$commento = mysqli_real_escape_string($conn,$_POST['commento']);
echo $voto;
echo $commento;
echo $idrecensito;
$controllo = "select idproponente, idrichiedente
from propostedaaccettare
where visualizzato = 1
and accettato = 1
and (idproponente = '$idrecensito' AND idrichiedente = '$idrecensore') OR (idrichiedente = '$idrecensito' AND idproponente = '$idrecensore')
order by idproposta";
$control = mysqli_query($conn, $controllo);
if(mysqli_num_rows($control) > 0){
    $sql="insert into feedback (IdRecensore, IdRecensito, Voto, Commento)values('$idrecensore','$idrecensito','$voto','$commento');";
	mysqli_query($conn,$sql);
	header("Location: ../userprofile.php?id=$idrecensito");
}else{
    echo '<script>alert("Non puoi lasciare una recensione se non hai interagito con la persona");
    window.location.replace("../userprofile.php?id='.$idrecensito.'");</script>';
    //header("Location: ../userprofile.php?id=$idrecensito");
}

?>
