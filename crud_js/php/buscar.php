<?php
header('Content-Type: application/json; charset=utf-8');

require_once("conexion.php");

$letra = trim($_GET['letra'] ?? '');

$sql = "SELECT ID, Nombre, Apellido, Email, Fecha_nacimiento, Activo
        FROM estudiantes
        WHERE Nombre LIKE CONCAT(?, '%')
        ORDER BY Nombre";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $letra);
$stmt->execute();

$resultado = $stmt->get_result();

$estudiantes = [];

while ($fila = $resultado->fetch_assoc()) {
    $estudiantes[] = $fila;
}

echo json_encode($estudiantes);

$stmt->close();
$conn->close();
?>