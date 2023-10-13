<?php
// Datu-basearen konfigurazioa
function konektatuDatuBasera() {
    $db_hosta = 'db';
    $db_erabiltzaile = 'admin';
    $db_pasahitza = 'test';
    $db_izena = 'database';

    // Datu-basearekin konekzioa
    $konekzioa = mysqli_connect($db_hosta, $db_erabiltzaile, $db_pasahitza, $db_izena);

    // Konekzioa egiaztatu    
    if (!$konekzioa) {
        die("Datu-basearekin konekzioan errorea: " . mysqli_connect_error());
    }
    return $konekzioa;
}
?>