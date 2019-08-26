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
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="./immagini/faveicon.ico" type="image/x-icon" />
    <?php include_once './include/head.html' ?>
	<!-- css custom -->
    <link rel="stylesheet" href="./css/GeneralRules.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/HomePage.css" type="text/css" media="screen">
</head>

<body id="bod" class="contenitore">
    <header class="ImmagineBackground">
        <nav class="mainNav">
            <div class="logo">
                <a href="./homepage.php">
                    <img alt="logo" src="./immagini/logoicon.png">
                </a>
            </div>
            <div class="voices">
                <ul>
                    <li class="AzoSans oggetto"><a href="./php/offer.php">Fai la tua proposta</a></li>
                    <li>
                        <a href="./profilo.php">
                            <?php echo $user->nome." ".$user->cognome ?>
                            <img alt="immagine_profilo" class='RoundImage' <?php echo 'src='.$user->profileImage ?>>
                        </a>
                    </li>
                    <li>
                        <img alt="icona_logout" data-function="logout" class="logouticon" src="./immagini/icone/logout.png">
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="mainContainer">
        <div>
           <section id="print"></section>
            <section  class="proposte">
                <?php
                ProposteAdmin();
            ?>
            </section>
        </div>
    </main>
    <footer id="contatti">
        <section class="clearfix container">
            <div class='box1'>
                <ul>
                    <li><a><img src="./immagini/icone/facebook.png" alt="icona_facebook"></a></li>
                    <li><a><img src="./immagini/icone/insta.png" alt="icona_instagram"></a></li>
                    <li><a><img src="./immagini/icone/youtube.png" alt="icona_youtube"></a></li>
                </ul>
            </div>
            <div class='box1'>
                <a href="./index.php"><img alt="logo" src="./immagini/logoicon.png" class="logopiccolo"></a>
            </div>
            <div class='box1'>
                <button id="scroll">
                    Back To Top
                </button>
            </div>
        </section>
    </footer>
    <script src="./js/appear.js"></script>
    <script src="./js/logout.js"></script>
    <script src="./js/ScrollToTop.js"></script>
</body>
