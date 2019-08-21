<?php
    include_once'dbconfig.php';
    include_once'sessioncontrol.php';
    

    function ProposteProprie(){
        global $conn;
        $id=$_SESSION["id"];
        $proposta="select p.citta,p.datainizio,(p.NumPersone-p.PersoneOra) as PostiDisponibili
                    from proposte p
                    where p.DataInizio >= current_date()
                    and p.IdProponente='$id';";
        $ris = mysqli_query($conn, $proposta);
        while($riga=mysqli_fetch_row($ris)){
            $citta=$riga[0];
            $DataInizio=$riga[1];
            $PostiDIsponibili=$riga[2];
            echo    '<div class="proposta_propria">
                        <p class="citta">'.$citta.'</p>
                        <p class="data_inizio">'.$DataInizio.'</p>
                        <p class="posti_disponibili">'.$PostiDIsponibili.'</p>
                    </div>';
        }
    }

    function ProposteDaAccettare(){
        global $conn;
        $id=$_SESSION["id"];
        $proposte="select u.nome,u.cognome,u.image,u.id,p.citta,p.datainizio,pa.idproposta
                    from utente u inner join propostedaaccettare pa on pa.idrichiedente=u.id inner join proposte p on p.idproposta=pa.idproposta
                    where pa.visualizzato=0
                    and pa.idproponente='$id';";
        $risultato = mysqli_query($conn, $proposte);   
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
            $Idproposta=$riga[6];
            echo    '<div class="proposta_da_accettare">
                        <p class="nome" >'.$NomeProponente.' '.$CognomeProponente.'</p>
                        <a href="./userprofile.php?id='.$Idrichiedente.'"><img src="./upload/'.$ImmagineProponente.'"></a>
                        <p class="luogo" >'.$Citta.'</p>
                        <p class="data" >'.$DataInizio.'</p>
                        <form class="accetta" action="./php/offermodification.php?proposta='.$Idproposta.'&richiedente='.$Idrichiedente.'&accet=si" name="mio_form" method="post">
                            <input name="bottone_sottometti" value="Accetta" type="submit">&nbsp;
                        </form>
                        <form class="rifiuta" action="./php/offermodification.php?proposta='.$Idproposta.'&richiedente='.$Idrichiedente.'&accet=no" name="mio_form" method="post">
                            <input name="bottone_sottometti" value="Rifiuta" type="submit">&nbsp;
                        </form>
                    </div>';
        }
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
        order by p.IdProposta;";
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
                echo    '<div class="cancella card" id='.$Nazione.'>
                            <div class="left" style="background-image:url(./immagini/background_proposte/'.$immagine.')"></div>
                            <div class="right">
                                <div class="row"> 
                                    <h3>'.$titolo.'</h3>
                                    <div class="data">
                                        <time>'.$giornoInizio.'<br/><strong>'.$meseInizio.'</strong></time> 
                                        <time>'.$giornoFine.'<br/><strong>'.$meseFine.'</strong></time>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="descrizione">
                                        <p>'.$descrizione.'</P>
                                    </div>
                                    <div class="proponente">
                                        <div class="immagine"><a href="./userprofile.php?id='.$idutente.'"><img src="./upload/'.$ImmagineProponente.'"></div>
                                        <p class="nome">'.$NomeProponente.' '.$CognomeProponente.'</p></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <img src="./immagini/icone/place.png">
                                        <p>'.$Citta.'</p>
                                    </div>
                                    <div>
                                        <img src="./immagini/icone/pers.png">
                                        <p>'.$PostiDisponibili.'</p>
                                    </div>
                                    <div>
                                        <img src="./immagini/icone/money.png">
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
        }
    }

    function UltimeProposte1(){
        global $conn;
        global $id;
        $proposte="select u.nome,u.cognome,p.Nazione,p.Citta,p.DataInizio,p.DataFine,p.Prezzo,(p.NumPersone-p.PersoneOra) as PostiDisponibili,u.id,p.IdProposta
        from proposte p inner join utente u on u.id=p.IdProponente
        where p.IdProponente = ".$id."
        order by p.IdProposta;";
        $risultato = mysqli_query($conn, $proposte);    
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
            echo    '<div class="proposta1" id='.$Nazione.'>
                        <p class="luogo_1">'.$Nazione.' '.$Citta.'</p>
                        <p class="periodo_1">'.$DataInizio.' '.$DataFine.'</p>
                        <p class="costo_1">'.$Costo.'</p>
                        <p class="posti_disponibili_1">'.$PostiDisponibili.'</p>';
            if($PostiDisponibili != 0){
                    echo   '<form action="./php/offeraccettation.php?proposta='.$idproposta.'&prop='.$idutente.'" name="mio_form" method="post">
                            <input name="bottone_sottometti" value="Partecipa" type="submit">&nbsp;
                        </form>
                    </div>';
            }
            else{
                echo '</div>';
            }
        }
    }

    function Bandiere(){
        global $conn;
        $id = $_SESSION['id'];
        $bandiere= "select distinct Nazione
                    from proposte
                    where current_date()<DataFine
                    and IdProponente='$id';";
        $query = mysqli_query($conn, $bandiere);
        $paesi_visitati = mysqli_num_rows($query);
        echo '<div class="bandiere">';
        echo "<p>$paesi_visitati/194</p>";
        while($riga=mysqli_fetch_row($query)){
            $nazione = $riga[0];
                echo'<img src="./immagini/flags/'.$nazione.'.png">';
        }
        echo '</div>';
    }

    function Bandiere1(){
        global $conn;
        global $id;
        $bandiere= "select distinct Nazione
                    from proposte
                    where current_date()<DataFine
                    and IdProponente='$id';";
        $query = mysqli_query($conn, $bandiere);
        $paesi_visitati = mysqli_num_rows($query);
        echo '<div class="bandiere">';
        echo "<p>$paesi_visitati/194</p>";
        while($riga=mysqli_fetch_row($query)){
            $nazione = $riga[0];
                echo'<img src="./immagini/flags/'.$nazione.'.png">';
        }
        echo '</div>';
    }

    function PropostePartecipate(){
        global $conn;
        $id = $_SESSION['id'];
        $sql = "select u.nome,u.cognome,u.image,p.Nazione,p.Citta,p.DataInizio,p.DataFine,p.Prezzo, u.id
        from proposte p inner join utente u on u.id=p.IdProponente inner join propostedaaccettare pa on pa.IdProposta = p.IdProposta
        where pa.IdRichiedente=".$id."
        and pa.Accettato = 1
        and pa.Visualizzato= 1
        order by p.IdProposta;";
        $risultato = mysqli_query($conn, $sql);    
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
            echo    '<div class="proposta_partecipata" id='.$Nazione.'>
                        <p class="nome_proponente">'.$NomeProponente.' '.$CognomeProponente.'</p>
                        <a href="./userprofile.php?id='.$idProponente.'"><img src="./upload/'.$ImmagineProponente.'"></a>
                        <p class="luogo_proposto">'.$Nazione.' '.$Citta.'</p>
                        <p class="periodo_proposto">'.$DataInizio.' '.$DataFine.'</p>
                        <p class="costo_proposto">'.$Costo.'</p>
                    </div>';
        }
    }

    function PartecipantiAllaTuaProposta(){
        global $conn;
        $id = $_SESSION['id'];
        $idproposta = 0;
        $idprec = -10;
        $sql = "select p.nazione, p.citta, p.datainizio, p.datafine, u.nome, u.cognome, u.id, u.image, p.idproposta
        from proposte p inner join propostedaaccettare pa on pa.IdProposta = p.IdProposta inner join utente u on u.id=pa.IdRichiedente
        where pa.IdProponente=".$id."
        and pa.Accettato = 1
        and pa.Visualizzato= 1
        order by p.IdProposta;";
        $risultato = mysqli_query($conn, $sql);    
        while($riga=mysqli_fetch_row($risultato)) {
            $Nazione = $riga[0];
            $Citta = $riga[1];
            $DataInizio = $riga[2];
            $DataFine = $riga[3];
            $nomepartecipante = $riga[4];
            $cognomepartecipante = $riga[5];
            $idpartecipante = $riga[6];
            $ImmaginePartecipante = $riga[7];
            $idproposta = $riga[8];
             if($ImmaginePartecipante==NULL){
                $ImmaginePartecipante='placeholder.png';
            }
                
            if($idprec != $idproposta) {
                if($idprec==-10) {
                    echo  '<div class="partecipanti">
                        <div class="persona"> <p>'.$nomepartecipante.' '.$cognomepartecipante.'</p>
                        <a href="./userprofile.php?id='.$idpartecipante.'"><img class="RoundImage" src="./upload/'.$ImmaginePartecipante.'"></a></div>
                        <p class="noflex nazione">'.$Nazione.'</p>
                        <p class="noflex citta_partecipanti">'.$Citta.'</p>
                        <p class="noflex periodo">'.$DataInizio.' '.$DataFine.'</p>';
                    $idprec = $idproposta;
                } else {
                    echo '</div>';
                    $idprec = -10;
                    echo  '<div class="partecipanti">
                        <div class="persona"> <p>'.$nomepartecipante.' '.$cognomepartecipante.'</p>
                        <a href="./userprofile.php?id='.$idpartecipante.'"><img class="RoundImage" src="./upload/'.$ImmaginePartecipante.'"></a></div>
                        <p class="noflex nazione">'.$Nazione.'</p>
                        <p class="noflex citta_partecipanti">'.$Citta.'</p>
                        <p class="noflex periodo">'.$DataInizio.' '.$DataFine.'</p>';
                    $idprec = $idproposta;
                }
                
            } else {
                echo '<div class="persona"> <p>'.$nomepartecipante.' '.$cognomepartecipante.'</p>
                        <a href="./userprofile.php?id='.$idpartecipante.'"><img class="RoundImage" src="./upload/'.$ImmaginePartecipante.'"></a></div>';
            }
        }
        
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
        echo '<div>
            <p>'.$nome.' '.$cognome.'</p>
            </div>';
        echo '<div>
            <img class="RoundImage" src="./upload/'.$image.'">
            </div>';
    }

    function MeteGettonate(){
        global $conn;
        $sql="select p1.nazione, count(*) as numero
                            from proposte p1
                            group by p1.nazione
                            order by numero desc";
        $risultato = mysqli_query($conn, $sql);    
        while($riga=mysqli_fetch_row($risultato)) {
            $Nazione = $riga[0];
            echo '<img class="RoundImage" src="./immagini/proposte_gettonate/'.$Nazione.'.jpg">';
        }
    }
?>