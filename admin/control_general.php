<?php
require 'auth_admin.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control General - NavaPark2 Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar">
    <a href="control_general.php" class="logo">Nava<span>Park2</span> 🎢 <span style="font-size:0.7rem; background:#f5a623; padding:3px 8px; border-radius:10px; margin-left:8px;">ADMIN</span></a>
    <nav>
        <a href="control_general.php">Control general</a>
        <a href="atracciones_listar.php">Atracciones</a>
        <a href="../logout.php">Cerrar sesión</a>
    </nav>
</div>

<div class="hero">
    <h1>Control <span>General</span></h1>
    <p>Resumen de todos los viajes realizados en el parque</p>
</div>

<div class="container-wide">
    <div class="card">
        <h2>Todos los viajes del parque</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>🎢 Atracción</th>
                            <th>🕐 Hora del viaje</th>
                            <th>🎂 Edad del viajero</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?= $fila['atraccion'] ?></strong></td>
                            <td><?= $fila['hora'] ?></td>
                            <td><span class="badge"><?= $fila['edad'] ?> años</span></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p style="color:#888; text-align:center; padding:30px 0;">
                No hay viajes registrados todavía.
            </p>
        <?php endif; ?>
    </div>

    <div style="text-align:center;">
        <a href="atracciones_listar.php" class="btn btn-secondary">Gestionar atracciones</a>
    </div>
</div>

<div class="footer">NavaPark2 &copy; 2026 — Panel de Administración</div>

</body>
</html>