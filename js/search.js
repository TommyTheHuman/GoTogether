var btnSrc = document.getElementById("subNazione");
var cancelEl = document.getElementsByClassName("cancella");
var i = 0;
var subNazione = document.getElementById('subNazione');
var DeleteSearch = document.getElementById("DeleteSearch");
var minimo = 0;
var massimo = 3;
var RicercaPrecedente = {
            'searchNazione': "",
            'maxPrice': "",
            'searchCitta': "",
            'searchmesepart': "",
			'searchmesearr': "",
			'inferiorlimit': minimo,
			'superiorlimit': massimo 
};

function showButton() {
    document.getElementById("DeleteSearch").classList.add('DeleteSearch--isVisible');
    subNazione.removeEventListener("click", showButton);
}

function cancella() {
    for (i = 0; i < cancelEl.length; i++) {
        cancelEl[i].style.display = "none";
    }
}

function mostra() {
    for (i = 0; i < cancelEl.length; i++) {
        cancelEl[i].style.display = "flex";
    }
}

function clearBox() {
    document.getElementById('print').innerHTML = "";
}

function clear(){
    mostra();
    clearBox();
    DeleteSearch.classList.remove('DeleteSearch--isVisible');
}

window.onLoad = mostra();

DeleteSearch.addEventListener("click", clear)
subNazione.addEventListener("click", showButton);
subNazione.addEventListener("click", function (event) {
    event.preventDefault();
    cerca();
});
subNazione.addEventListener("click", aggiungi);

function aggiungi(){
	window.addEventListener('scroll', scrolla);
}

function scrolla(event){
	// Get the height of the entire document
    var height = document.documentElement.offsetHeight,
    // Get the current offset - how far "scrolled down"
    offset = document.documentElement.scrollTop + window.innerHeight;

    // Check if user has hit the end of page
    // console.log('Height: ' + height);
    // console.log('Offset: ' + offset);
    if (offset === height) { 
      cerca();
    }
}


function cerca() {
    console.log('Function "cerca" working...');
    cancella();
    var nazione = document.getElementById('searchNazione').value;
		
        var searchNazioneValue = document.getElementById('searchNazione').value;
        var searchMaxPriceValue = document.getElementById('MaxPrice').value;
        var searchCittaValue = document.getElementById('searchCitta').value;
        var searchMesePartenza = document.getElementById('Mese_partenza').value;
        var searchMesearrivo = document.getElementById('Mese_arrivo').value;
        var data = {
            'searchNazione': searchNazioneValue,
            'maxPrice': searchMaxPriceValue,
            'searchCitta': searchCittaValue,
            'searchmesepart': searchMesePartenza,
			'searchmesearr': searchMesearrivo,
			'inferiorlimit': minimo,
			'superiorlimit': massimo 
		};

		if ((data.searchNazione != RicercaPrecedente.searchNazione) || (data.maxPrice != RicercaPrecedente.maxPrice) || (data.searchCitta != RicercaPrecedente.searchCitta) || (data.searchmesepart != RicercaPrecedente.searchmesepart) || (data.searchMesearrivo != RicercaPrecedente.searchMesearrivo)){
			clearBox();
			console.log("ok");
			minimo = 0;
			var data = {
				'searchNazione': searchNazioneValue,
				'maxPrice': searchMaxPriceValue,
				'searchCitta': searchCittaValue,
				'searchmesepart': searchMesePartenza,
				'searchmesearr': searchMesearrivo,
				'inferiorlimit': minimo,
				'superiorlimit': massimo 
			};
		}
		RicercaPrecedente = data;
		var xhr = new XMLHttpRequest();
        var urlToSend = './php/search.php';
        xhr.open('POST', urlToSend, true);
        xhr.setRequestHeader("Content-type", "application/json");
        console.log(data);
		xhr.send(JSON.stringify(data));

        // gestisco la risposta
        xhr.onreadystatechange = function () {

            // Process our return data
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Response 200: ' + xhr.responseText);
				var requestResponse = xhr.responseText;
				if (requestResponse == '') {
					window.removeEventListener('scroll', scrolla);
				}
                document.getElementById('print').innerHTML = document.getElementById('print').innerHTML + requestResponse;
				cancella();
				minimo += massimo;
            } else {
                // This will run when it's not
                console.log('Service temporarly unavaible');
            }

        };

  

};

function current_date() {
    var time = Date.now();
    var fortnightAway = new Date(time + 12096e5);
    var dd = ("0" + fortnightAway.getDate()).slice(-2);
    var mm = ("0" + (fortnightAway.getMonth() + 1)).slice(-2);
    var yyyy = fortnightAway.getFullYear();
    var dataok= yyyy + '-' + mm + '-' + dd;
    document.filtro.Mese_partenza.setAttribute("min", dataok);
}
function max_date(){
    var max_date = new Date();
    var dd = max_date.getDate();
    var mm = max_date.getMonth() + 1; //January is 0!

    var yyyy = max_date.getFullYear() + 1;
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    var max_date = yyyy + '-' + mm + '-' + dd;
    document.filtro.Mese_partenza.setAttribute("max", max_date);
};
window.onLoad = current_date();
window.onLoad = max_date();
