<?php

$servidor = "localhost";
$usuarioDb = "root";
$contraseñaDb = "";
$baseDeDatos = "plumbing";

$conexion = new mysqli($servidor, $usuarioDb, $contraseñaDb, $baseDeDatos);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$consulta = "SELECT f.id, c.nombre AS nombre_cliente, f.id_trabajo, f.fecha, f.total, t.tipo AS tipo_trabajo
             FROM facturas f
             JOIN trabajos t ON f.id_trabajo = t.id
             JOIN clientes c ON f.id_cliente = c.id";

$resultado = $conexion->query($consulta);

if ($resultado->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Cliente</th><th>Tipo Trabajo</th><th>Fecha</th><th>Total</th></tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['nombre_cliente'] . "</td>";
        echo "<td>" . $fila['tipo_trabajo'] . "</td>";
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
