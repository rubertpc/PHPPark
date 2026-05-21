<?php
$host = "localhost";
$puerto = "8889";
$usuario = "root";
$password = "root";
$base_datos = "navapark2";

$conn = new mysqli($host, $usuario, $password, $base_datos, $puerto);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>