<?php
// Datu-basearekin konekzioa duen fitxategia
include 'config.php';

function pasahitzaEgokiaDa() {
    // Aldagaiak hartu
    global $erabiltzailea, $pasahitza, $konekzioa;
    // Erabiltzailea bilatu datu-basean
    $query = "SELECT * FROM ERABILTZAILEA WHERE Izena = '$erabiltzailea'";
    $datuak = $konekzioa->query($query);

    if ($datuak) {
        if ($datuak->num_rows == 1) {
            $fila = $datuak->fetch_assoc();
            $gordetakoPasahitza = $fila['Pasahitza'];

            // Pasahitza egokia dela egiaztatu
            if ($pasahitza == $gordetakoPasahitza) {
                // Pasahitza egokia da
                return true;
            }
            else {
                // Pasahitza ez da egokia
                return false;
            }
        }
        else {
            // Erabiltzailea ez dago datu-basean
            return false;
        }
        $datuak->close();
    }
    else {
        // Konektatzerakoan errorea gertatu
        echo "Errorea kontsultan: " . $konekzioa->error;
    }
}

// Datu-basearekin konekzioa sortu
$konekzioa = konektatuDatuBasera();
// Datuak jaso
$erabiltzailea = $_POST['erabiltzailea'];
$pasahitza = $_POST['pasahitza'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Pasahitza egokia dela egiaztatu
    $emaitza = pasahitzaEgokiaDa();

    header("Content-type: application/json");
    echo json_encode(array("emaitza" => $emaitza));
}
?>