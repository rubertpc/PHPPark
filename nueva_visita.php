<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id_viajero'])) {
    header("Location: login.php");
    exit();
}

$id_viajero = $_SESSION['id_viajero'];
$exito = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_atraccion = $_POST['id_atraccion'];
    $hora = $_POST['hora'];

    $sql = "INSERT INTO viaje (id_viajero, id_atraccion, hora) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $id_viajero, $id_atraccion, $hora);

    if ($stmt->execute()) {
        $exito = "Viaje registrado correctamente.";
    } else {
        $error = "Error al registrar el viaje.";
    }
}

// Obtener todas las atracciones
$atracciones = $conn->query("SELECT * FROM atraccion ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo viaje - NavaPark2</title>
</head>
<body>
    <h1>Registrar nuevo viaje</h1>

    <?php if ($exito): ?>
        <p style="color:green"><?= $exito ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Atracción:
            <select name="id_atraccion" required>
                <?php while ($a = $atracciones->fetch_assoc()): ?>
                    <option value="<?= $a['id'] ?>"><?= $a['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </label><br><br>

        <label>Hora: <input type="datetime-local" name="hora" required></label><br><br>

        <button type="submit">Registrar viaje</button>
    </form>

    <br>
    <a href="perfil.php">Volver a mi perfil</a>
</body>
</html>