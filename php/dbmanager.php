<?php
    include_once'dbconfig.php';
    include_once'sessioncontrol.php';
    
	function ProposteAdmin() {
		global $conn;
        $proposte="select u.nome,u.cognome,u.image,p.Nazione,p.Citta,p.DataInizio,p.DataFine,p.Prezzo,(p.NumPersone-p.PersoneOra) as PostiDisponibili,u.id,p.IdProposta,p.Descrizione,p.titoloViaggio,p.image
        from proposte p inner join utente u on u.id=p.IdProponente
		order by p.IdProposta
		limit 15;";
        $risultato = mysqli_query($conn, $proposte);    
        while($riga=mysqli_fetch_row($risultato)) {
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
            if($PostiDisponibili > 0){
                echo    '<div class="cancella card">
                            <div class="left" style="background-image:url(./immagini/background_proposte/'.$immagine.')"></div>
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
										<div class="immagine"><a href="./userprofile.php?id='.$idutente.'"><img
										alt="Immagine_Profilo" src="./upload/'.$ImmagineProponente.'"></div>
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
                                <div class="row">
                                    <button type="button" onclick="location.href=\'./php/offerelimination.php?proposta='.$idproposta.'\'">Elimina</button>
                                </div>
                            </div>
                        </div>';
            }
        }
	}

    function ProposteProprie(){
        global $conn;
        $id=$_SESSION["id"];
        $proposta="select p.citta,p.datainizio,p.PersoneOra, p.IdProposta, p.TitoloViaggio
                    from proposte p
                    where p.DataInizio >= current_date()
                    and p.IdProponente='$id';";
		$ris = mysqli_query($conn, $proposta);
		echo "<div class='proposte_proprie'>";
        while($riga=mysqli_fetch_row($ris)){
            $citta=$riga[0];
            $DataInizio=$riga[1];
			$Partecipanti=$riga[2];
			$IdProposta=$riga[3];
			$titolo=$riga[4];
			$giornoInizio= substr($DataInizio, 8, 2);
            $meseInizio = convertMonthToString(substr($DataInizio, 5, 2));
            echo    '<div class="proposta_propria">
						<div class="rows">
							<h3>'.$titolo.'</h3>
							<div class="data">
								'.$giornoInizio.'<br/><strong>'.$meseInizio.'</strong>
							</div>
						</div>
						<div class="rows">
							<div>
                                <img alt="icona luogo" src="./immagini/icone/place.png">
                                <p>'.$citta.'</p>
							</div>
							<div>
								<img alt="icona persona" src="./immagini/icone/pers.png">
								<p class="partecipanti" id="'.$IdProposta.'">'.$Partecipanti.'</p>
							</div>
						</div>
						<div class="rows"><button type="button" onclick="location.href=\'./php/offerelimination.php?proposta='.$IdProposta.'\'">Elimina</button></div>
					</button>
				</div>';
		};
		echo "</div>";
    }

    function ProposteDaAccettare(){
        global $conn;
        $id=$_SESSION["id"];
        $proposte="select u.nome,u.cognome,u.image,u.id,p.citta,p.datainizio,p.datafine, pa.idproposta, p.TitoloViaggio, p.descrizione, p.image, pa.idproponente
                    from utente u inner join propostedaaccettare pa on pa.idrichiedente=u.id inner join proposte p on p.idproposta=pa.idproposta
                    where pa.visualizzato=0
                    and pa.idproponente='$id';";
		$risultato = mysqli_query($conn, $proposte);
		echo '<div class=\'proposte_da_accettare\'>';
		$num_righe = mysqli_num_rows($risultato);
		if($num_righe > 0){
			echo '<h1 class="titolo_sezione">Proposte Da Accettare</h1>';
		}
        while($riga=mysqli_fetch_row($risultato)){
            $NomeProponente=$riga[0];
            $CognomeProponente=$riga[1];
            $ImmagineProponente=$riga[2];
            if($ImmagineProponente==NULL){
                $ImmagineProponente='placeholder.png';
            }
            $Idrichiedente=$riga[3];
            $Citta=$riga[4];
			$DataInizio=$riga[5];
			$DataFine=$riga[6];
			$Idproposta=$riga[7];
			$titolo=$riga[8];
			$descrizione=$riga[9];
			$immagine=$riga[10];
			$idporponente=$riga[11];
			$giornoInizio= substr($DataInizio, 8, 2);
            $giornoFine= substr($DataFine, 8, 2);
            $meseInizio = convertMonthToString(substr($DataInizio, 5, 2));
            $meseFine = convertMonthToString(substr($DataFine, 5, 2));
            echo    '<div class="card proposta_da_accettare">
                            <div class="left" style="background-image:url(./immagini/background_proposte/'.$immagine.')"></div>
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
                                        <div class="immagine"><a href="./userprofile.php?id='.$Idrichiedente.'"><img alt="immagine profilo" src="./upload/'.$ImmagineProponente.'"></div>
                                        <p class="nome">'.$NomeProponente.' '.$CognomeProponente.'</p></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <img alt="icona luogo" src="./immagini/icone/place.png">
                                        <p>'.$Citta.'</p>
                                    </div>
                                </div>
                                <div class="row">
									<button onclick="location.href=\'./php/offermodification.php?proposta='.$Idproposta.'&richiedente='.$Idrichiedente.'&accet=si\'" type="button">Accetta</button>

<button onclick="location.href=\'./php/offermodification.php?proposta='.$Idproposta.'&richiedente='.$Idrichiedente.'&accet=no\'" type="button">Rifiuta</button>
                                </div>
                            </div>
                        </div>';
		};
		echo "</div>";
	}

    function convertMonthToString($mese){
        switch($mese){
                case "01":
                   return "Gen";
                    break;
                case "02":
                   return "Feb";
                    break;
                case "03":
                   return "Mar";
                    break;
                case "04":
                   return "Apr";
                    break;
                case "05":
                   return "Mag";
                    break;
                case "06":
                   return "Giu";
                    break;
                case "07":
                   return "Lug";
                    break;
                case "08":
                   return "Ago";
                    break;
                case "09":
                   return "Set";
                    break;
                case "10":
                   return "Ott";
                    break;
                case "11":
                   return "Nov";
                    break;
                case "12":
                   return "Dic";
                    break;
            };
    }

    function UltimeProposte(){
        global $conn;
        $proposte="select u.nome,u.cognome,u.image,p.Nazione,p.Citta,p.DataInizio,p.DataFine,p.Prezzo,(p.NumPersone-p.PersoneOra) as PostiDisponibili,u.id,p.IdProposta,p.Descrizione,p.titoloViaggio,p.image
        from proposte p inner join utente u on u.id=p.IdProponente
		order by p.IdProposta desc
		limit 15;";
        $risultato = mysqli_query($conn, $proposte);    
        while($riga=mysqli_fetch_row($risultato)) {
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
            if($PostiDisponibili > 0){
                echo    '<div class="cancella card">
                            <div class="left" style="background-image:url(./immagini/background_proposte/'.$immagine.')"></div>
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
										<div class="immagine"><a href="./userprofile.php?id='.$idutente.'"><img
										alt="Immagine_Profilo" src="./upload/'.$ImmagineProponente.'"></div>
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
                                <div class="row">
                                    <form action="./php/offeraccettation.php?proposta='.$idproposta.'&prop='.$idutente.'" name="mio_form" method="post">
                                        <input name="bottone_sottometti" value="Partecipa" type="submit">;
                                    </form>
                                </div>
                            </div>
                        </div>';
            }
        }
    }

    function UltimeProposte1(){
        global $conn;
        global $id;
        $proposte="select u.nome,u.cognome,p.Nazione,p.Citta,p.DataInizio,p.DataFine,p.Prezzo,(p.NumPersone-p.PersoneOra) as PostiDisponibili,u.id,p.IdProposta,p.Descrizione,p.titoloViaggio,p.image
        from proposte p inner join utente u on u.id=p.IdProponente
        where p.IdProponente = ".$id."
        order by p.IdProposta;";
		$risultato = mysqli_query($conn, $proposte); 
		echo"<div class='proposte'>";   
		$num_righe = mysqli_num_rows($risultato);
		if($num_righe > 0){
			echo '<h1 class="titolo_sezione">Proposte dell\'utente</h1>';
		}
        while($riga=mysqli_fetch_row($risultato)) {
            $NomeProponente=$riga[0];
            $CognomeProponente=$riga[1];
            $Nazione=$riga[2];
            $Citta=$riga[3];
            $DataInizio=$riga[4];
            $DataFine=$riga[5];
            $Costo=$riga[6];
            $PostiDisponibili=$riga[7];
            $idutente=$riga[8];
			$idproposta=$riga[9];
            $descrizione=$riga[10];
            $titolo=$riga[11];
            $immagine=$riga[12];
            $giornoInizio= substr($DataInizio, 8, 2);
            $giornoFine= substr($DataFine, 8, 2);
            $meseInizio = convertMonthToString(substr($DataInizio, 5, 2));
			$meseFine = convertMonthToString(substr($DataFine, 5, 2));
			$NazioneOk = preg_replace('/\s+/', '_', $Nazione);
            if($PostiDisponibili > 0){
                echo    '<div class="card">
                            <div class="left" style="background-image:url(./immagini/background_proposte/'.$immagine.')"></div>
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
                                </div>
                                <div class="row">
                                    <div>
                                        <img alt="icona_lugo" src="./immagini/icone/place.png">
                                        <p>'.$Citta.'</p>
                                    </div>
                                    <div>
                                        <img alt="icona_persone" src="./immagini/icone/pers.png">
                                        <p>'.$PostiDisponibili.'</p>
                                    </div>
                                    <div>
                                        <img alt="icona_costo" src="./immagini/icone/money.png">
                                        <p>'.$Costo.'</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <form action="./php/offeraccettation.php?proposta='.$idproposta.'&prop='.$idutente.'" name="mio_form" method="post">
                                        <input name="bottone_sottometti" value="Partecipa" type="submit">&nbsp;
                                    </form>
                                </div>
                            </div>
                        </div>';
            }
		};
		echo "</div>";
    }

    function Bandiere(){
        global $conn;
        $id = $_SESSION['id'];
        $bandiere= "select distinct Nazione
                    from proposte
                    where current_date()>DataFine
                    and IdProponente='$id';";
        $query = mysqli_query($conn, $bandiere);
        $paesi_visitati = mysqli_num_rows($query);
        echo '<div class="bandiere">';
		echo "<div>$paesi_visitati/194</div>";
        while($riga=mysqli_fetch_row($query)){
            $nazione = $riga[0];
                echo'<img alt="bandiera '.$nazione.'" src="./immagini/flags/'.$nazione.'.png">';
        };
        echo '</div>';
    }

    function Bandiere1(){
        global $conn;
        global $id;
        $bandiere= "select distinct Nazione
                    from proposte
                    where current_date()>DataFine
                    and IdProponente='$id';";
        $query = mysqli_query($conn, $bandiere);
        $paesi_visitati = mysqli_num_rows($query);
        echo '<div class="bandiere">';
        echo "<div>$paesi_visitati/194</div>";
        while($riga=mysqli_fetch_row($query)){
            $nazione = $riga[0];
                echo'<img alt="bandiera '.$nazione.'" src="./immagini/flags/'.$nazione.'.png">';
        }
        echo '</div>';
    }

    function PropostePartecipate(){
        global $conn;
        $id = $_SESSION['id'];
        $sql = "select u.nome,u.cognome,u.image,p.Nazione,p.Citta,p.DataInizio,p.DataFine,p.Prezzo, u.id, p.Descrizione,p.titoloViaggio,p.image
        from proposte p inner join utente u on u.id=p.IdProponente inner join propostedaaccettare pa on pa.IdProposta = p.IdProposta
        where pa.IdRichiedente=".$id."
        and pa.Accettato = 1
        and pa.Visualizzato= 1
        order by p.IdProposta;";
		$risultato = mysqli_query($conn, $sql);
		echo "<div class='proposte_a_cui_partecipi'>";   
        while($riga=mysqli_fetch_row($risultato)) {
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
			$idProponente=$riga[8];
			$descrizione=$riga[9];
			$titolo=$riga[10];
			$immagine=$riga[11];
			$giornoInizio= substr($DataInizio, 8, 2);
            $giornoFine= substr($DataFine, 8, 2);
            $meseInizio = convertMonthToString(substr($DataInizio, 5, 2));
			$meseFine = convertMonthToString(substr($DataFine, 5, 2));
			$NazioneOk = preg_replace('/\s+/', '_', $Nazione);
            echo    '<div class="cancella card" id='.$NazioneOk.'>
                            <div class="left" style="background-image:url(./immagini/background_proposte/'.$immagine.')"></div>
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
                                        <div class="immagine"><a href="./userprofile.php?id='.$idProponente.'"><img alt="immagine_profilo" src="./upload/'.$ImmagineProponente.'"></div>
                                        <p class="nome">'.$NomeProponente.' '.$CognomeProponente.'</p></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <img alt="icona_città" src="./immagini/icone/place.png">
                                        <p>'.$Citta.'</p>
                                    </div>
                                    <div>
                                        <img alt="icona_costo" src="./immagini/icone/money.png">
                                        <p>'.$Costo.'</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
		};
		echo "</div>";
    }
    
    function InfoProfilo($id){
        global $conn;
        $sql="select u.nome, u.cognome, u.image
                from utente u
                where u.id=".$id."" ;
        $risultato = mysqli_query($conn, $sql);
        $riga=mysqli_fetch_row($risultato);
        $nome=$riga[0];
        $cognome=$riga[1];
        $image=$riga[2];
		echo '<div class="immagine_e_nome">
				<div class="immagineprop">
            <img alt="immagine profilo" class="RoundImage" src="./upload/'.$image.'">
			</div>';
		echo '<div>
            <p>'.$nome.' '.$cognome.'</p>
			</div>
			</div>';
    }

    function MeteGettonate(){
        global $conn;
        $sql="select p1.nazione, count(*) as numero
                            from proposte p1
                            group by p1.nazione
							order by numero desc
							limit 3";
        $risultato = mysqli_query($conn, $sql);    
        while($riga=mysqli_fetch_row($risultato)) {
			$Nazione = $riga[0];
			$NazioneOk = preg_replace('/\s+/', '_', $Nazione);
			echo '<div class="box">
			<img alt="meta_gettonata_'.$NazioneOk.'" class="RecImage" src="./immagini/proposte_gettonate/'.$NazioneOk.'.jpg">
			</div>';
        }
	}
	
	function recensioni() {
		global $conn;
        global $id;
        $sql= "SELECT f.voto, f.commento, u.nome, u.cognome, u.image, f.idrecensore
				FROM feedback f inner join utente u on u.id = f.idrecensore
				WHERE f.idrecensito = ".$id.";";
        $query = mysqli_query($conn, $sql);
		$num_righe = mysqli_num_rows($query);
		if($num_righe > 0){
			echo '<h1 class="titolo_sezione">Recensioni dell\'utente</h1><br>';
		}
		echo '<div class="recensioni">';
        while($riga=mysqli_fetch_row($query)){
			$voto = $riga[0];
			$commento = $riga[1];
			$nome = $riga[2];
			$cognome = $riga[3];
			$immagine = $riga[4];
			$idRecensore = $riga[5];
			echo    '<div class="recensione">
						<div class="rows">
                            <div class="commento">
                                <p>'.$commento.'</P>
                            </div>
                            <div class="recensore">
								<div class="immagine"><a href="./userprofile.php?id='.$idRecensore.'"><img class="RoundImage"
										alt="Immagine_Profilo" src="./upload/'.$immagine.'"></div>
                                <p class="nome">'.$nome.' '.$cognome.'</p></a>
                            </div>
                        </div>
						<div class="rows">
							<div class="voto">';
								stelle($voto);
			echo			"</div>
						</div>
					</div>";
        }
        echo '</div>';
	}

	function recensioniProprie() {
		global $conn;
        $id = $_SESSION['id'];
        $sql= "SELECT f.voto, f.commento, u.nome, u.cognome, u.image, f.idrecensore
				FROM feedback f inner join utente u on u.id = f.idrecensore
				WHERE f.idrecensito = ".$id.";";
        $query = mysqli_query($conn, $sql);
		$num_righe = mysqli_num_rows($query);
		if($num_righe > 0){
			echo '<h1 class="titolo_sezione">Recensioni</h1><br>';
		}
		echo '<div class="recensioni">';
        while($riga=mysqli_fetch_row($query)){
			$voto = $riga[0];
			$commento = $riga[1];
			$nome = $riga[2];
			$cognome = $riga[3];
			$immagine = $riga[4];
			$idRecensore = $riga[5];
			echo    '<div class="recensione">
						<div class="rows">
                            <div class="commento">
                                <p>'.$commento.'</P>
                            </div>
                            <div class="recensore">
								<div><a href="./userprofile.php?id='.$idRecensore.'"><img class="RoundImage"
										alt="Immagine_Profilo" src="./upload/'.$immagine.'"></div>
                                <p class="nome">'.$nome.' '.$cognome.'</p></a>
                            </div>
                        </div>
						<div class="rows">
							<div class="voto">';
								stelle($voto);
			echo			"</div>
						</div>
					</div>";
        }
        echo '</div>';
	}

	function stelle($voto) {
			switch($voto){
                case "1":
                	echo "<img class='stella' alt='stella' src='./immagini/icone/star.png'>";
					return;
					break;
                case "2":
				   echo "<img class='stella' alt='stella' src='./immagini/icone/star.png'>
				   		<img class='stella' alt='stella' src='./immagini/icone/star.png'>";
					return;
					break;
                case "3":
				   echo "<img class='stella' alt='stella' src='./immagini/icone/star.png'>
						   <img class='stella' alt='stella' src='./immagini/icone/star.png'>
						   <img class='stella' alt='stella' src='./immagini/icone/star.png'>";
					return;
					break;
                case "4":
				   echo "<img class='stella' alt='stella' src='./immagini/icone/star.png'>
						   <img class='stella' alt='stella' src='./immagini/icone/star.png'>
						   <img class='stella' alt='stella' src='./immagini/icone/star.png'>
						   <img class='stella' alt='stella' src='./immagini/icone/star.png'>";
					return;
					break;
                case "5":
				   echo "<img class='stella' alt='stella' src='./immagini/icone/star.png'>
						   <img class='stella' alt='stella' src='./immagini/icone/star.png'>
						   <img class='stella' alt='stella' src='./immagini/icone/star.png'>
						   <img class='stella' alt='stella' src='./immagini/icone/star.png'>
						   <img class='stella' alt='stella' src='./immagini/icone/star.png'>";
					return;
					break;
            };
	}
?>