<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$base = "plumbing";

$conexion = new mysqli($servidor, $usuario, $clave, $base);

if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}

if (isset($_POST["registrar"])) {

    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $contraseña = $_POST["contraseña"];

    $insertar = "INSERT INTO empleados (nombre, telefono, email, contraseña) VALUES ("$nombre", "$telefono", "$email", "$contraseña")";
    
    $resultado = mysqli_query($conexion,$insertar);

    if ($resultado) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar"
    }

    $insertar->close();
}

$conexion->close();

?>
