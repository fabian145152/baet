<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    session_start();
    require_once("datos.php");
    $con = mysqli_connect($host, $user, $pass, $db_name) or die("Error en la conexión con la base de datos");
    ?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Panel de usuario</title>
        <meta charset="UTF-8">
        <form method="POST" action="index.php" name="form-select">
            <p>ELIGE UNA CATEGORIA</p>
            <p>Categoria:</p>
    </head>

    <body>

        <?php


        $query = "SELECT * FROM mapa_categoria";
        $rows = mysqli_query($con, $query);
        echo "<select name='categoria'><option value=''></option>";
        while ($row = mysqli_fetch_array($rows)) {
            extract($row);
            echo "<option value='$id_categoria'>$nombre</option>";
        }
        echo "</select>";
        mysqli_close($con);
        ?>
        </br></br>
        <input type="submit" value="Buscar" name="buscar_cat">
        </form>
        <?php
        if (isset($_SESSION['busqError'])) {
            echo $_SESSION['busqError'];
            unset($_SESSION['busqError']);
        }
        if (isset($_SESSION['busqVac'])) {
            echo $_SESSION['busqVac'];
            unset($_SESSION['busqVac']);
        }

        ?>
    </body>

    </html>
</body>

</html>