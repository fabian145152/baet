<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Documento sin título</title>
    <link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>

    <h1>ACTUALIZAR</h1>
    <?php
    //------------------------------------------------------------------------
    //Hago esta linea para conectarme y guardad los datos actualizados
    include("conexion.php");
    //------------------------------------------------------------------------

    /*
  Ahora tengo que hacer un if para que me lea los $_GET cuando trae info de la otra pagina y no le el $_POST que uso para hacer el update
  */

    if (!isset($_POST["bot_actualizar"])) {
        $id_marcador = $_GET["id_marcador"];
        $movil = $_GET["nom"];
        $descripcion = $_GET["descripcion"];
        $coordenadas = $_GET["cor"];
        $categoria = $_GET["cat"];
        $color = $_GET["col"];
        $desc = $_GET["desc"];
    } else {

        $id_marcador = $_POST["id_marcador"];             //Le puse _actualizada pero puedo usar el mismo nombre uqe en el post
        $movil = $_POST["nom"];        //Le puse _actualizada pero puedo usar el mismo nombre uqe en el post
        $des = $_POST["des"];      //Le puse _actualizada pero puedo usar el mismo nombre uqe en el post
        $coordenadas = $_POST["cor"];     //Le puse _actualizada pero puedo usar el mismo nombre uqe en el post
        $categoria = $_POST["cat"];
        $color = $_POST["col"];
        $desc = $_POST["desca"];

        $sql = "UPDATE marcador SET nombre=:miNom, 
                                    descripcion=:miDescripcion, 
                                    coordenadas=:miCoordenadas, 
                                    categoria=:miCategoria,
                                    color=:miColor,
                                    desca=:miDesc
                            WHERE id_marcador=:miId";
        $resultado = $base->prepare($sql);
        $resultado->execute(array(
            ":miId" => $id_marcador,
            ":miNom" => $movil,
            ":miDescripcion" => $descripcion,
            ":miCoordenadas" => $coordenadas,
            ":miCategoria" => $categoria,
            ":miColor" => $color,
            ":miDesc" => $desc
        ));

        header("location:index.php");
    }
    ?>

    <p>

    </p>
    <p>&nbsp;</p>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">



        <table width="35%" border="0" align="center">
            <tr>
                <td></td>
                <td><label for="id"></label>
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    <!-- Si quiero no mostrar el id saco la etiqueta de php y listo -->
                </td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><label for="nom"></label>
                    <input type="text" name="nom" id="nom" value="<?php echo $movil ?>">
                </td>
            </tr>
            <tr>
                <td>Apellido</td>
                <td><label for="ape"></label>
                    <input type="text" name="ape" id="ape" value="<?php echo $apellido ?>">
                </td>
            </tr>
            <tr>
                <td>Dirección</td>
                <td><label for="dir"></label>
                    <input type="text" name="dir" id="dir" value="<?php echo $direccion ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
            </tr>
        </table>
    </form>
    <p>&nbsp;</p>
</body>

</html>