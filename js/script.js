// Saioa hasteko datuak egiaztatzeko funtzioa
function ahalBadaSaioaSartu(erabiltzailea, pasahitza) {
    // Erabiltzaile izenaren eta pasahitzaren zuzentasuna egiaztatzen du
    if (erabiltzailea === "admin" && pasahitza === "admin") {
        return true; // Saioa hasi da
    }
    else {
        return false; // Erabiltzaile izena edo pasahitza ez da zuzena
    }
}

// Formularioa bidaltzeko funtzioa
function saioanSartu() {

    // Formularioko erabiltzaile izena eta pasahitza lortzen ditu
    const erabiltzailea = document.getElementById("erabiltzailea").value;
    const pasahitza = document.getElementById("pasahitza").value;

    // Saioa egiaztatzen du
    if (ahalBadaSaioaSartu(erabiltzailea, pasahitza)) {
        window.location.href = "main.html";
    }
    else {
        alert("Ez zara saioan sartu");
    }
}

// Formularioa lortu eta bidalketa ekitaldi bat gehitu
var login_botoia = document.getElementById("login_botoia");
login_botoia.addEventListener("click", saioanSartu);
