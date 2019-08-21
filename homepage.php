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
    <!-- css reset -->
    <link rel="stylesheet" href="./css/normalize/normalize.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/formReset.css" type="text/css" media="screen">
    <!-- css custom -->
    <link rel="stylesheet" href="./css/GeneralRules.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/HomePage.css" type="text/css" media="screen">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&display=swap" rel="stylesheet">
</head>

<body id="bod" class="contenitore">
    <header class="ImmagineBackground">
        <nav class="mainNav">
            <div class="logo">
                <a href="./homepage.php">
                    <img src="./immagini/logoicon.png">
                </a>
            </div>
            <div class="voices">
                <ul>
                    <li class="AzoSans oggetto"><a href="./php/offer.php">Fai la tua proposta</a></li>
                    <li>
                        <a href="./profilo.php">
                            <?php echo $user->nome." ".$user->cognome ?>
                            <img class='RoundImage' <?php echo 'src='.$user->profileImage ?>>
                        </a>
                    </li>
                    <li>
                        <button data-function="logout">icon_logout</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="mainContainer">
        <aside id="Ricerca" class="ricerca">
            <div class="form">
                <form name="filtro">
                    <div>
                        <label for="searchNazione">Nazione</label>
                        <input type="text" placeholder="Nazione" id="searchNazione" name="searchNazione">
                    </div>
                    <button class="invisibleTrigger button" type="button">Ulteriori opzioni</button>
                    <div>
                        <div>
                            <label for="searchNazione">Citt&agrave;</label>
                            <input type="text" placeholder="Città" id="searchCitta" name="searchCitta">
                        </div>
                        <div>
                            <label>
                                Prezzo fino a:<br>
                                <input type="range" value="500" name="voto" min="50" max="500" step="10" value="1" id="MaxPrice">
                            </label>
                            <span id="votoDisplay"></span>
                        </div>
                        <div>
                            <label for="mesepart">Mese Partenza<br>
                                <input type="date" id="Mese_partenza" min="" max="" onkeydown="return false">
                            </label>
                        </div>
                        <div>
                            <label for="mesearr">Mese Arrivo<br>
                                <input type="date" id="Mese_arrivo">
                            </label>
                        </div>
                    </div>
                    <input type="submit" class="button button_cta" value="Cerca" id="subNazione">
                    <button class="DeleteSearch" id="DeleteSearch" type="button">Cancella Ricerca</button>
                </form>
            </div>
        </aside>
        <div>
           <section id="print"></section>
            <section  class="proposte">
                <?php
                UltimeProposte();
            ?>
            </section>
        </div>
    </main>
    <footer id="contatti">
        <section class="clearfix container">
            <div class='box1'>
                <ul>
                    <li><a><img src="./immagini/icone/facebook.png" alt=""></a></li>
                    <li><a><img src="./immagini/icone/insta.png" alt=""></a></li>
                    <li><a><img src="./immagini/icone/youtube.png" alt=""></a></li>
                </ul>
            </div>
            <div class='box1'>
                <a href="./index.php"><img src="./immagini/logoicon.png" id="logopiccolo"></a>
            </div>
            <div class='box1'>
                <button id="scroll">
                    Back To Top
                </button>
            </div>
        </section>
    </footer>
    <script type="text/javascript" src="./js/search.js"></script>
    <script type="text/javascript" src="./js/appear.js"></script>
    <script type="text/javascript" src="./js/logout.js"></script>
    <script type="text/javascript" src="./js/ScrollToTop.js"></script>
    <script>
        var mySlider = document.getElementById('MaxPrice');
        var mySliderValue = document.getElementById('votoDisplay');

        function showValue() {
            mySliderValue.innerHTML = mySlider.value;
        };
        showValue();
        mySlider.addEventListener("input", showValue, false);

    </script>
</body>