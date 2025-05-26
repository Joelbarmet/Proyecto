<?php

$servidor = "localhost";
$usuarioDb = "root";
$contraseñaDb = "";
$baseDeDatos = "plumbing";

session_start();

$conexion = new mysqli($servidor, $usuarioDb, $contraseñaDb, $baseDeDatos);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

if (isset($_POST["iniciar_sesion"])) {
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    $consulta = "SELECT * FROM empleados WHERE usuario = '$usuario'";

    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();

        if ($fila["contraseña"] === $contraseña) {
            $_SESSION['usuario'] = $fila["usuario"];
            $_SESSION['nombre'] = $fila["nombre"];
            
            header("Location: ../main.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}

$conexion->close();
?>
