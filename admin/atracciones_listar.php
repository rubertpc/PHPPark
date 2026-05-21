<?php
require 'auth_admin.php';
require '../db.php';

$atracciones = $conn->query("SELECT * FROM atraccion ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atracciones - NavaPark2 Admin</title>
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
    <h1>Gestión de <span>Atracciones</span></h1>
    <p>Administra todas las atracciones del parque</p>
</div>

<div class="container-wide">
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px;">
            <h2 style="margin-bottom:0; border-bottom:none;">Listado de atracciones</h2>
            <a href="atracciones_insertar.php" class="btn btn-primary btn-small">+ Añadir atracción</a>
        </div>

        <?php if ($atracciones->num_rows > 0): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>🎢 Nombre</th>
                            <th>🎭 Temática</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($a = $atracciones->fetch_assoc()): ?>
                        <tr>
                            <td><?= $a['id'] ?></td>
                            <td><strong><?= $a['nombre'] ?></strong></td>
                            <td><span class="badge"><?= $a['tematica'] ?></span></td>
                            <td>
                                <div class="actions">
                                    <a href="atracciones_modificar.php?id=<?= $a['id'] ?>" class="btn btn-edit">✏️ Editar</a>
                                    <a href="atracciones_borrar.php?id=<?= $a['id'] ?>" 
                                       class="btn btn-danger"
                                       onclick="return confirm('¿Seguro que quieres borrar esta atracción?')">🗑️ Borrar</a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p style="color:#888; text-align:center; padding:30px 0;">
                No hay atracciones registradas todavía.
            </p>
        <?php endif; ?>
    </div>

    <div style="text-align:center;">
        <a href="control_general.php" class="btn btn-secondary">← Volver al control general</a>
    </div>
</div>

<div class="footer">NavaPark2 &copy; 2026 — Panel de Administración</div>

</body>
</html>