<?php
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
    <title>Añadir atracción - Admin NavaPark2</title>
</head>
<body>
    <h1>Añadir nueva atracción</h1>

    <?php if ($exito): ?>
        <p style="color:green"><?= $exito ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre: <input type="text" name="nombre" required></label><br><br>
        <label>Temática: <input type="text" name="tematica" required></label><br><br>
        <button type="submit">Añadir atracción</button>
    </form>

    <br>
    <a href="atracciones_listar.php">Volver al listado</a>
</body>
</html>