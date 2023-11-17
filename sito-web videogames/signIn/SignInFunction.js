function controlloUsername(event) {
    var eU = document.getElementById("eU");
    eU.style = "display:none";

    var Cs = document.getElementById("cS");
    var tasto;
    tasto = event.key;
    if ((tasto == "Delete") || (tasto == "Enter") || (tasto == "Backspace") || (tasto == "Shift") || (tasto == "CapsLock") || (tasto == "Tab")) {
        Cs.style = "display:none";
        return true;
    } else if ((("0123456789qazwsxedcrfvtgbyhnujmkilopQAZWSXEDCRFVTGBYHNUJMIKLOP._-").indexOf(tasto) > -1)) {
        Cs.style = "display:none";
        return true;
    } else {
        Cs.style = "display:inline";
        Cs.innerHTML = "L'username non pu&ograve; contenere spazi e caratteri speciali eccetto - _ .";
        return false;
    }
}

function controlloEmail() {
    var eE = document.getElementById("eE");
    eE.style = "display:none";
}

function controlloLunghezzaUsername() {
    var username = document.getElementById("username").value;
    var mL = document.getElementById("mL");
    var x = 0;
    for (i = 0; i <= username.length; i++) {
        var tasto = username[i];
        if ((("qazwsxedcrfvtgbyhnujmkilopQAZWSXEDCRFVTGBYHNUJMIKLOP").indexOf(tasto) > -1)) {
            x = x + 1;
        }
    }
    if (x < 4 && (username != "")) {
        mL.style = "display:inline";
        mL.innerHTML = "L'username deve contenere minimo di 4 lettere alfabetiche"
        return false;
    }
    mL.style = "display:none";
    return true;
}

function soloCaratteri(evento, nc) {
    var tasto;
    var nomeCognome = document.getElementById(nc);
    tasto = evento.key;
    if ((tasto == "Delete") || (tasto == "Enter") || (tasto == "Backspace") || (tasto == "Shift") || (tasto == "CapsLock") || (tasto == "Tab")) {
        return true;
    } if ((("qazwsxedcrfvtgbyhnujmkilop").indexOf(tasto) > -1)) {
        nomeCognome.style = "display:none";
        return true;
    }
    if ((("QAZWSXEDCRFVTGBYHNUJMIKLOP").indexOf(tasto) > -1)) {
        nomeCognome.style = "display:none";
        return true;
    }
    else {
        nomeCognome.style = "display:inline";
        nomeCognome.innerHTML = "Deve contenere solo caratteri"
        return false;

    }
}

function controlloPassword() {
    var a = false;
    var b = false;
    var c = false;
    var d = false;
    var pC1 = document.getElementById("pC1");
    pC1.style = "display:inline";
    var password = document.getElementById('password').value;
    for (i = 0; i <= password.length; i++) {
        var tasto = password[i];

        if ((("0123456789").indexOf(tasto) > -1)) {
            a = true;
        }

        if ((("qazwsxedcrfvtgbyhnujmkilop").indexOf(tasto) > -1)) {
            b = true;
        }

        if ((("QAZWSXEDCRFVTGBYHNUJMIKLOP").indexOf(tasto) > -1)) {
            c = true;
        }

        if ((("$?%^&*()_-+=@~#. '").indexOf(tasto) > -1)) {
            d = true;
        }
    }
    if (a && b && c && d && (i >= 8)) {
        pC1.innerHTML = "password efficace";
        pC1.style.removeProperty("color");
        pC1.style.setProperty("color", "green", null);
        return true;

    }
    else {
        pC1.innerHTML = "password minimo di 8 caratteri (massimo 24). Almeno un carattere speciale tra $ . ? % ^ & * ( ) _ - + = @ ~ # ' una lettera minuscola, una lettera maiuscola, un numero"
        pC1.style.removeProperty("color");
        pC1.style.setProperty("color", "red", null);
        return false;
    }

}


function verificaPassword() {
    var password = document.getElementById("password").value;
    var vpassword = document.getElementById("vpassword").value;
    var pC2 = document.getElementById("pC2");

    if ((vpassword == "")) {
        pC2.style = "display:none";
        return false;
    }

    if (password != vpassword) {
        pC2.innerHTML = "Le password non corrispondono";
        pC2.style = "display:inline";
        return false
    }
    pC2.innerHTML = "Le password corrispondono";
    pC2.style = "display:inline";
    pC2.style.removeProperty("color");
    pC2.style.setProperty("color", "green", null);
    return true;
}

function calcAge() {
    var dC = document.getElementById("dC");
    dC.style = "display:none";
    var compleanno = document.getElementById('data').value;
    var compleanno = compleanno.split('-');
    var oggi = new Date();
    var giorno = oggi.getDate();
    var mese = oggi.getMonth() + 1;
    var anno = oggi.getFullYear();
    var giorno2 = compleanno[2];
    var mese2 = compleanno[1] - 1;
    var anno2 = compleanno[0];
    if (anno2 <= (anno - 18)) {
        if ((anno - 18) == anno2) {
            if (mese2 <= mese) {
                if (mese == mese) {
                    if (giorno2 <= giorno) {
                        return true;
                    }
                }
                return true;
            }
        }

        return true;
    }
    else {
        dC.style = "display:inline";
        dC.innerHTML = "Solo i maggiori di 18 anni possono registrarsi";
        return false;
    }
}


function attivaRegistrazione() {
    var form = document.getElementById("registrazione");
    if (!(verificaPassword() && controlloPassword() && calcAge() && controlloLunghezzaUsername())) {
        form.style.setProperty("border", "solid red 3px");
        return false;
    }
    form.removeProperty("border");
    return true;
}

function pValoreEsistente(id, valore) {
    var val = document.getElementById(id);
    val.style = "display:inline";
    val.innerHTML = " " + valore + " è già in uso.";
}

function mostraPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
