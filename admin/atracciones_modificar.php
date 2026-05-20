<?php
require '../db.php';

$exito = "";
$error = "";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: atracciones_listar.php");
    exit();
}

// Obtener datos actuales de la atracción
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
        // Actualizar datos mostrados
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
    <title>Modificar atracción - Admin NavaPark2</title>
</head>
<body>
    <h1>Modificar atracción</h1>

    <?php if ($exito): ?>
        <p style="color:green"><?= $exito ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre: 
            <input type="text" name="nombre" value="<?= $atraccion['nombre'] ?>" required>
        </label><br><br>
        <label>Temática: 
            <input type="text" name="tematica" value="<?= $atraccion['tematica'] ?>" required>
        </label><br><br>
        <button type="submit">Guardar cambios</button>
    </form>

    <br>
    <a href="atracciones_listar.php">Volver al listado</a>
</body>
</html>