<?php
    session_start();
    include_once 'dbconfig.php';
    $id = $_SESSION['id'];
    if(isset($_POST['invio']) && $_FILES['file']['name'] != ""){
        $file=$_FILES['file'];
        
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
		
		$pathOk = str_replace("php","",getcwd());
		$path1 = $pathOk . "upload/profile" . $id . ".jpg";
		$path2 = $pathOk . "upload/profile" . $id . ".jpeg";
		$path3 = $pathOk . "upload/profile" . $id . ".png";
		unlink($path1);
		unlink($path2);
		unlink($path3);
        
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 1*MB){
                    $fileNameNew = "profile".$id.".".$fileActualExt;
                    $fileDestination = '../upload/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $sql_query="update utente set image= '".$fileNameNew."' where id='".$id."';";
                    mysqli_query($conn, $sql_query);
                    $_SESSION['immagine']=$fileNameNew;
                    header("Location: ../homepage.php?Upload_Avvenuto_Con_Successo");
                } else{
                    header("Location: ../profilo.php?errore=Il file è troppo grande");
                }
            } else{
                header("Location: ../profilo.php?errore=Si è presentato un errore durante il caricamento");
            }
        } else{
            header("Location: ../profilo.php?errore=immagine non supportata");
        }
    } else {
		 header("Location: ../profilo.php?errore=immagine non caricata");
	}
?>