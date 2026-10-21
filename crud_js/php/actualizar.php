
<?php

header('Content-Type: application/json; charset=utf-8');

require_once("conexion.php");

// Recibir los datos enviados desde JavaScript
$datos = json_decode(file_get_contents('php://input'), true);

if (!$datos) {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'No se recibieron datos válidos.'
    ]);
    exit;
}

// Obtener los datos
$id = $datos['id'] ?? '';
$nombre = trim($datos['nombre'] ?? '');
$apellido = trim($datos['apellido'] ?? '');
$email = trim($datos['email'] ?? '');
$fecha = $datos['fecha_nacimiento'] ?? '';
$activo = $datos['activo'] ?? '';

// Validar los campos
if (
    !is_numeric($id) || (int)$id <= 0 ||
    $nombre === '' ||
    $apellido === '' ||
    $email === '' ||
    $fecha === '' ||
    $activo === ''
) {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'Faltan datos o el ID no es válido.'
    ]);
    exit;
}

// Preparar la consulta UPDATE
$sql = "UPDATE estudiantes
        SET Nombre = ?,
            Apellido = ?,
            Email = ?,
            Fecha_nacimiento = ?,
            Activo = ?
        WHERE ID = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'Error al preparar la consulta.'
    ]);
    exit;
}

// Vincular los parámetros
$id = (int)$id;
$activo = (int)$activo;

$stmt->bind_param(
    "ssssii",
    $nombre,
    $apellido,
    $email,
    $fecha,
    $activo,
    $id
);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo json_encode([
        'ok' => true,
        'mensaje' => 'Estudiante modificado correctamente.',
        'id' => $id
    ]);
} else {
    echo json_encode([
        'ok' => false,
        'mensaje' => 'No se pudo modificar el estudiante.'
    ]);
}

$stmt->close();
$conn->close();

?>
