<?php
require 'db.php';

$error = "";
$exito = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO viajero (nombre, edad, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $nombre, $edad, $email, $password);

    if ($stmt->execute()) {
        $exito = "Registro exitoso. <a href='login.php'>Inicia sesión</a>";
    } else {
        $error = "Error: ese email ya está registrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - NavaPark2</title>
</head>
<body>
    <h1>Registro de viajero</h1>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <?php if ($exito): ?>
        <p style="color:green"><?= $exito ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre: <input type="text" name="nombre" required></label><br><br>
        <label>Edad: <input type="number" name="edad" required></label><br><br>
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Contraseña: <input type="password" name="password" required></label><br><br>
        <button type="submit">Registrarse</button>
    </form>

    <p><a href="login.php">¿Ya tienes cuenta? Inicia sesión</a></p>
</body>
</html>