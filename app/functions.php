<?php
// Datu-basearekin konexioa duen fitxategia
include 'config.php';
ini_set('session.use_only_cookies',1);//Bakarrik baimendu session_id-ren erabilpena cookien bitartez eta ez URL-ren bidez
ini_set('session.use_strict_mode',1);//Baimendu bakarrik erabiltzen gure zerbitzariak sortutako saio identifikatzaileak
ini_set('session.cookie_httponly',1);
ini_set('session.hash_function','sha256');//Aldatu hash algoritmoa seguruagoa den batekin, defektuz MD5 da.
session_set_cookie_params(300,'/','localhost',false,true);//5 minutuko cookie-aren lifetime-a, cookie-ak lan egingo duen path-a '/' erabilita domeinuaren path guztiak dira, cookie-aren domeinua, secure modua false-n bestela ez da funtzionatuko gure web orria http-n dabilelako bakarrik, true httponly ez uzteko script-en bidez gure cookie-tara heltzea.
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
            $gordetakoPasahitza = $fila['Pasahitza_hash'];
            // Pasahitza egokia dela egiaztatu
            if (password_verify($pasahitza, $gordetakoPasahitza)) {
                // Pasahitza egokia da
                session_start();
                session_regenerate_id(true);
		$_SESSION['erabiltzailea'] = $erabiltzailea; //Saioa hasi, beste orrietan erabiltzailea lortzeko
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
        echo "Errorea kontsultan";
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
