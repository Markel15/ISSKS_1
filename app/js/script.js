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
                    window.location.href = "main.html";
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

// Formularioa lortu eta bidalketa ekitaldi bat gehitu
const erabiltzailea_hutsune = document.getElementById("erabiltzailea");
const pasahitza_hutsune = document.getElementById("pasahitza");
var login_botoia = document.getElementById("login_botoia");
login_botoia.addEventListener("click", saioanSartu);
