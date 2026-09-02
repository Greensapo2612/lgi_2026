<?php
require_once("data_base_connect.php");

$sql = "SELECT * FROM usuarios";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Lista de Usuarios</h1>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["nombre_usuario"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<h1>No se encontraron usuarios.</h1>";
}

$conn->close();

?>