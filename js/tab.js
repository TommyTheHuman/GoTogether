var tabBtn = document.getElementsByClassName('tablinks');
var tabContent = document.getElementsByClassName('tabcontent');

addTabListeners();

function addTabListeners() {
	for (var i = 0; i < tabBtn.length; i++) {
		tabBtn[i].addEventListener('click', activeTabBtn);
	}
}

function activeTabBtn(){
	if (this.classList.contains('active') == false) {
		for (var i = 0; i < tabBtn.length; i++) {
			tabBtn[i].classList.toggle('active');
			openTab(i);
		}
	}
}

function openTab(valTab) {
	tabContent[valTab].classList.toggle('visible');;
}