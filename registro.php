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
        $exito = "Registro exitoso. Ya puedes iniciar sesión.";
    } else {
        $error = "Error: ese email ya está registrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - NavaPark2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="login.php" class="logo">Nava<span>Park2</span> 🎢</a>
    <nav>
        <a href="login.php">Iniciar sesión</a>
        <a href="registro.php">Registro</a>
    </nav>
</div>

<div class="hero">
    <h1>Bienvenido a <span>NavaPark2</span></h1>
    <p>Crea tu cuenta y empieza a vivir la aventura</p>
</div>

<div class="container">
    <div class="card">
        <h2>Crear cuenta</h2>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($exito): ?>
            <div class="alert alert-success">
                <?= $exito ?> <a href="login.php">Inicia sesión aquí</a>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" name="nombre" placeholder="Tu nombre" required>
            </div>
            <div class="form-group">
                <label>Edad</label>
                <input type="number" name="edad" placeholder="Tu edad" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="tu@email.com" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Mínimo 6 caracteres" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear cuenta</button>
        </form>

        <div class="link-text">
            ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
        </div>
    </div>
</div>

<div class="footer">NavaPark2 &copy; 2026 — Navarredonda de Gredos</div>

</body>
</html>