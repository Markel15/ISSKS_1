// Saioa hasteko datuak egiaztatzeko funtzioa
function ahalBadaSaioaSartu(erabiltzailea, pasahitza) {
    // Erabiltzaile izenaren eta pasahitzaren zuzentasuna egiaztatzen du
    // if (erabiltzailea === "admin" && pasahitza === "admin") {
    //     return true; // Saioa hasi da
    // }
    // else {
    //     return false; // Erabiltzaile izena edo pasahitza ez da zuzena
    // }
    return true;
}

// Formularioa bidaltzeko funtzioa
function saioanSartu() {
    event.preventDefault();
    // Formularioko erabiltzaile izena eta pasahitza lortzen ditu
    const erabiltzailea = document.getElementById("erabiltzailea").value;
    const pasahitza = document.getElementById("pasahitza").value;

    // Saioa egiaztatzen du
    if (ahalBadaSaioaSartu(erabiltzailea, pasahitza)) {
        console.log("Funtzioa exekutatzen da");
        

        var data = "erabiltzailea=" + encodeURIComponent(erabiltzailea) + "&pasahitza=" + encodeURIComponent(pasahitza);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "functions.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                window.location.href = "main.html";
                console.log(xhr.responseText);
            }
        };
        xhr.send(data);
    }
    else {
        alert("Ez zara saioan sartu");
    }
}

// Formularioa lortu eta bidalketa ekitaldi bat gehitu
var login_botoia = document.getElementById("login_botoia");
login_botoia.addEventListener("click", saioanSartu);
