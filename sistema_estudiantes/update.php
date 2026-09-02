<?php
require_once("conexion_DB.php");

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$nac = $_POST["cumple"];
$act = $_POST["activo"];

$sql = ("UPDATE estudiantes SET Nombre =?, Apellido =?, Email =?, Fecha_nacimiento =?, Activo =? WHERE id = ?");

$stmt =$conn->prepare($sql);

$stmt->bind_param("ssssii",$nombre,$apellido,$email,$nac,$act,$id);

if($stmt->execute()){
    echo "datos actualizados";
    header("Location:index.html");
}else{
    echo "error". $stmt->error;
}
$stmt->close();
$conn->close();

?>