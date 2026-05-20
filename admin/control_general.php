<?php
require '../db.php';

$sql = "SELECT a.nombre AS atraccion, v.hora, vj.edad 
        FROM viaje v
        JOIN atraccion a ON v.id_atraccion = a.id
        JOIN viajero vj ON v.id_viajero = vj.id
        ORDER BY a.nombre, v.hora";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control General - Admin NavaPark2</title>
</head>
<body>
    <h1>Control General del Parque</h1>

    <table border="1" cellpadding="8">
        <tr>
            <th>Atracción</th>
            <th>Hora del viaje</th>
            <th>Edad del viajero</th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= $fila['atraccion'] ?></td>
            <td><?= $fila['hora'] ?></td>
            <td><?= $fila['edad'] ?> años</td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="atracciones_listar.php">Gestionar atracciones</a>
</body>
</html>