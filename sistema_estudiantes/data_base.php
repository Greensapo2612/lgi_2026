<?php
$servername = "localhost";
$username = "root";
$password = "";

//conexion
$conn = mysqli_connect($servername,$username,$password);

if (!$conn) {
    die("Conexion Fallida" . mysqli_connect_error());
}
 $sql = "CREATE DATABASE Sistema_Estudiantes";
 if (mysqli_query($conn,$sql)) {
    echo "Base de Datos Creada";
 }else {
    echo "Error al crear la Base de Datos";
 }
?>