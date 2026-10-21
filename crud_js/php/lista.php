<?php

$conexion = new mysqli("localhost", "root", "", "Sistema_Estudiantes");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM estudiantes";

$resultado = $conexion->query($sql);

$estudiantes = [];

while ($fila = $resultado->fetch_assoc()) {
    $estudiantes[] = $fila;
}

header("Content-Type: application/json");

echo json_encode($estudiantes);

$conexion->close();
?>