<?php

include 'config.php';

// Datu-basearekin konexioa ezarri
$konexioa = konektatuDatuBasera();

// Datuak datu-basean sartzeko funtzioa
function datuakSartu($titulua, $autorea, $generoa, $prezioa, $isbn, $konexioa) {
    $sql = "INSERT INTO LIBURUA (Titulua, Autorea, Generoa, Prezioa, ISBN)
            VALUES ('$titulua', '$autorea', '$generoa', $prezioa, '$isbn')";

    if ($konexioa->query($sql) === TRUE) {
        echo "Datuak ongi gorde dira.";
    } else {
        echo "Errorea datuak gordetzean: " . $konexioa->error;
    }
}

// Formularioa bidali den edo ez egiaztatu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formularioaren datuak jaso
    $titulua = $_POST['izenburua'];
    $autorea = $_POST['egilea'];
    $generoa = $_POST['generoa'];
    $prezioa = $_POST['prezioa'];
    $isbn = $_POST['isbn'];

    // Balidazioa ondo egin bada, datuak datu-basean sartu
    datuakSartu($titulua, $autorea, $generoa, $prezioa, $isbn, $konexioa);
}

// Resto del código: Aquí puedes agregar otras partes de tu aplicación
// como consultas a la base de datos, mostrar resultados, etc.

// Datu-basearen konexioa itxi
$konexioa->close();
?>
