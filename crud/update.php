<?php
require_once("data_base_connect.php");

$id = '2';
$nombre = "Lizard";

$sql = ("UPDATE usuario SET usuario = ? WHERE id = ?");

$stmt =$conn->prepare($sql);

$stmt->bind_param("si",$nombre,$id);

if($stmt->execute()){
    echo "datos eliminados";
}else{
    echo "error". $stmt->error;
}
$stmt->close();
$conn->close();

?>