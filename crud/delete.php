<?php
require_once("data_base_connect.php");

$id = '3';

$sql = ("DELETE FROM usuario WHERE id = ?");

$stmt =$conn->prepare($sql);

$stmt->bind_param("i",$id);

if($stmt->execute()){
    echo "datos eliminados";
}else{
    echo "error". $stmt->error;
}
$stmt->close();
$conn->close();

?>