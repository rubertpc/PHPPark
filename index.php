<?php
//session_start();

// Si ya está logueado redirigir según rol
if (isset($_SESSION['id_viajero'])) {
    if ($_SESSION['rol'] === 'admin') {
        header("Location: admin/control_general.php");
    } else {
        header("Location: perfil.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavaPark2 — Parque de Atracciones</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .hero-home {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: white;
            text-align: center;
            padding: 120px 20px;
            position: relative;
            overflow: hidden;
            min-height: 70vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .hero-home::before {
            content: "🎢";
            font-size: 20rem;
            position: absolute;
            top: -40px;
            right: -40px;
            opacity: 0.05;
        }
        .hero-home::after {
            content: "🎡";
            font-size: 15rem;
            position: absolute;
            bottom: -40px;
            left: -20px;
            opacity: 0.05;
        }
        .hero-home h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: 2px;
            line-height: 1.2;
        }
        .hero-home p {
            font-size: 1.2rem;
            color: #aab4c8;
            max-width: 600px;
            margin: 0 auto 40px;
            line-height: 1.8;
        }
        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-hero-primary {
            background: linear-gradient(135deg, #f5a623, #e8950e);
            color: white;
            padding: 16px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(245,166,35,0.4);
            transition: all 0.3s;
        }
        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(245,166,35,0.6);
        }
        .btn-hero-secondary {
            background: transparent;
            color: white;
            padding: 16px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.3s;
        }
        .btn-hero-secondary:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
            transform: translateY(-3px);
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin: 50px 0;
        }
        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 35px 25px;
            text-align: center;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .feature-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 10px;
        }
        .feature-card p {
            color: #888;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        .atracciones-section {
            background: #1a1a2e;
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        .atracciones-section h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
        }
        .atracciones-section h2 span {
            color: #f5a623;
        }
        .atracciones-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            max-width: 900px;
            margin: 40px auto 0;
        }
        .atraccion-item {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s;
        }
        .atraccion-item:hover {
            background: rgba(245,166,35,0.1);
            border-color: #f5a623;
        }
        .atraccion-item .icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .atraccion-item h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .atraccion-item p {
            font-size: 0.8rem;
            color: #aab4c8;
        }
        .cta-section {
            text-align: center;
            padding: 80px 20px;
            background: #f0f4f8;
        }
        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a2e;
            margin-bottom: 15px;
        }
        .cta-section h2 span {
            color: #f5a623;
        }
        .cta-section p {
            color: #888;
            font-size: 1.1rem;
            margin-bottom: 35px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php" class="logo">Nava<span>Park2</span> 🎢</a>
    <nav>
        <a href="login.php">Iniciar sesión</a>
        <a href="registro.php">Registro</a>
    </nav>
</div>

<!-- HERO -->
<div class="hero-home">
    <h1>Bienvenido a<br><span style="color:#f5a623">NavaPark2</span></h1>
    <p>El parque de atracciones más emocionante de Navarredonda de Gredos. Regístrate, elige tu atracción y vive la aventura.</p>
    <div class="hero-buttons">
        <a href="registro.php" class="btn-hero-primary">🎟️ Empieza gratis</a>
        <a href="login.php" class="btn-hero-secondary">Iniciar sesión</a>
    </div>
</div>

<!-- CARACTERÍSTICAS -->
<div class="container-wide">
    <div class="features">
        <div class="feature-card">
            <div class="feature-icon">🎟️</div>
            <h3>Registro sencillo</h3>
            <p>Crea tu cuenta en segundos y accede a todas las atracciones del parque.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🎢</div>
            <h3>Múltiples atracciones</h3>
            <p>Elige entre una gran variedad de atracciones con temáticas únicas y emocionantes.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📋</div>
            <h3>Historial de viajes</h3>
            <p>Consulta en tu perfil todas las atracciones que has visitado y cuándo.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <h3>100% seguro</h3>
            <p>Tus datos están protegidos con encriptación y acceso seguro.</p>
        </div>
    </div>
</div>

<!-- ATRACCIONES -->
<div class="atracciones-section">
    <h2>Nuestras <span>Atracciones</span></h2>
    <p style="color:#aab4c8; margin-top:10px;">Descubre lo que te espera en el parque</p>
    <div class="atracciones-grid">
        <?php
        require 'db.php';
        $atracciones = $conn->query("SELECT * FROM atraccion ORDER BY nombre");
        $iconos = ["🎢", "🎡", "🎠", "🚀", "🌊", "⚡"];
        $i = 0;
        while ($a = $atracciones->fetch_assoc()):
        ?>
        <div class="atraccion-item">
            <div class="icon"><?= $iconos[$i % count($iconos)] ?></div>
            <h4><?= $a['nombre'] ?></h4>
            <p><?= $a['tematica'] ?></p>
        </div>
        <?php $i++; endwhile; ?>
    </div>
</div>

<!-- CTA -->
<div class="cta-section">
    <h2>¿Listo para la <span>aventura?</span></h2>
    <p>Únete a miles de viajeros y empieza a disfrutar del parque hoy mismo.</p>
    <a href="registro.php" class="btn-hero-primary">🎟️ Crear mi cuenta gratis</a>
</div>

<div class="footer">NavaPark2 &copy; 2026 — Navarredonda de Gredos</div>

</body>
</html>