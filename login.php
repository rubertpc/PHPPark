<?php
session_start();
require 'db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM viajero WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $viajero = $resultado->fetch_assoc();

    if ($viajero && password_verify($password, $viajero['password'])) {
        $_SESSION['id_viajero'] = $viajero['id'];
        $_SESSION['nombre'] = $viajero['nombre'];
        header("Location: perfil.php");
        exit();
    } else {
        $error = "Email o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NavaPark2</title>
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
    <h1>¡Hola de nuevo!</h1>
    <p>Accede a tu cuenta y consulta tus aventuras</p>
</div>

<div class="container">
    <div class="card">
        <h2>Iniciar sesión</h2>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="tu@email.com" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Tu contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        <div class="link-text">
            ¿No tienes cuenta? <a href="registro.php">Regístrate gratis</a>
        </div>
    </div>
</div>

<div class="footer">NavaPark2 &copy; 2026 — Navarredonda de Gredos</div>

</body>
</html>