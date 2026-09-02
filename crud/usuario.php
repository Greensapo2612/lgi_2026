<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <h1>Bienvenido</h1>
        <?php $nombre =  $_GET["user"];
              $apellido = $_GET["pass"];

              echo "$nombre" ."\n";
              echo "<br>";
              echo "$apellido" . "\n";
        ?><br>
    </center>
</body>
</html>