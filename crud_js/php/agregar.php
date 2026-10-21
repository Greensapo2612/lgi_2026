<?php

//header('Content-Type: application/json; charset=utf-8');

require_once("conexion.php");

// Recibir los datos JSON enviados desde JavaScript
$datos = json_decode(file_get_contents('php://input'), true);

if (!$datos) {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'No se recibieron datos válidos.'
    ]);
    exit;
}

// Obtener los datos
$nombre = trim($datos['nombre'] ?? '');
$apellido = trim($datos['apellido'] ?? '');
$email = trim($datos['email'] ?? '');
$fecha = $datos['fecha_nacimiento'] ?? '';
$activo = $datos['activo'] ?? '';

// Validar los campos
if (
    $nombre === '' ||
    $apellido === '' ||
    $email === '' ||
    $fecha === '' ||
    $activo === ''
) {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'Todos los campos son obligatorios.'
    ]);
    exit;
}

// Preparar la consulta
$sql = "INSERT INTO estudiantes
        (Nombre, Apellido, Email, Fecha_nacimiento, Activo)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'Error al preparar la consulta.'
    ]);
    exit;
}

// Vincular los parámetros
$activo = (int)$activo;

$stmt->bind_param(
    "ssssi",
    $nombre,
    $apellido,
    $email,
    $fecha,
    $activo
);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo json_encode([
        'ok' => true,
        'mensaje' => 'Estudiante creado correctamente.',
        'id' => $stmt->insert_id
    ]);
} else {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'No se pudo insertar el estudiante.'
    ]);
}

$stmt->close();
$conn->close();

?>