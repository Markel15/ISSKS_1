<?php
// Datu-basearekin konexioa duen fitxategia
include 'config.php';

function pasahitzaEgokiaDa() {
    // Aldagaiak hartu
    global $erabiltzailea, $pasahitza, $konexioa;
    // Erabiltzailea bilatu datu-basean
    // Kontsulta prestatua sortu
    $stmt = $konexioa->prepare("SELECT * FROM ERABILTZAILEA WHERE Izena = ?");
    // Erabiltzaile izena parametro gisa lotu
    $stmt->bind_param("s", $erabiltzailea);
    // Kontsulta exekutatu
    $stmt->execute();
    // Emaitzak lortu
    $datuak = $stmt->get_result();

    if ($datuak) {
        if ($datuak->num_rows == 1) {
            $fila = $datuak->fetch_assoc();
            $gordetakoPasahitza = $fila['Pasahitza'];

            // Pasahitza egokia dela egiaztatu
            if ($pasahitza == $gordetakoPasahitza) {
                // Pasahitza egokia da
                session_start();
		$_SESSION['erabiltzailea'] = $erabiltzailea; //Sesioa hasi, beste orrietan erabiltzailea lortzeko
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
        echo "Errorea kontsultan: " . $konexioa->error;
    }
}

// Datu-basearekin konexioa sortu
$konexioa = konektatuDatuBasera();
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
