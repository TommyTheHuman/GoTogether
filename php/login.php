<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <title>NOME DEL SITO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="stile.css" type="text/css" media="screen"> <!-- css -->
</head>

<body>
    <form action="./logincontrol.php" name="mio_form" method="post">
        <fieldset name="myData">
            <legend>Dati personali</legend>
            <div>
                <label>
                    E-mail: *<br>
                    <input name="email" size="30" type="email" placeholder="Es: mario.rossi@gmail.com" value="tommyc98@yahoo.it"><br>
                </label>
                <label>
                    Password: *<br>
                    <input name="password" size="30" type="password" value="111"><br>
                </label>

            </div>
            <br>
            <div id="form_right">
                <div id="buttons">
                    <span>Pulsanti:</span><br>
                    <input name="bottone_sottometti" value="INVIA" type="submit">&nbsp;
                </div>
            </div>
        </fieldset>
    </form>
</body>

</html>
