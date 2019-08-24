<?php 
include_once'dbconfig.php';
	include_once'sessioncontrol.php';
	
	$dataReceived = file_get_contents('php://input');
	$sql = 'select u.nome, u.cognome, u.image, u.id
        from proposte p
        inner join propostedaaccettare pa 
        on pa.IdProposta = p.IdProposta
        inner join utente u
        on u.id=pa.IdRichiedente
        where pa.Idproposta='.$dataReceived.'
        and pa.Accettato = 1
		and pa.Visualizzato= 1;';
		$ris = mysqli_query($conn, $sql);
		echo '<ul>';
        while($riga=mysqli_fetch_row($ris)){
            $nome=$riga[0];
            $cognome=$riga[1];
			$immagine=$riga[2];
			$id=$riga[3];
			echo '
				<li class="partecipante">
					<a href="./userprofile.php?id='.$id.'">
						<img class="RoundImage" src="./upload/'.$immagine.'">
						<p class="nome">'.$nome.' '.$cognome.'</p>
					</a>
				</li>
				';
		};
		echo '</ul>';
?>