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







    include("conexion.php");

    if (isset($_POST['cr'])) {


        $registros = $base->query("SELECT * FROM mapa_marcador")->fetchAll(PDO::FETCH_OBJ);
        $movil = $_POST['movil'];
        $descripcion = $_POST['dir'];
        $cadena = $_POST['coordenadas'];         //coordenadas
        $categoria = 1;     //$_POST['categoria'];
        $color = "imagenes/pasajero.png";   // $_POST['color'];
        $celu = $_POST['celu'];

        list($palabra1, $palabra2) = explode(' ', $cadena);

        $latitud = floatval($palabra1);
        $longitud = floatval($palabra2);

        $lat = round($latitud, 6);
        $lon = round($longitud, 6);

        $coord = $lat . "," . " " . $lon;
    }

    $sql = "INSERT INTO mapa_marcador (movil, descripcion, coordenadas, categoria, color, celu) VALUES (
        :mov, 
        :descr, 
        :coord, 
        :cate, 
        :col, 
        :celu)";
    $resultado = $base->prepare($sql);

    $resultado->execute(array(
        ":mov" => $movil,
        ":descr" => $descripcion,
        ":coord" => $coord,
        ":cate" => $categoria,
        ":col" => $color,
        ":celu" => $celu
    ));

    //header("location:index.php");


    ?>

    <table width="50%" border="0" align="center">
        <tr>
            <td class="primera_fila">Id</td>
            <td class="primera_fila">Nombre</td>
            <td class="primera_fila">Direccion</td>
            <td class="primera_fila">Coordenadas</td>
            <td class="primera_fila">Tipo</td>
            <td class="primera_fila">Descripcion</td>
            <td class="sin">&nbsp;</td>
            <td class="sin">&nbsp;</td>
            <td class="sin">&nbsp;</td>
            <td class="sin">&nbsp;</td>
            <td class="sin">&nbsp;</td>
        </tr>
        <?php
        //--------------------------------------------------------------------------
        // Esta parte es del READ
        foreach ($registros as $persona) :
            /*
            Este es el array donde tengo almacenados todos los objetos de mi BBDD
            $persona es una variable cualquiera
            */
            //-----------------------------------------------------------------------

        ?>

            <tr>
                <td><?php echo $persona->id_marcador ?> </td>
                <td><?php echo $persona->movil ?></td>
                <td><?php echo $persona->descripcion ?></td>
                <td><?php echo $persona->coordenadas ?></td>
                <td><?php echo $persona->categoria ?></td>
                <td><?php echo $persona->color ?></td>
                <td><?php echo $persona->celu ?></td>

                <td class="bot"><a href="borrar.php?id=<?php echo $persona->id ?>"><input type='button' name='del' id='del' value='Borrar'></a></td>
                <!-- ------------------------------ -->
                <!-- Estas lineas son de la edicion -->

                <td class='bot'><a href="editar.php?id_marcador=<?php echo $persona->id_marcador
                                                                ?> & nom=<?php echo $persona->movil ?> 
                                                           & descripcion=<?php echo $persona->descripcion ?> 
                                                           & cordenadas=<?php echo $persona->coordenadas ?>
                                                           & categoria=<?php echo $persona->categoria ?>
                                                           & color=<?php echo $persona->color ?>
                                                           & celu=<?php echo $persona->celu ?>
                                                           ">

                        <input type='button' name='up' id='up' value='Actualizar'></a></td>
                <!-- ------------------------------ -->
            </tr>
        <?php
        // READ-------------------------------------------------------------------------------------
        endforeach;
        ?>
    </table>

</body>

</html>