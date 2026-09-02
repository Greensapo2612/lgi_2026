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
    <title>Actualizar</title>
    <link rel="stylesheet" href="colores.css">
</head>
<body class="fondos">
    <center>
        <div class="ajuste marco_2">
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
            if ($datos->num_rows > 0) {
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
            }
             ?>

        </table>
        
        <form action="update.php" method="post">
        <h4>Ingrese los datos</h4>
        <label>ID:</label>
        <input type="text" name="id"><br><br>
        <label>Nombre:</label>
        <input type="text" name="nombre"><br><br>
        <label>Apellido:</label>
        <input type="text" name="apellido"><br><br>
        <label>Email:</label>
        <input type="text" name="email" id=""><br><br>
        <label>Cumpleaños:</label>
        <input type="text" name="cumple"><br><br>
        <label>Activo:</label>
        <input type="text" name="activo" id=""><br><br>

        <br><br>
        <button type="submit">Guardar Cambios</button>

        <a href="index.html">
            <br><br>
            <button type="button">Volver al Inicio</button>
        </a>

        </form>
        </div>
    </center>
</body>
</html>