<?php
	session_start();
    include_once"./dbconfig.php";
    include"./dbmanager.php";
    $json = json_decode(file_get_contents('php://input'));
    $nazione = isset($json->searchNazione) ? $json->searchNazione : 'Tutte';
    $nazioneok = mysqli_real_escape_string($conn, $nazione);
    $prezzo = mysqli_real_escape_string($conn,$json->maxPrice);
    $citta = mysqli_real_escape_string($conn,$json->searchCitta);
    $partenza = mysqli_real_escape_string($conn,$json->searchmesepart);
	$arrivo = mysqli_real_escape_string($conn,$json->searchmesearr);
	$minimo = $json->inferiorlimit;
	$massimo = $json->superiorlimit;

$variabili = array();
$query = "select u.nome,u.cognome,u.image,p.Nazione,p.Citta,p.DataInizio,p.DataFine,p.Prezzo,(p.NumPersone-p.PersoneOra) as PostiDisponibili,u.id,p.IdProposta,p.Descrizione,p.titoloViaggio,p.image
        from proposte p inner join utente u on u.id=p.IdProponente";   
if($nazione!=''){$variabili[] = "nazione = '$nazione'";}
if($prezzo!=500){$variabili[] = "prezzo <= $prezzo";}
if($citta!=''){$variabili[] = "citta = '$citta'";}
if($partenza){$variabili[] = "DataInizio >= '$partenza'";}
if($arrivo){$variabili[] = "DataFine > '$arrivo'";}

$sql = $query;
    if (count($variabili) > 0) {
      $sql .= " WHERE " . implode(' AND ', $variabili);
    }
	$sql .= " order by p.IdProposta";
	$sql .= " LIMIT " . $minimo .",". $massimo;
	$conto = 0;
    $risultato = mysqli_query($conn, $sql); 
        while($riga=mysqli_fetch_row($risultato)){
			$conto++;
            $NomeProponente=$riga[0];
            $CognomeProponente=$riga[1];
            $ImmagineProponente=$riga[2];
            if($ImmagineProponente==NULL){
                $ImmagineProponente='placeholder.png';
            }
            $Nazione=$riga[3];
            $Citta=$riga[4];
            $DataInizio=$riga[5];
            $DataFine=$riga[6];
            $Costo=$riga[7];
            $PostiDisponibili=$riga[8];
            $idutente=$riga[9];
            $idproposta=$riga[10];
            $descrizione=$riga[11];
            $titolo=$riga[12];
            $immagine=$riga[13];
            $giornoInizio= substr($DataInizio, 8, 2);
            $giornoFine= substr($DataFine, 8, 2);
            $meseInizio = convertMonthToString(substr($DataInizio, 5, 2));
			$meseFine = convertMonthToString(substr($DataFine, 5, 2));
			echo    '<div class="ricerca card';
				if ($conto == 5){
					echo ' card--loader';
				};
				echo	'"><div class="left" style="background-image:url(./immagini/background_proposte/'.$immagine.')"></div>
                            <div class="right">
                                <div class="row"> 
                                    <h3>'.$titolo.'</h3>
                                    <div class="data">
                                        <div>'.$giornoInizio.'<br/><strong>'.$meseInizio.'</strong></div> 
                                        <div>'.$giornoFine.'<br/><strong>'.$meseFine.'</strong></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="descrizione">
                                        <p>'.$descrizione.'</P>
                                    </div>
                                    <div class="proponente">
                                        <div class="immagine"><a href="./userprofile.php?id='.$idutente.'"><img alt="Immagine_Profilo" src="./upload/'.$ImmagineProponente.'"></div>
                                        <p class="nome">'.$NomeProponente.' '.$CognomeProponente.'</p></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
										<img alt="Icona_Luogo" src="./immagini/icone/place.png">
                                        <p>'.$Citta.'</p>
                                    </div>
                                    <div>
                                        <img alt="Icona_persone" src="./immagini/icone/pers.png">
                                        <p>'.$PostiDisponibili.'</p>
                                    </div>
                                    <div>
                                        <img alt="Icona_costo" src="./immagini/icone/money.png">
                                        <p>'.$Costo.'</p>
                                    </div>
                                </div>
								<div class="row">';
		if(isset($_SESSION['client'])){
			echo '<button type="button" onclick="location.href=\'./php/offerelimination.php?proposta='.$idproposta.'\'">Elimina</button>';
		}else{
			echo'
                                    <form action="./php/offeraccettation.php?proposta='.$idproposta.'&prop='.$idutente.'" name="mio_form" method="post">
                                        <input name="bottone_sottometti" value="Partecipa" type="submit">&nbsp;
									</form>';
		}
         echo'                      </div>
                            </div>
                        </div>';
        }



?>