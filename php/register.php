<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8">
	<title>Form Di Registrazione</title>
	<link rel="icon" href="../immagini/faveicon.ico" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="../css/form.css" type="text/css" media="screen">
	<link rel="stylesheet" href="../css/normalize/normalize.css" type="text/css" media="screen">
	<link rel="stylesheet" href="../css/formreset.css" type="text/css" media="screen">
</head>

<body>
	<div class="form_register">
		<form name="registrazione" method="post">
			<div>
				<label>
					Nome: *<br> </label>
				<input name="name" size="15" type="text" placeholder="Es: Mario" pattern="[a-zA-Z\s]+"><br>

				<label>
					Cognome: *<br> </label>
				<input name="surname" size="15" type="text" placeholder="Es: Rossi" pattern="[a-zA-Z\s]+"><br>

				<label>
					Password: *<br></label>
				<input name="password" size="30" type="password"><br>

				<label>
					Conferma Password: *<br></label>
				<input name="repassword" size="30" type="password"><br>

				<label>
					E-mail: *<br></label>
				<input name="email" size="30" type="email" placeholder="Es: mario.rossi@gmail.com"><br>

				<label>
					Data di Nascita: *<br></label>
				<input name="birthDate" type="date" max="" onkeydown="return false"><br>

				<div class="sesso">
					<div class="maschio">
						<p>Maschio *</p>
						<input type="radio" name="Sesso" id="Maschio" value="Maschio">
					</div>
					<div class="femmina">
						<p>Femmina *</p>
						<input type="radio" name="Sesso" id="Femmina" value="Femmina">
					</div>
				</div>
			</div>
			<div>
				<sup>*</sup> Campi obbligatori
			</div><br>
			<div id="form_right">
				<div id="buttons">
					<input name="bottone_sottometti" value="INVIA" type="button" onclick="controllo()">
				</div>
			</div>
		</form>
	</div>
	<script src="../js/controlloform.js"></script>
	<script src="../js/RegisterDateControl.js"></script>
</body>

</html>