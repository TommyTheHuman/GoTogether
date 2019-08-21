<?php
	session_start();
    include "./php/sessioncontrol.php";
    include "./php/dbmanager.php";
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>Go Together</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="./immagini/faveicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/stile.css" type="text/css" media="screen"> <!-- css -->
    <link rel="stylesheet" href="./css/GeneralRules.css" type="text/css" media="screen"> <!-- css -->
</head>

<body>
    <header class="ImmagineBackground">
        <div id="navbg">
            <nav>
                <a href="./homepage.php"><img src="./immagini/logoicon.png" id="logopiccolo"></a>
                <div class="NavBar">
                    <ul>
                        <li class="AzoSans"><a href="#desc">Chi Siamo?</a></li>
                        <li class="AzoSans"><a href="#posti">Scopri</a></li>
                        <li class="AzoSans"><a href="#scelta">Perchè sceglierci</a></li>
                        <li class="AzoSans"><a href="#contatti">Contact</a></li>
                        <?php
            if(isLogged()){
                    echo '
                    <li class="AzoSans">
                        <a href="./profilo.php">
                            '.$_SESSION["nome"].'  '.$_SESSION["cognome"].'
                        </a>
                    </li>
                    <li class="AzoSans">
                        <a href="./profilo.php">
                            <img class="RoundImage" src="./upload/'.$_SESSION["immagine"].'">
                        </a>
                    </li>';
                }else{
                echo'<li class="AzoSans"><a href="./php/login.php">LogIn</a></li>
                <li class="AzoSans"><a href="./php/register.php">Register</a></li>';
            }
            ?>
                    </ul>
                </div>
            </nav>
        </div>
        <img src="./immagini/logo.png" alt="Logo" id="Logo">
    </header>
    <section id="desc" class="container clearfix boxTesto">
        <div class="box">
            <h3 class="AzoSans">DESCRIZIONE DEL SERVIZIO</h3>
        </div>
        <div class="box">
            <p class="Lato">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mattis, felis at dignissim volutpat, nunc dolor mollis tellus, ac ultrices purus diam quis enim. Maecenas mattis tincidunt ex, at facilisis dui rhoncus non. Aenean maximus, augue ac pellentesque convallis, mi mauris egestas neque, sit amet fermentum augue ex quis orci. Nullam non eros in neque vehicula ultrices non eget tellus. Maecenas ac scelerisque quam. Ut porta facilisis neque at sollicitudin. Pellentesque hendrerit sit amet justo et feugiat. Maecenas mattis accumsan malesuada. Fusce vulputate lacinia diam et porttitor. Phasellus lacus diam, elementum sed elit ac, imperdiet ornare turpis. Nulla feugiat nulla ac erat mollis mattis. Aenean feugiat ultricies arcu ac lacinia. Maecenas in quam vitae neque ullamcorper viverra. Donec ac vulputate velit. Integer ullamcorper neque in ante bibendum, pretium luctus turpis lacinia. Suspendisse enim mauris, porta vitae faucibus eu, fringilla eget lacus.</p>
        </div>
    </section>
    <section id="posti" class="container clearfix boxTesto">
        <div class="box">
            <?php MeteGettonate(); ?>
        </div>
        <div class="box">
            <p> immagine 2</p>
        </div>
        <div class="box">
            <p> immagine 34</p>
        </div>
        <div class="box">
            <h3 class="AzoSans">DESTINAZIONI POPOLARI</h3>
        </div>
    </section>
    <section id="scelta" class="container clearfix boxTesto">
        <div class="box">
            <h3 class="AzoSans">perchè sceglierci</h3>
        </div>
        <div class="box">
            <p class="Lato">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mattis, felis at dignissim volutpat, nunc dolor mollis tellus, ac ultrices purus diam quis enim. Maecenas mattis tincidunt ex, at facilisis dui rhoncus non. Aenean maximus, augue ac pellentesque convallis, mi mauris egestas neque, sit amet fermentum augue ex quis orci. Nullam non eros in neque vehicula ultrices non eget tellus. Maecenas ac scelerisque quam. Ut porta facilisis neque at sollicitudin. Pellentesque hendrerit sit amet justo et feugiat. Maecenas mattis accumsan malesuada. Fusce vulputate lacinia diam et porttitor. Phasellus lacus diam, elementum sed elit ac, imperdiet ornare turpis. Nulla feugiat nulla ac erat mollis mattis. Aenean feugiat ultricies arcu ac lacinia. Maecenas in quam vitae neque ullamcorper viverra. Donec ac vulputate velit. Integer ullamcorper neque in ante bibendum, pretium luctus turpis lacinia. Suspendisse enim mauris, porta vitae faucibus eu, fringilla eget lacus.</p>
        </div>
    </section>
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
    <script type="text/javascript" src="./js/ScrollToTop.js"></script>
</body>
