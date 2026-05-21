<?php
require 'auth_admin.php';
require '../db.php';

$exito = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $tematica = $_POST['tematica'];

    $sql = "INSERT INTO atraccion (nombre, tematica) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre, $tematica);

    if ($stmt->execute()) {
        $exito = "Atracción añadida correctamente.";
    } else {
        $error = "Error al añadir la atracción.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir atracción - NavaPark2 Admin</title>
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
    <h1>Nueva <span>Atracción</span></h1>
    <p>Añade una nueva atracción al parque</p>
</div>

<div class="container">
    <div class="card">
        <h2>Añadir atracción</h2>

        <?php if ($exito): ?>
            <div class="alert alert-success">
                <?= $exito ?> <a href="atracciones_listar.php">Ver listado</a>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Nombre de la atracción</label>
                <input type="text" name="nombre" placeholder="Ej: La Montaña Rusa" required>
            </div>
            <div class="form-group">
                <label>Temática</label>
                <input type="text" name="tematica" placeholder="Ej: Aventura y velocidad" required>
            </div>
            <button type="submit" class="btn btn-primary">Añadir atracción</button>
        </form>

        <div class="link-text">
            <a href="atracciones_listar.php">← Volver al listado</a>
        </div>
    </div>
</div>

<div class="footer">NavaPark2 &copy; 2026 — Panel de Administración</div>

</body>
</html>