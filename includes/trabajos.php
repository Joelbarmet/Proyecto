<?php

$servidor = "localhost";
$usuarioDb = "root";
$contraseñaDb = "";
$baseDeDatos = "plumbing";

$conexion = new mysqli($servidor, $usuarioDb, $contraseñaDb, $baseDeDatos);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$consulta = "SELECT t.id, c.nombre AS nombre_cliente, e.nombre AS nombre_empleado, s.nombre AS nombre_servicio, t.tipo, t.fecha, t.estado
             FROM trabajos t
             JOIN clientes c ON t.id_cliente = c.id
             JOIN empleados e ON t.id_empleado = e.id
             JOIN servicios s ON t.id_servicio= s.id";

$resultado = $conexion->query($consulta);

if ($resultado->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Cliente</th><th>Emlpeado</th><th>Sevicio</th><th>Tipo</th><th>Fecha</th><th>Estado</th></tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['nombre_cliente'] . "</td>";
        echo "<td>" . $fila['nombre_empleado'] . "</td>";
        echo "<td>" . $fila['nombre_servicio'] . "</td>";
        echo "<td>" . $fila['tipo'] . "</td>";
        echo "<td>" . $fila['fecha'] . "</td>";
        echo "<td>" . $fila['estado'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No hay resultados en la tabla.";
}

$conexion->close();
?>
