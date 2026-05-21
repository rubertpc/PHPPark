<?php
require 'auth_admin.php';
require '../db.php';

$exito = "";
$error = "";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: atracciones_listar.php");
    exit();
}

$sql = "SELECT * FROM atraccion WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$atraccion = $stmt->get_result()->fetch_assoc();

if (!$atraccion) {
    header("Location: atracciones_listar.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $tematica = $_POST['tematica'];

    $sql = "UPDATE atraccion SET nombre = ?, tematica = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $tematica, $id);

    if ($stmt->execute()) {
        $exito = "Atracción modificada correctamente.";
        $atraccion['nombre'] = $nombre;
        $atraccion['tematica'] = $tematica;
    } else {
        $error = "Error al modificar la atracción.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar atracción - NavaPark2 Admin</title>
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
    <h1>Modificar <span>Atracción</span></h1>
    <p>Edita los datos de la atracción seleccionada</p>
</div>

<div class="container">
    <div class="card">
        <h2>Editar atracción</h2>

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
                <input type="text" name="nombre" value="<?= $atraccion['nombre'] ?>" required>
            </div>
            <div class="form-group">
                <label>Temática</label>
                <input type="text" name="tematica" value="<?= $atraccion['tematica'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>

        <div class="link-text">
            <a href="atracciones_listar.php">← Volver al listado</a>
        </div>
    </div>
</div>

<div class="footer">NavaPark2 &copy; 2026 — Panel de Administración</div>

</body>
</html>