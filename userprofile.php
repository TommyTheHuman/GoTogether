<?php
    session_start();
    include "./php/sessioncontrol.php";
    include_once'./php/dbconfig.php';
    include_once './php/dbmanager.php';

    if (!isLogged()){
		    header('Location: ./index.php');
		    exit;
    }
    $id = $_GET['id'];
    $idutente = $_SESSION['id'];
    $user = new stdClass();
    $user->nome = $_SESSION["nome"];
    $user->cognome = $_SESSION["cognome"];
    $user->profileImage = './upload/'.$_SESSION['immagine'];
	if($id == $idutente){
		header('Location: ./profilo.php');
	}
    
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>NOME DEL SITO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php include_once './include/head.html' ?>
    <link rel="stylesheet" href="./css/GeneralRules.css" type="text/css" media="screen"> <!-- css -->
    <link rel="stylesheet" href="./css/userprofile.css" type="text/css" media="screen"> <!-- css -->

</head>

<body>
    <header>
        <nav class="mainNav">
            <div class="logo">
                <a href="./index.php">
                    <img alt="logo" src="./immagini/logoicon.png">
                </a>
            </div>
            <div class="voices">
                <ul>
                    <li>
                        <a href="./profilo.php">
                            <?php echo $user->nome." ".$user->cognome ?>
                            <img alt="immagine_profilo" class='RoundImage' <?php echo 'src='.$user->profileImage ?>>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php
    echo "<div class='InfoProfilo'>";
	InfoProfilo($id);
	echo '<div class="bottoneFeed"><button type="button" onclick="location.href=\'./php/feedback.php?idprop='.$id.'&idutente='.$idutente.'\'">Lascia Un Feedback</button></div>';
    echo "</div>";
    	Bandiere1();
        UltimeProposte1();
	?>
</body>

</html>
