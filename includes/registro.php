<?php

$servidor = "localhost";
$usuarioDb = "root";
$contraseñaDb = "";
$baseDeDatos = "plumbing";

$conexion = new mysqli($servidor, $usuarioDb, $contraseñaDb, $baseDeDatos);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

if (isset($_POST["registrar"])) {

    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $contraseña = $_POST["contraseña"];

    $insertar = "INSERT INTO empleados (nombre, usuario, telefono, email, contraseña) 
    VALUES ('$nombre', '$usuario', '$telefono', '$email', '$contraseña')";

    if ($conexion->query($insertar)) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar: " . $conexion->error;
    }
}

$conexion->close();
?>
