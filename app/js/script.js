function bordeGorriaIpiniKendu(ipini) {
    if (ipini) {
        // Borde gorria ipini
        erabiltzailea_hutsune.classList.remove("borde_ez");
        erabiltzailea_hutsune.classList.add("borde_gorria");
        pasahitza_hutsune.classList.remove("borde_ez");
        pasahitza_hutsune.classList.add("borde_gorria");
    }
    else {
        // Borde gorria ipini
        erabiltzailea_hutsune.classList.remove("borde_gorria");
        erabiltzailea_hutsune.classList.add("borde_ez");
        pasahitza_hutsune.classList.remove("borde_gorria");
        pasahitza_hutsune.classList.add("borde_ez");
    }
}


// Saioa hasteko datuak egiaztatzeko funtzioa
function hutsikDago(erabiltzailea, pasahitza) {
    // Erabiltzaile izenaren eta pasahitzaren zuzentasuna egiaztatzen du
    
    if (erabiltzailea.trim() === "" || pasahitza.trim() === "" ) {
        // Hutsunea hutsik dago, borde gorria ipini
        console.log("1");
        bordeGorriaIpiniKendu(true);
        return true;
    }
    else {
        // Hutsunea ez dago hutsik, borde gorria kendu
        console.log("2");
        bordeGorriaIpiniKendu(false);
        return false;
    }
}

// Formularioa bidaltzeko funtzioa
function saioanSartu() {
    event.preventDefault();
    // Formularioko erabiltzaile izena eta pasahitza lortzen ditu
    const erabiltzailea = document.getElementById("erabiltzailea").value;
    const pasahitza = document.getElementById("pasahitza").value;
    // Saioa egiaztatzen du
    if (!hutsikDago(erabiltzailea, pasahitza)) {
        // console.log("Funtzioa exekutatzen da");
        var data = "erabiltzailea=" + encodeURIComponent(erabiltzailea) + "&pasahitza=" + encodeURIComponent(pasahitza);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "functions.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var erantzuna = JSON.parse(xhr.responseText);
                if (erantzuna.emaitza === true) {
                    // Erabiltzaile eta pasahitza egokiak
                    window.location.href = "aldatu.php";
                } else {
                    // Erabiltzaile eta pasahitza ez egokiak
                    bordeGorriaIpiniKendu(true);
                }
                console.log(xhr.responseText);
            }
        };
        xhr.send(data);
    }
    else {
        //Ez duzu erabiltzailea edo pasahitza sartu
    }
}

function iEmanOrrira(){
	event.preventDefault();
	window.location.href = "sign_form.php";
}

function izenaEman(){
    var data = Date.parse(document.getElementById("JaioData").value.toString());
    var emaitza=true;
    if(isNaN(data)){//konprobatu sartutako data baliozkoa den ala ez
        alert("Ezarritako datak ez du balio");
        emaitza=false;
    }
    if(nanKonprobatu()==false){
        alert("Idatzitako NAN-a ez da egokia, hizkiak ez du zenbakiekin bat egiten");
        emaitza=false;
    }
    if(emaitza==false){//Ez badira baldintzak betetzen ez bidali informazioa
        event.preventDefault();
    }
}
function nanKonprobatu(){
    var nan = document.getElementById("NAN").value.toString();
    if(nan.trim() === ""){//Konprobatu NAN hutsik ez dagoela
        return false;
    }
    else{
	var zenb = nan.substring(0,8);
	var hizkia = nan.substring(9,10);
	var kode = "TRWAGMYFPDXBNJZSQVHLCKE";
	var emaitza = kode.charAt(zenb % 23);
	if(emaitza != hizkia){
	    return false;
	}
	else{
	    return true;
	}
    }
}

// Formularioa lortu eta bidalketa ekitaldi bat gehitu
const erabiltzailea_hutsune = document.getElementById("erabiltzailea");
const pasahitza_hutsune = document.getElementById("pasahitza");
var login_botoia = document.getElementById("login_botoia");
var signup_botoia = document.getElementById("signup_botoia");
var sign_botoia = document.getElementById("iz_em_bot");
if (login_botoia) {
    // Konprobatu elementua existitzen dela orri honetan, bestela errorea ematen du
    login_botoia.addEventListener("click", saioanSartu);
}
if (signup_botoia) {
    signup_botoia.addEventListener("click", iEmanOrrira);
}
if (sign_botoia){
    sign_botoia.addEventListener("click",izenaEman);
}
