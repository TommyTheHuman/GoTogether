function min_date() {
	var time = Date.now();
	var fortnightAway = new Date(time + 2628e6);
	var dd = ('0' + fortnightAway.getDate()).slice(-2);
	var mm = ('0' + (fortnightAway.getMonth() + 1)).slice(-2);
	var yyyy = fortnightAway.getFullYear();
	var dataok = yyyy + '-' + mm + '-' + dd;
	document.offer.partenza.setAttribute('min', dataok);
}
window.onLoad = min_date();
window.onLoad = min_return_date();

function min_return_date() {
	var time = Date.now();
	var fortnightAway = new Date(time + (2628e6 + 864e5));
	var dd = ('0' + fortnightAway.getDate()).slice(-2);
	var mm = ('0' + (fortnightAway.getMonth() + 1)).slice(-2);
	var yyyy = fortnightAway.getFullYear();
	var dataok = yyyy + '-' + mm + '-' + dd;
	document.offer.ritorno.setAttribute('min', dataok);
}

function controlloData() {
	var partenza = document.offer.partenza.value;
	var ritorno = document.offer.ritorno.value;
	var partenza_data = new Date(partenza);
	var ritorno_data = new Date(ritorno);

	if (partenza_data > ritorno_data) {
		alert('La data di ritono deve essere successiva a quella di partenza');
		document.offer.ritorno.focus();
		return false;
	} else {
		document.offer.action = './offercontrol.php';
		document.offer.submit();
	}
}