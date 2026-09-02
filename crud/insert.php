<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_prueba";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// chequear conexion

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Conexion Exitosa ";
$sql = "INSERT INTO usuario VALUES (null,'Rana','Azul')";

if($conn->query($sql) == TRUE){
    echo "datos insertados ";
}else{
    echo "Error ". $sql . "<br>" . $conn->error;
}
$conn->close();
?>