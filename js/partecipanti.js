var partecipanti = document.getElementsByClassName("partecipanti");
var modalBoxContent = document.querySelector('.modal .modal__innerContent');
var modalElement = document.getElementById('modal');

for (var i = 0; i < partecipanti.length; i++) {
	partecipanti[i].addEventListener('click', modalPartecipanti);
};

function modalPartecipanti() {
	getPartecipanti(this);
	modalElement.classList.toggle('visible');
	document.querySelector('body').classList.toggle('preventScroll');
	console.log('partecipanti presi');
}

function getPartecipanti(elementoPartecipanti) {
	var idPartecipante = elementoPartecipanti.getAttribute('id');
	var xhr = new XMLHttpRequest();
	var urlToSend = './php/partecipanti.php';
	xhr.open('POST', urlToSend, true);
	xhr.send(idPartecipante);
	xhr.onload = function() {
		// Process our return data
		if (xhr.readyState === 4 && xhr.status === 200) {
			console.log('Response 200: ' + xhr.responseText);
			var requestResponse = xhr.responseText;
			modalBoxContent.innerHTML = requestResponse;
		} else {
			console.log('The request failed!');
		}
	};
	
};