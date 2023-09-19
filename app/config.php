<?php
// Datos de configuración de la base de datos
function conectarBaseDeDatos() {
    $db_host = 'db';
    $db_user = 'admin';
    $db_pass = 'test';
    $db_name = 'database';

    // Conexión a la base de datos
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // Verificar la conexión
    if (!$conn) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    return $conn;
}
?>