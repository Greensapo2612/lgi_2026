<?php

$conexion = new mysqli("localhost", "root", "", "Sistema_Estudiantes");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id = $_GET["id"];

$sql = "DELETE FROM estudiantes WHERE ID = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    $respuesta = [
        "ok" => true,
        "mensaje" => "Estudiante eliminado correctamente"
    ];

} else {

    $respuesta = [
        "ok" => false,
        "mensaje" => "No se pudo eliminar el estudiante"
    ];
}

header("Content-Type: application/json");

echo json_encode($respuesta);

$stmt->close();
$conexion->close();

?>