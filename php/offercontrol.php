    <?php
    session_start();
    include_once'dbconfig.php';

    $id = $_SESSION['id'];
    $citta = $_POST['citta'];
    $NumeroPersone = $_POST['numeropersone'];
    $Prezzo = $_POST['prezzo'];
    $DataPartenza = $_POST['partenza'];
    $DataRitorno = $_POST['ritorno'];
    $Nazione = $_POST['country'];
    $Descrizione = $_POST['descrizione'];
    $Titolo = $_POST['titolo'];
    $file = $_FILES['file'];

            define('KB', 1024);
            define('MB', 1048576);
            define('GB', 1073741824);
            define('TB', 1099511627776);

            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 6*MB){
						$uploads_dir = "..\immagini\background_proposte";
						$NazioneOk = preg_replace('/\s+/', '_', $Nazione);
                        $idUnivoco = uniqid("$NazioneOk", false);
                        var_dump($idUnivoco);
                        $fileNameNew = "background_".$idUnivoco.".".$fileActualExt;
                        move_uploaded_file($fileTmpName, "$uploads_dir/$fileNameNew");

                    }else{
                        header("Location: ../homepage.php?errore=Il file è troppo grande");
                    }
                }else{
                    header("Location: ../homepage.php?errore=Si è presentato un errore durante il caricamento");
                }
            }else{
            header("Location: ../homepage.php?errore=immagine non supportata");
        }
    
	$sql="insert into proposte (IdProponente, Nazione, Citta, DataInizio, DataFine, Prezzo, NumPersone, titoloViaggio, image, descrizione)values('$id','$Nazione','$citta','$DataPartenza','$DataRitorno','$Prezzo','$NumeroPersone', '$Titolo', '$fileNameNew', '$Descrizione');";
	echo $sql;
    mysqli_query($conn,$sql);
    header("location: ../homepage.php?msg=Proposta creata con successo");
?>