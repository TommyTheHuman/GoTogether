<?php
	session_start();
    include "./php/sessioncontrol.php";
    include_once'./php/dbconfig.php';
    include_once './php/dbmanager.php';
    if (!isLogged()){
		    header('Location: ./index.php');
		    exit;
    }	

    $user = new stdClass();
    $user->nome = $_SESSION["nome"];
    $user->cognome = $_SESSION["cognome"];
    $user->profileImage = './upload/'.$_SESSION['immagine'];
?>


<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8">
	<title>Profilo Personale</title>
	<link rel="icon" href="./immagini/faveicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="./css/profile.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/GeneralRules.css" type="text/css" media="screen"> <!-- css -->
	<?php include_once './include/head.html' ?>
</head>

<body>
	<header>
		<nav class="mainNav">
			<div class="logo">
				<a href="./homepage.php">
					<img alt="logo" src="./immagini/logoicon.png">
				</a>
			</div>
			<div class="voices">
				<ul>
					<li>
						<button class="openmodal" type="button">Impostazioni</button>
					</li>
					<li>
						<a href="./profilo.php">
							<?php echo $user->nome." ".$user->cognome ?>
							<img alt="immagine del profilo" class='RoundImage' <?php echo 'src='.$user->profileImage ?>>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<script src="./js/controlloform.js"></script>
	<?php
		Bandiere();
		ProposteDaAccettare();
	?>
	<div class="tab">
		<button class="tablinks active">
			Proposte
		</button>
		<button class="tablinks">
			Partecipazioni
		</button>
	</div>
	<div class="tabcontent visible">
		<?php ProposteProprie(); ?>
	</div>

	<div class="tabcontent">
		<?php PropostePartecipate(); ?>
	</div>

	<?php recensioniProprie() ?>

	<div class="modal" id="modal">
		<div class="modal__content">
			<button class="openmodal" type="button"><img alt="icona_chiusura" class="immagine_modal"
					src="./immagini/icone/x.png"></button>
			<div class="modal__innerContent">

			</div>
		</div>
	</div>

	<script src="./js/appear.js"></script>
	<script src="./js/tab.js"></script>
	<script src="./js/modal.js"></script>
	<script src="./js/partecipanti.js"></script>
</body>

</html>