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
                    <a href="./profilo.php">
                        <?php echo $user->nome." ".$user->cognome ?>
                        <img class='RoundImage' <?php echo 'src='.$user->profileImage ?>>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="cambioimmagine" style="display: none;" id="invisibile">
    <form action="./php/imageupload.php" name="mio_form" method="post" enctype="multipart/form-data">
        <fieldset name="myData">
            <legend>Dati personali</legend>
            <div>
                <label>
                    immagine:<br>
                    <input name="file" type="file"><br>
                </label>
            </div>
            <br>
            <div id="form_right">
                <div id="buttons">
                    <span>Pulsanti:</span><br>
                    <input name="invio" value="INVIA" type="submit">&nbsp;
                </div>
            </div>
        </fieldset>
    </form>
    </div>
    <input onclick="Appear()" value="Cambio Immagine" type="button">
    <?php Bandiere(); ?>
    </header>
    <script type="text/javascript" src="./js/controlloform.js"></script>
    <?php
        echo "<div class='proposte_da_accettare'>";
                ProposteDaAccettare();
        echo "</div>";
        
        echo "<div class='proposte_proprie'>";
                ProposteProprie();
        echo "</div>";
                
        PropostePartecipate();
        
        echo "<div class='partecipanti_tue_proposte'>";
        PartecipantiAllaTuaProposta();
        echo "</div>"
    ?>
    <script type="text/javascript" src="./js/appear.js"></script>
</body>

</html>
