<?php
require '../db.php';

$atracciones = $conn->query("SELECT * FROM atraccion ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Atracciones - Admin NavaPark2</title>
</head>
<body>
    <h1>Gestión de Atracciones</h1>

    <a href="atracciones_insertar.php">+ Añadir nueva atracción</a>
    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Temática</th>
            <th>Acciones</th>
        </tr>
        <?php while ($a = $atracciones->fetch_assoc()): ?>
        <tr>
            <td><?= $a['id'] ?></td>
            <td><?= $a['nombre'] ?></td>
            <td><?= $a['tematica'] ?></td>
            <td>
                <a href="atracciones_modificar.php?id=<?= $a['id'] ?>">Modificar</a> |
                <a href="atracciones_borrar.php?id=<?= $a['id'] ?>" 
                   onclick="return confirm('¿Seguro que quieres borrar esta atracción?')">Borrar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="control_general.php">Volver al control general</a>
</body>
</html>