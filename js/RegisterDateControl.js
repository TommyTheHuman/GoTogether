
function current_datee(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    var today = yyyy + '-' + mm + '-' + dd;
    document.registrazione.birthDate.setAttribute("max", today);
}
window.onLoad = current_datee();
