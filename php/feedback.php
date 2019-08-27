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
	<title>Form Di Feedback</title>
	<link rel="icon" href="./immagini/faveicon.ico" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="../css/form.css" type="text/css" media="screen">
	<link rel="stylesheet" href="../css/formReset.css" type="text/css" media="screen">
</head>

<body>
	<div class="form_feedback">
		<form
			<?php $idprop =$_GET['idprop']; $idutente = $_GET['idutente'];echo 'action="./feedbackcontrol.php?idprop='.$idprop.'&idutente='.$idutente.'"'; ?>
			name="feedback" method="post">
			<div>
				<p>Guidizio (da 1 a 5) sull' organizzazione:</p>
				<input type="radio" name="Voto_Generale" id="1" value="1">
				<input type="radio" name="Voto_Generale" id="2" value="2">
				<input type="radio" name="Voto_Generale" id="3" value="3">
				<input type="radio" name="Voto_Generale" id="4" value="4">
				<input type="radio" name="Voto_Generale" id="5" value="5">
			</div>
			<div>
				<label>
					Giudizio sull'esperienza<br /></label>
				<textarea name="commento" rows="7" cols="30" onKeyUp="update(document.mio_form)"
					id="feedback"></textarea><br>
				<br>
				<input name="bottone_sottometti" value="INVIA" type="submit">
			</div>
		</form>
	</div>
</body>

</html>