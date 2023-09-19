<?php
include 'config.php';

$conexion = conectarBaseDeDatos();

$erabiltzailea = $_POST['erabiltzailea'];
$pasahitza = $_POST['pasahitza'];


$query = "SELECT * FROM ERABILTZAILEA WHERE Izena = '$erabiltzailea'";

$result = $conexion->query($query);

if ($result) {
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $gordetakoPasahitza = $row['pasahitza'];

        // Verificar la contraseña
        if (password_verify($pasahitza, $gordetakoPasahitza)) {
            // La contraseña es correcta, puedes continuar con la lógica deseada
            echo "Inicio de sesión exitoso";
        } else {
            echo "La contraseña es incorrecta";
        }
    } else {
        echo "Nombre de usuario no encontrado";
    }

    $result->close();
} else {
    echo "Error en la consulta: " . $conexion->error;
}
?>
