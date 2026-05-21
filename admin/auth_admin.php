<?php
session_start();

if (!isset($_SESSION['id_viajero']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>