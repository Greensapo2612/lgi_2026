<?php
require_once("data_base_connect.php");

$name = "Batracio";
$apellido = "Turqueza";

$sql = "INSERT INTO usuario (usuario,contrasenia) VALUES (?,?)";

$stmt =$conn->prepare($sql);

$stmt->bind_param("ss",$name,$apellido);

if($stmt->execute()){
    echo "datos insertados";
}else{
    echo "error". $stmt->error;
}
$stmt->close();
$conn->close();
?>