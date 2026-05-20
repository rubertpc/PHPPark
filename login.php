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
    <title>Login - NavaPark2</title>
</head>
<body>
    <h1>Iniciar sesión</h1>

    <?php if ($error): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Contraseña: <input type="password" name="password" required></label><br><br>
        <button type="submit">Entrar</button>
    </form>

    <p><a href="registro.php">¿No tienes cuenta? Regístrate</a></p>
</body>
</html>