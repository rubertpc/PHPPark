<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id_viajero'])) {
    header("Location: login.php");
    exit();
}

$id_viajero = $_SESSION['id_viajero'];

$sql = "SELECT * FROM viajero WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_viajero);
$stmt->execute();
$viajero = $stmt->get_result()->fetch_assoc();

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil - NavaPark2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="perfil.php" class="logo">Nava<span>Park2</span> 🎢</a>
    <nav>
        <a href="nueva_visita.php">+ Nuevo viaje</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</div>

<div class="container">

    <div class="profile-header">
        <div class="profile-avatar">🎠</div>
        <div class="profile-info">
            <h2><?= $viajero['nombre'] ?></h2>
            <p>🎂 <?= $viajero['edad'] ?> años &nbsp;|&nbsp; 📧 <?= $viajero['email'] ?></p>
        </div>
    </div>

    <div class="card">
        <h2>Mis viajes</h2>

        <?php if ($viajes->num_rows > 0): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>🎢 Atracción</th>
                            <th>🕐 Hora del viaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($viaje = $viajes->fetch_assoc()): ?>
                        <tr>
                            <td><?= $viaje['nombre'] ?></td>
                            <td><?= $viaje['hora'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p style="color:#888; text-align:center; padding: 30px 0;">
                🎡 Todavía no has realizado ningún viaje.<br>
                <a href="nueva_visita.php" class="btn btn-primary" style="margin-top:20px; display:inline-block; width:auto;">
                    Registrar mi primer viaje
                </a>
            </p>
        <?php endif; ?>
    </div>

    <div style="text-align:center;">
        <a href="nueva_visita.php" class="btn btn-secondary">+ Registrar nuevo viaje</a>
    </div>

</div>

<div class="footer">NavaPark2 &copy; 2026 — Navarredonda de Gredos</div>

</body>
</html>