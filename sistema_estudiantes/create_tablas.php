<?php
require_once("conexion_DB.php");

$sql = "CREATE TABLE estudiantes (
ID INT AUTO_INCREMENT PRIMARY KEY,
Nombre VARCHAR(100) NOT NULL,
Apellido VARCHAR(100) NOT NULL,
Email VARCHAR(100) NOT NULL,
Fecha_nacimiento DATE,
Activo TINYINT(1) NOT NULL DEFAULT 0
)";

if (mysqli_query($conn, $sql)) {
  echo "Tabla Estudiantes creada exitosamente";
} else {
  echo "Error creando tabla: " . mysqli_error($conn);
}

mysqli_close($conn);
?>