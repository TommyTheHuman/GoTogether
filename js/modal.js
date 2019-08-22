var modalBtn = document.getElementsByClassName('openmodal');
var modalElement = document.getElementById('modal');
var modalBoxContent = document.querySelector('.modal .modal__innerContent');
var formCambioImm =
	'<div class="cambioimmagine"><form action="./php/imageupload.php" name="mio_form" method="post" enctype="multipart/form-data"><fieldset name="myData"><legend>Dati personali</legend><div><label>immagine:<br/><input name="file" type="file"><br/></label></div><br/><div id="form_right"><div id="buttons"><span>Pulsanti:</span><br/>><input name="invio" value="INVIA" type="submit">&nbsp;</div></div></fieldset></form></div>';

addModalListeners();

function addModalListeners() {
	for (var i = 0; i < modalBtn.length; i++) {
		modalBtn[i].addEventListener('click', activeModalBtn);
	};
}

function activeModalBtn() {
	modalElement.classList.toggle('visible');
	document.querySelector('body').classList.toggle('preventScroll');
	modalBoxContent.innerHTML = formCambioImm;
}


