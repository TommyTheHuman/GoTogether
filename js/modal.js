var modalBtn = document.getElementsByClassName('openmodal');
var modalElement = document.getElementById('modal');
var modalBoxContent = document.querySelector('.modal .modal__innerContent');
var formCambioImm =
	'<div class="cambioimmagine"> <form action="./php/imageupload.php" name="mio_form" method="post" enctype="multipart/form-data"> <div><label class="upload" for="file_upload">Cambia Immagine Del Profilo<br /></label><input id="file_upload" name="file" type="file"><br /></div><br /> <div id="buttons"><br /><input name="invio" value="INVIA" type="submit"></div> </form> </div><div class="cambiopassword"><form action="./php/passwordreset.php" name="mio_form" method="post" enctype="multipart/form-data"><div><label>Vecchia Password<br /></label><br><input name="vecchiapass" id="vecchiapass" type="password"><br /><label>Nuova Password<br /></label><br><input name="nuovapass" id="nuovapass" type="password"><br /></div><br />	<div id="button_pass"><br /><input name="invio" value="CambiaPassword" type="submit"></div></form></div>';

addModalListeners();

function addModalListeners() {
	for (var i = 0; i < modalBtn.length; i++) {
		modalBtn[i].addEventListener('click', activeModalBtn);
	}
}

function activeModalBtn() {
	modalElement.classList.toggle('visible');
	document.querySelector('body').classList.toggle('preventScroll');
	modalBoxContent.innerHTML = formCambioImm;
}