var btnSrc = document.getElementById("subNazione");
var cancelEl = document.getElementsByClassName("cancella");
var i = 0;
var subNazione = document.getElementById('subNazione');
var DeleteSearch = document.getElementById("DeleteSearch");
var minimo = 0;
var massimo = 10;
var RicercaPrecedente = {
	'searchNazione': "",
	'maxPrice': "",
	'searchCitta': "",
	'searchmesepart': "",
	'searchmesearr': "",
	'inferiorlimit': minimo,
	'superiorlimit': massimo 
};
var cardLoader = '';

var isScrolling;

function setEvent(){
	window.addEventListener('scroll', function ( event ) {
		// Clear our timeout throughout the scroll
		window.clearTimeout( isScrolling );
		// Set a timeout to run after scrolling ends
		isScrolling = setTimeout(function() {
			// Run the callback
			if (cardLoader) {
				checkCardPosition();
			}
		}, 66);
	}, false);
}


function checkCardPosition() {
	var cardHeight = cardLoader.offsetTop;
	var offset = document.documentElement.scrollTop + window.innerHeight;
	if (cardHeight <= offset){
		cardLoader.removeAttribute("class");
		cardLoader.setAttribute('class', 'ricerca card');
		cerca();
		cardLoader = document.getElementsByClassName('card--loader')[0];
	}
} 

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
subNazione.addEventListener("click", setEvent);

function aggiungi(){
	window.addEventListener('scroll', scrolla);
}

function populateData(
	searchNazioneValueCreator,
	searchMaxPriceValueCreator,
	searchCittaValueCreator,
	searchMesePartenzaCreator,
	searchMesearrivoCreator,
	minimoCreator,
	massimoCreator
) {
	var dataCreator = {
		'searchNazione': searchNazioneValueCreator,
		'maxPrice': searchMaxPriceValueCreator,
		'searchCitta': searchCittaValueCreator,
		'searchmesepart': searchMesePartenzaCreator,
		'searchmesearr': searchMesearrivoCreator,
		'inferiorlimit': minimoCreator,
		'superiorlimit': massimoCreator
	};

	return dataCreator;

}

function cerca() {
    console.log('Function "cerca" working...');
	cancella();
	
	var searchNazioneValue = document.getElementById('searchNazione').value;
	var searchMaxPriceValue = document.getElementById('MaxPrice').value;
	var searchCittaValue = document.getElementById('searchCitta').value;
	var searchMesePartenza = document.getElementById('Mese_partenza').value;
	var searchMesearriv = document.getElementById('Mese_arrivo').value;
    		
	var data = populateData(
		searchNazioneValue,
		searchMaxPriceValue,
		searchCittaValue,
		searchMesePartenza,
		searchMesearriv,
		minimo,
		massimo
	);

		if ((data.searchNazione != RicercaPrecedente.searchNazione) || (data.maxPrice != RicercaPrecedente.maxPrice) || (data.searchCitta != RicercaPrecedente.searchCitta) || (data.searchmesepart != RicercaPrecedente.searchmesepart) || (data.searchMesearrivo != RicercaPrecedente.searchMesearrivo)){
			clearBox();
			minimo = 0;
			var data = populateData(
				searchNazioneValue,
				searchMaxPriceValue,
				searchCittaValue,
				searchMesePartenza,
				searchMesearriv,
				minimo,
				massimo
			);
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
                //console.log('Response 200: ' + xhr.responseText);
				var requestResponse = xhr.responseText;
				if (requestResponse == '') {
					window.removeEventListener('scroll', scrolla);
				}
                document.getElementById('print').innerHTML = document.getElementById('print').innerHTML + requestResponse;
				cancella();
				minimo += massimo;
				cardLoader = document.getElementsByClassName(
						'card--loader'
					)[0];
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
