<?php
require '../db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: atracciones_listar.php");
    exit();
}

$sql = "DELETE FROM atraccion WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: atracciones_listar.php");
    exit();
} else {
    echo "Error al borrar la atracción. <a href='atracciones_listar.php'>Volver</a>";
}
?>