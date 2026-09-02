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
    <title>Eliminar</title>
    <link rel="stylesheet" href="colores.css">
</head>
<body class="fondos">
    <center>
        <div class="centro marcos">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Cumpleaños</th>
                <th>Activo</th>
                <th>accion</th>
            </tr>
            <?php
            if ($datos->num_rows > 0) {
                while ($row = $datos->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["Nombre"] . "</td>";
                    echo "<td>" . $row["Apellido"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["Fecha_nacimiento"] . "</td>";
                    echo "<td>" . $row["Activo"] . "</td>";

                    echo "<td>";
                    echo "<form action='delete.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='" . $row["ID"] . "'>";
                    echo "<button type='submit'>Eliminar</button>";
                    echo "</form>";
                    echo "</td>";
                    
                    echo "</tr>";
                }
            }else {
                echo "<tr>";
                echo "<td colspan='7'>No se encontraron estudiantes.</td>";
                echo "</tr>";
            }
        ?>

        </table>
        <?php
        $conn->close();
        ?>
        <a href="index.html">
            <br><br>
            <button type="button">Volver al Inicio</button>
        </a>
        </div>
    </center>
</body>
</html>

