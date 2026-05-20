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
        $exito = "¡Viaje registrado correctamente!";
    } else {
        $error = "Error al registrar el viaje.";
    }
}

$atracciones = $conn->query("SELECT * FROM atraccion ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo viaje - NavaPark2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="perfil.php" class="logo">Nava<span>Park2</span> 🎢</a>
    <nav>
        <a href="perfil.php">Mi perfil</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</div>

<div class="hero">
    <h1>¡A <span>montar!</span></h1>
    <p>Selecciona una atracción y registra tu aventura</p>
</div>

<div class="container">
    <div class="card">
        <h2>Registrar nuevo viaje</h2>

        <?php if ($exito): ?>
            <div class="alert alert-success">
                <?= $exito ?> <a href="perfil.php">Ver mi perfil</a>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Atracción</label>
                <select name="id_atraccion" required>
                    <?php while ($a = $atracciones->fetch_assoc()): ?>
                        <option value="<?= $a['id'] ?>"><?= $a['nombre'] ?> — <?= $a['tematica'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Fecha y hora del viaje</label>
                <input type="datetime-local" name="hora" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar viaje</button>
        </form>

        <div class="link-text">
            <a href="perfil.php">← Volver a mi perfil</a>
        </div>
    </div>
</div>

<div class="footer">NavaPark2 &copy; 2026 — Navarredonda de Gredos</div>

</body>
</html>