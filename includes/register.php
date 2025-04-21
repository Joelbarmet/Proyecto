<?php

$servidor = "localhost";
$usuario = "root";
$contraseñaBD = "";
$base = "plumbing";

$conexion = new mysqli($servidor, $usuario, $contraseñaBD, $base);

if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}

if (isset($_POST["registrar"])) {

    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

    $consulta = $conexion->prepare("INSERT INTO empleados (nombre, usuario, telefono, email, contraseña) VALUES (?, ?, ?, ?, ?)");
    $consulta->bind_param("sssss", $nombre, $usuario, $telefono, $email, $contraseña);

    if ($consulta->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar: " . $consulta->error;
    }

    $consulta->close();
}

$conexion->close();

?>
