<?php

include 'config.php';

// Datu-basearekin konexioa ezarri
$konexioa = konektatuDatuBasera();

// Datuak datu-basean sartzeko funtzioa
function datuakSartu($titulua, $autorea, $generoa, $prezioa, $isbn, $konexioa) {
    $sql = "INSERT INTO LIBURUA (Titulua, Autorea, Generoa, Prezioa, ISBN)
            VALUES ('$titulua', '$autorea', '$generoa', $prezioa, '$isbn')";

    if ($konexioa->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Errorea datuak gordetzean: " . $konexioa->error;
    }
}

function datuakAldatu($titulua, $autorea, $generoa, $prezioa, $isbn, $isbnAurrekoa, $konexioa) {
    $sql = "UPDATE LIBURUA
            SET Titulua='$titulua', Autorea='$autorea', Generoa='$generoa', Prezioa=$prezioa, ISBN='$isbn'
            WHERE ISBN = '$isbnAurrekoa'";

    if ($konexioa->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Errorea datuak gordetzean: " . $konexioa->error;
    }
}

function liburuaEzabatu($isbn, $konexioa){
    $sql = "DELETE FROM LIBURUA
            WHERE ISBN = '$isbn'";
    echo $sql;

    if ($konexioa->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Errorea datuak gordetzean: " . $konexioa->error;
    }
}

// Formularioa bidali den edo ez egiaztatu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $akzioa = $_POST["akzioa"];
    if ($akzioa === "gehitu") {
        // Formularioaren datuak jaso
        $titulua = $_POST['izenburua'];
        $autorea = $_POST['egilea'];
        $generoa = $_POST['generoa'];
        $prezioa = $_POST['prezioa'];
        $isbn = $_POST['isbn'];

        // Balidazioa ondo egin bada, datuak datu-basean sartu
        datuakSartu($titulua, $autorea, $generoa, $prezioa, $isbn, $konexioa);
    }
    elseif ($akzioa === "editatu") {
        // Procesar datos del segundo formulario
        $titulua = $_POST['izenburua'];
        $autorea = $_POST['egilea'];
        $generoa = $_POST['generoa'];
        $prezioa = $_POST['prezioa'];
        $isbn = $_POST['isbn'];
        $isbnAurrekoa = $_POST['isbnAurrekoa'];

        datuakAldatu($titulua, $autorea, $generoa, $prezioa, $isbn, $isbnAurrekoa, $konexioa);
    }
}
elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Obtén el ISBN de la solicitud DELETE
    $isbn = $_GET['isbn'];

    liburuaEzabatu($isbn, $konexioa);
} 

// Resto del código: Aquí puedes agregar otras partes de tu aplicación
// como consultas a la base de datos, mostrar resultados, etc.

// Datu-basearen konexioa itxi
$konexioa->close();
?>
