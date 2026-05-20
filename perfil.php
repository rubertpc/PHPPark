<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id_viajero'])) {
    header("Location: login.php");
    exit();
}

$id_viajero = $_SESSION['id_viajero'];

// Obtener datos del viajero
$sql = "SELECT * FROM viajero WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_viajero);
$stmt->execute();
$viajero = $stmt->get_result()->fetch_assoc();

// Obtener viajes del viajero
$sql_viajes = "SELECT a.nombre, v.hora 
               FROM viaje v 
               JOIN atraccion a ON v.id_atraccion = a.id 
               WHERE v.id_viajero = ? 
               ORDER BY v.hora DESC";
$stmt2 = $conn->prepare($sql_viajes);
$stmt2->bind_param("i", $id_viajero);
$stmt2->execute();
$viajes = $stmt2->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi perfil - NavaPark2</title>
</head>
<body>
    <h1>Mi perfil</h1>

    <p><strong>Nombre:</strong> <?= $viajero['nombre'] ?></p>
    <p><strong>Edad:</strong> <?= $viajero['edad'] ?> años</p>

    <h2>Mis viajes</h2>

    <?php if ($viajes->num_rows > 0): ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>Atracción</th>
                <th>Hora</th>
            </tr>
            <?php while ($viaje = $viajes->fetch_assoc()): ?>
            <tr>
                <td><?= $viaje['nombre'] ?></td>
                <td><?= $viaje['hora'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Todavía no has realizado ningún viaje.</p>
    <?php endif; ?>

    <br>
    <a href="nueva_visita.php">Registrar nuevo viaje</a> |
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>