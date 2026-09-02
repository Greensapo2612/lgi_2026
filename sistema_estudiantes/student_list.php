<?php
require_once("conexion_DB.php");

$sql = "SELECT * FROM estudiantes";
$datos = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="stylesheet" href="colores.css">
</head>
<body class="fondos">
    <center>
        <div class="centro marcos">
        <h1>Lista de Estudiantes</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Cumpleaños</th>
                <th>Activo</th>
            </tr>
            <?php
            if ($datos->num_rows > 0 ) {
                while ($row = $datos->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["Nombre"] . "</td>";
                    echo "<td>" . $row["Apellido"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["Fecha_nacimiento"] . "</td>";
                    echo "<td>" . $row["Activo"] . "</td>";
                    echo "</tr>";
                }
                echo "<br>";
            }else{
                echo "<li>No se encontraron estudiantes.</li>";
            }
            ?>
        </table>
        </ul>
        <a href="index.html">
            <br><br>
            <button type="button">volver al inicio</button>
        </a>
        </div>
    </center>
</body>
</html>

<?php
$conn->close();
?>