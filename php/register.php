<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>NOME DEL SITO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="stile.css" type="text/css" media="screen"> <!-- css -->
</head>

<body>
    <form name="registrazione" method="post">
        <fieldset name="myData">
            <legend>Dati personali</legend>
            <div>
                <label>
                    Nome: *<br>
                    <input name="name" size="15" type="text" placeholder="Es: Mario" pattern="[a-zA-Z\s]+"><br>
                </label>
                <label>
                    Cognome: *<br>
                    <input name="surname" size="15" type="text" placeholder="Es: Rossi" pattern="[a-zA-Z\s]+"><br>
                </label>
                <label>
                    Password: *<br>
                    <input name="password" size="30" type="password"><br>
                </label>
                <label>
                    Conferma Password: *<br>
                    <input name="repassword" size="30" type="password"><br>
                </label>
                <label>
                    E-mail: *<br>
                    <input name="email" size="30" type="email" placeholder="Es: mario.rossi@gmail.com"><br>
                </label>
                <label>
                    Data di Nascita:<br>
                    <input name="birthDate" type="date" max="" onkeydown="return false"><br>
                </label>
                <label>
                    <p>Maschio</p>
                    <input type="radio" name="Sesso" id="Maschio" value="Maschio">
                    <p>Femmina</p>
                    <input type="radio" name="Sesso" id="Femmina" value="Femmina">
                </label>
            </div>
            <div style="font-size:9pt; float: none; padding: 0px; margin: 0px; color: red">
                <sup>*</sup> Campi obbligatori
            </div><br>
            <div id="form_right">
                <div id="buttons">
                    <span>Pulsanti:</span><br>
                    <input name="bottone_sottometti" value="INVIA" type="button" onclick="controllo()">&nbsp;
                </div>
            </div>
        </fieldset>
    </form>
    <script type="text/javascript" src="../js/controlloform.js"></script>
    <script type="text/javascript" src="../js/RegisterDateControl.js"></script>
</body>

</html>
