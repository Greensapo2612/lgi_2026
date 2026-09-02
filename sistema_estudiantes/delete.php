<?php
require_once("conexion_DB.php");

$id = $_POST["id"];

$sql = ("DELETE FROM estudiantes WHERE id = ?");

$stmt =$conn->prepare($sql);

$stmt->bind_param("i",$id);

if($stmt->execute()){
    echo "datos eliminados";
    header("Location:index.html");
}else{
    echo "error". $stmt->error;
}
$stmt->close();
$conn->close();

?>