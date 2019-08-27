function controlloForm() {

	var citta = document.offer.citta.value;
	var numPersone = document.offer.numeropersone.value;
	var prezzo = document.offer.prezzo.value;
	var partenza = document.offer.partenza.value;
	var ritorno = document.offer.ritorno.value;
	var country = document.offer.country.value;
	var titolo = document.offer.titolo.value;
	var descrizione = document.offer.descrizione.value;
	var immagine = document.offer.file.value;
	var partenza_data = new Date(partenza);
	var ritorno_data = new Date(ritorno);

	if (citta == '' || citta == 'undefined') {
		alert('Il campo Città è obbligatorio.');
		document.getElementsByName("citta")[0].focus();
		return false;
	} else if (numPersone == '' || numPersone == 'undefined') {
		alert('Il campo numeroPersone è obbligatorio.');
		document.offer.numeropersone.focus();
		return false;
	} else if (prezzo == '' || prezzo == 'undefined') {
		alert('Il campo Prezzo è obbligatorio.');
		document.offer.prezzo.focus();
		return false;
	} else if (partenza == '' || partenza == 'undefined') {
		alert('Il campo DataPartenza è obbligatorio.');
		document.offer.partenza.focus();
		return false;
	} else if (ritorno == '' || ritorno == 'undefined') {
		alert('Il campo DataRitorno è obbligatorio.');
		document.offer.ritorno.focus();
		return false;
	} else if (country == 'Scegli_la_Nazione') {
		alert('La Nazione di destinazione deve essere inserita');
		document.offer.country.focus();
		return false;
	} else if (titolo == '' || titolo == 'undefined') {
		alert('Il campo Titolo è obbligatorio.');
		document.offer.titolo.focus();
		return false;
	} else if (descrizione == '' || descrizione == 'undefined') {
		alert('Il campo descrizione è obbligatorio.');
		document.offer.descrizione.focus();
		return false;
	} else if (immagine == '' || immagine == 'undefined') {
		alert('Il campo immagine è obbligatorio.');
		document.offer.immagine.focus();
		return false;
	} else if (partenza_data > ritorno_data) {
		alert('La data di ritono deve essere successiva a quella di partenza');
		document.offer.ritorno.focus();
		return false;
	} else {
		document.offer.action = './offercontrol.php';
		document.offer.submit();
	}
}
