<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$base = "plumbing";

$conexion = new mysqli($servidor,$usuario,$clave,$base);

$nombre=$_POST["nombre"];
$telefono=$_POST["telefono"];
$email=$_POST["email"];
$contraseña=$_POST["contraseña"];

if(isset($_POST["registrar"])) {
$insertar="INSERT INTO empleados (nombre, telefono, email, contraseña) VALUES("$nombre","$telefono","$email","$contraseña")";
$sql=mysqli_query($conexion,$insertar);
}
?>