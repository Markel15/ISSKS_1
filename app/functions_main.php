<?php

include 'config.php';

// Datu-basearekin konexioa ezarri
$konexioa = konektatuDatuBasera();

// Datuak datu-basean sartzeko funtzioa
function datuakSartu($titulua, $autorea, $generoa, $prezioa, $isbn) {
    $mysqli = sortuMysqli();
    $sql = "INSERT INTO LIBURUA (Titulua, Autorea, Generoa, Prezioa, ISBN)
            VALUES (?, ?, ?, ?, ?)";
    //mysqli prepared statement-a sortu
    $stmt = $mysqli->prepare($sql);    
    //lotu lortutako balioak ? bakoitzarekin
    $stmt->bind_param('sssds',$titulua, $autorea, $generoa, $prezioa, $isbn);//lehenengo parametroan, s datuak string motatakoak direla adierazteko eta d dezimala duten datuak.
    $stmt->execute();
    //konprobatu kontsulta ondo egin dela
    if ($stmt->affected_rows===1) {
    	$stmt->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Errorea datuak gordetzean";
    }
}

function datuakAldatu($titulua, $autorea, $generoa, $prezioa, $isbn, $isbnAurrekoa) {
    $mysqli = sortuMysqli();
    $sql = "UPDATE LIBURUA
            SET Titulua=?, Autorea=?, Generoa=?, Prezioa=?, ISBN=?
            WHERE ISBN = ?";
    $stmt =$mysqli->prepare($sql);
    $stmt->bind_param('sssdss',$titulua, $autorea, $generoa, $prezioa, $isbn,$isbnAurrekoa);
    $stmt->execute();
    if (mysqli_stmt_errno($stmt)===0){// 0 ez bada, errore bat gertatu da.
    	$stmt->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Errorea datuak gordetzean";
    }
}

function liburuaEzabatu($isbn){
    $mysqli = sortuMysqli();
    $sql = "DELETE FROM LIBURUA
            WHERE ISBN = ?";
    $stmt =$mysqli->prepare($sql);
    $stmt->bind_param('s',$isbn);
    $stmt->execute();
    if ($stmt->affected_rows===1) {
    	$stmt->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Errorea datuak gordetzean";
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
        datuakSartu($titulua, $autorea, $generoa, $prezioa, $isbn);
    }
    elseif ($akzioa === "editatu") {
        // Procesar datos del segundo formulario
        $titulua = $_POST['izenburua'];
        $autorea = $_POST['egilea'];
        $generoa = $_POST['generoa'];
        $prezioa = $_POST['prezioa'];
        $isbn = $_POST['isbn'];
        $isbnAurrekoa = $_POST['isbnAurrekoa'];

        datuakAldatu($titulua, $autorea, $generoa, $prezioa, $isbn, $isbnAurrekoa);
    }
}
elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Obtén el ISBN de la solicitud DELETE
    $isbn = $_GET['isbn'];

    liburuaEzabatu($isbn);
} 

// Resto del código: Aquí puedes agregar otras partes de tu aplicación
// como consultas a la base de datos, mostrar resultados, etc.

// Datu-basearen konexioa itxi
$konexioa->close();
?>
