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
        die("Datu-basearekin konexioan errorea: " . mysqli_connect_error());
    }
    return $konekzioa;
}
function sortuMysqli(){
    
    //mysqli objektua sortu
    $mysqli = new mysqli('db', 'admin', 'test', 'database');
    //Konprobatu konexioa
    if($mysqli->connect_error) {
    	die("Konexioan errorea : " . $mysqli->connect_error);
    }
    return $mysqli;
}
?>
