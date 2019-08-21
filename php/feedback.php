<?php
	session_start();
    include "./sessioncontrol.php";
    include_once'./dbconfig.php';
    include_once './dbmanager.php';

    if (!isLogged()){
		    header('Location: ./index.php');
		    exit;
    }
?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>NOME DEL SITO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="stile.css" type="text/css" media="screen"> <!-- css -->
</head>

<body>
    <form <?php $idprop =$_GET['idprop']; $idutente = $_GET['idutente'];echo 'action="./feedbackcontrol.php?idprop='.$idprop.'&idutente='.$idutente.'"'; ?>  name="feedback" method="post">
        <fieldset name="feedback">
            <legend>Feedback:</legend>
            <div>
                <label>
                    Guidizio (da 1 a 5):<br>
                    Organizzazione <br>
                    <input type="radio" name="Voto_Generale" id="Voto_Generale" value="1">
                    <input type="radio" name="Voto_Generale" id="Voto_Generale" value="2">
                    <input type="radio" name="Voto_Generale" id="Voto_Generale" value="3">
                    <input type="radio" name="Voto_Generale" id="Voto_Generale" value="4">
                    <input type="radio" name="Voto_Generale" id="Voto_Generale" value="5">
                </label>
            </div>
            <div>
                <label>
                    Cosa ne pensi del questionario?<br>
                    <textarea name="commento" rows="7" cols="30" onKeyUp="update(document.mio_form)" id="feedback"></textarea><br>
                </label><br>
                <label> Contatore:
                    <input name="contatore" type="text" value="64" size="2" readonly="readonly" style="border-style: none; font-size: 10pt"><br>
                </label><br>
                <input name="bottone_sottometti" value="INVIA" type="submit">&nbsp;
            </div>
        </fieldset>
    </form>
</body>

</html>
