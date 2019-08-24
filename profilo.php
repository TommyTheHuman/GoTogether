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
	<title>NOME DEL SITO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="./css/profile.css" type="text/css" media="screen"> <!-- css -->
	<?php include_once './include/head.html' ?>
</head>

<body onload=" <?php
        if(isset($_GET["errore"]) && ($_GET["errore"]=='immagine non supportata' || $_GET["errore"]=='Il file è troppo grande' || $_GET["errore"]=="Si è presentato un errore durante il caricamento"))
        {
            $errore = $_GET["errore"];
            print("alert('$errore');window.location.href='./profilo.php'");
            
        }
    ?>">
	<header>
		<nav class="mainNav">
			<div class="logo">
				<a href="./homepage.php">
					<img src="./immagini/logoicon.png">
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
							<img class='RoundImage' <?php echo 'src='.$user->profileImage ?>>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<script type="text/javascript" src="./js/controlloform.js"></script>
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

	<div class="modal" id="modal">
		<div class="modal__content">
			<button class="openmodal" type="button"><img class="immagine_modal" src="./immagini/icone/x.png"></button>
			<div class="modal__innerContent">
				
			</div>
		</div>
	</div>

	<script type="text/javascript" src="./js/appear.js"></script>
	<script type="text/javascript" src="./js/tab.js"></script>
	<script type="text/javascript" src="./js/modal.js"></script>
	<script type="text/javascript" src="./js/partecipanti.js"></script>
</body>
</html>