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
    echo $id;
    
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>NOME DEL SITO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/GeneralRules.css" type="text/css" media="screen"> <!-- css -->
    <link rel="stylesheet" href="./css/userprofile.css" type="text/css" media="screen"> <!-- css -->

</head>

<body>
    <header>
        <nav class="mainNav">
            <div class="logo">
                <a href="./index.php">
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
    </header>
    <?php
    echo "<div class='InfoProfilo'>";
    InfoProfilo($id);
    echo "</div>";
    Bandiere1();
    echo "<div class='ultime_proposte1'>";
        UltimeProposte1();
    echo "</div>";
    echo '<form action="./php/feedback.php?idprop='.$id.'&idutente='.$idutente.'" name="mio_form" method="post">
        <input name="bottone_sottometti" value="Lascia Un Feedback" type="submit">&nbsp;
    </form>'
    ?>
</body>

</html>