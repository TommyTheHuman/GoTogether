function controllo() {
    var name = document.registrazione.name.value;
    var surname = document.registrazione.surname.value;
    var password = document.registrazione.password.value;
    var repassword = document.registrazione.repassword.value;
    var birthDate = document.registrazione.birthDate.value;
    var email = document.registrazione.email.value;
    var maschio = document.registrazione.Sesso.value;
    var femmina = document.registrazione.Sesso.value;
    var email_reg_exp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
    if ((name == "") || (name == "undefined")) {
        alert("Il campo Nome è obbligatorio.");
        document.registrazione.name.focus();
        return false;
    } else if ((surname == "") || (surname == "undefined")) {
        alert("Il campo surname è obbligatorio.");
        document.registrazione.surname.focus();
        return false;
    } else if ((password == "") || (password == "undefined")) {
        alert("Il campo Password è obbligatorio.");
        document.registrazione.password.focus();
        return false;
    } else if ((repassword == "") || (repassword == "undefined")) {
        alert("Il campo repassword password è obbligatorio.");
        document.registrazione.repassword.focus();
        return false;
    } else if (password != repassword) {
        alert("La password repasswordta è diversa da quella scelta, controllare.");
        document.registrazione.repassword.value = "";
        document.registrazione.repassword.focus();
        return false;
    } else if (birthDate == "") {
        alert("La Data di nasciata deve essere inserita");
        document.registrazione.birthDate.focus();
        return false;
    } else if (!email_reg_exp.test(email) || (email == "") || (email == "undefined")) {
        alert("Inserire un indirizzo email corretto.");
        document.registrazione.email.select();
        return false;
    }else if (maschio == "" && femmina == "") {
        alert("Inserire Il sesso");
        document.registrazione.Sesso.select();
        return false;
    } else {
        document.registrazione.action = "../php/registercontrol.php";
        document.registrazione.submit();
    }

}
