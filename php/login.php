<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8">
	<title>Form Di LogIn</title>
	<link rel="icon" href="./immagini/faveicon.ico" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="../css/formreset.css" type="text/css" media="screen">
	<link rel="stylesheet" href="../css/form.css" type="text/css" media="screen">
</head>

<body>
	<div class="form_login">
		<form action="./logincontrol.php" name="mio_form" method="post">
			<div>
				<label>
					E-mail: *<br></label>
				<input name="email" size="30" type="email" placeholder="Es: mario.rossi@gmail.com"
					value="tommyc98@yahoo.it"><br>

				<label>
					Password: *<br></label>
				<input name="password" size="30" type="password" value="111"><br>
			</div>
			<br>
			<div id="form_right">
				<div id="buttons">
					<input name="bottone_sottometti" value="INVIA" type="submit">
				</div>
			</div>
		</form>
	</div>
</body>

</html>