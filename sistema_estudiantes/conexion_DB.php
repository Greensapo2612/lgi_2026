<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Sistema_Estudiantes";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// chequear conexion

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>