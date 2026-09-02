<?php
require_once("conexion_DB.php");

$name = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$nac = $_POST["cumple"];
$act= $_POST["activo"];

$sql = "INSERT INTO estudiantes (Nombre,Apellido,Email,Fecha_nacimiento,Activo) VALUES (?,?,?,?,?)";

$stmt =$conn->prepare($sql);

$stmt->bind_param("ssssi",$name,$apellido,$email,$nac,$act);

if($stmt->execute()){
    echo "datos ingresados";
    header("Location:index.html");
}else{
    echo "error". $stmt->error;
}
$stmt->close();
$conn->close();
?>
