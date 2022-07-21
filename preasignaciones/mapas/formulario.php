<?php
session_start();
require_once("datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name) or die("Error en la conexión con la base de datos");
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title></title>
    
</head>


<body>
    <form action="formulario.php" method="post" name="formCategoria">
        <u>
            <h1>Alta categorias</h1>
        </u>
        movil: <input type="text" name="movil" /><br /><br />
        <input type="submit" value="Alta categoria" name="alta_categoria">
    </form>


    <?php
    if (isset($_SESSION['catOK'])) {
        echo $_SESSION['catOK'];
        unset($_SESSION['catOK']);
    }
    if (isset($_SESSION['catError'])) {
        echo $_SESSION['catError'];
        unset($_SESSION['catError']);
    }
    ?>

    <form method="POST" action="formulario.php" name="formMarcadores">

        movil marcador: <input type="text" name="nom_marcador" /><br /><br />
        Descripcion: <input type="text" name="descripcion" /><br /><br />
        Coordenadas:<input type="text" name="coordenadas">

        <?php
        $query = "select * from mapa_categoria";
        $rows = mysqli_query($con, $query);
        echo "<select name='categoria'><option value=''></option>";
        while ($row = mysqli_fetch_array($rows)) {
            extract($row);
            echo "<option value='$id_categoria'>$movil</option>";
        }
        echo "</select>";
        ?>
        <br /><br />
        <input type="submit" value="Alta marcador" name="alta_marcador">
    </form>
    <?php
    if (isset($_SESSION['marcadorOK'])) {
        echo $_SESSION['marcadorOK'];
        unset($_SESSION['marcadorOK']);
    }
    if (isset($_SESSION['marcadorError'])) {
        echo $_SESSION['marcadorError'];
        unset($_SESSION['marcadorError']);
    }
    ?>
</body>

</html>
<?php
if (isset($_POST['alta_categoria'])) {
    if (isset($_POST['movil']) && !empty($_POST['movil'])) {
        $movil = $_POST['movil'];
        $query_C = "INSERT INTO mapa_categoria(movil) values ('$movil')";
        mysqli_query($con, $query_C);
        $_SESSION['catOK'] = "¡Categoria creada!";
        header("Location: formulario.php");
    } else {
        $_SESSION['catError'] = "Escribe el movil de la categoria por favor";
        header("Location: formulario.php");
    }
}


if (isset($_POST['alta_marcador'])) {
    if (isset($_POST['alta_marcador'])  && isset($_POST['coordenadas']) && !empty($_POST['coordenadas']) && isset($_POST['categoria'])) {
        $movil = $_POST['nom_marcador'];
        $descripcion = $_POST['descripcion'];
        $coordenadas = $_POST['coordenadas'];
        $categoria = $_POST['categoria'];
        $query_M = "INSERT INTO mapa_marcador(movil, descripcion, coordenadas, categoria) VALUES ('$movil', '$descripcion', '$coordenadas', $categoria)";
        mysqli_query($con, $query_M);
        $_SESSION['marcadorOK'] = "Marcador creado correctamente";
        header("Location: formulario.php");
    } else {
        $_SESSION['marcadorError'] = "<span style='color:red;'>Rellena todos los campos por favor.</span>";
        header("Location: formulario.php");
    }
}
mysqli_close($con);
?>