<?php
$conexion = new mysqli("localhost", "root", "", "plumbing");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
$sql = "SELECT * FROM clientes";
$resultado = $conexion->query($sql);
?>