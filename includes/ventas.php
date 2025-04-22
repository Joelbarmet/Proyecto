<?php

$servidor = "localhost";
$usuarioDb = "root";
$contraseñaDb = "";
$baseDeDatos = "plumbing";

$conexion = new mysqli($servidor, $usuarioDb, $contraseñaDb, $baseDeDatos);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$consulta = "SELECT v.id, c.nombre AS nombre_cliente, v.fecha, v.total
             FROM ventas v
             JOIN clientes c ON v.id_cliente = c.id";

$resultado = $conexion->query($consulta);

if ($resultado->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Cliente</th><th>Fecha</th><th>Total</th></tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['nombre_cliente'] . "</td>";
        echo "<td>" . $fila['fecha'] . "</td>";
        echo "<td>" . $fila['total'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No hay resultados en la tabla.";
}

$conexion->close();
?>
