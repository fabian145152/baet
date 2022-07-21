<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/main.css ">
    <title>Baet</title>
</head>

<body>
    <?php

    include("conexion.php");

    $registros = $base->query("SELECT * FROM mapa_marcador")->fetchAll(PDO::FETCH_OBJ);

    if (isset($_POST['cr'])) {

        $movil = $_POST['Movil'];
        $descripcion = $_POST['Dir'];
        $cadena = $_POST['Coordenadas'];         //coordenadas
        $categoria = 1;     //$_POST['categoria'];
        $color = "imagenes/pasajero.png";   // $_POST['color'];
        $celu = $_POST['Celu'];

        list($palabra1, $palabra2) = explode(' ', $cadena);

        $latitud = floatval($palabra1);
        $longitud = floatval($palabra2);

        $lat = round($latitud, 6);
        $lon = round($longitud, 6);

        $coord = $lat . "," . " " . $lon;

        echo $movil;


        $sql = "INSERT INTO mapa_marcador (movil, descripcion, coordenadas, categoria, color, celu) VALUES (
            :mov, :descr, :coord, :cate, :col, :celu)";

        $resultado = $base->prepare($sql);

        $resultado->execute(array(
            ":mov" => $movil,
            ":descr" => $descripcion,
            ":coord" => $coord,
            ":cate" => $categoria,
            ":col" => $color,
            ":celu" => $celu
        ));

        header("location:index.php");
    }



    ?>


    <h1>Edicion de viajes</h1>
    <a href="../mapas/index.php">Ver Mapa</a>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

        <table width="50%" border="0" align="center">
            <tr>
                <td class="primera_fila">Id</td>
                <td class="primera_fila">Nombre</td>
                <td class="primera_fila">Direccion</td>
                <td class="primera_fila">Coordenadas</td>
                <td class="primera_fila">Celular</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
            </tr>

            <?php

            foreach ($registros as $persona) :

            ?>

                <tr>
                    <?php
                    if ($persona->movil >= "3020" && $persona->movil <= "4000") {
                        echo "nono";
                    } else {

                    ?>
                        <td><?php echo $persona->id_marcador ?> </td>
                        <td><?php echo $persona->movil ?></td>
                        <td><?php echo $persona->descripcion ?></td>
                        <td><?php echo $persona->coordenadas ?></td>
                        <td><?php echo $persona->celu ?></td>

                        <td class="bot"><a href="borrar.php?id_marcador=<?php echo $persona->id ?>"><input type='button' name='del' id='del' value='Borrar'></a></td>
                        <!-- ------------------------------ -->
                        <!-- Estas lineas son de la edicion -->

                        <td class='bot'><a href="editar.php?id_marcador=<?php echo $persona->id_marcador
                                                                        ?> & movil=<?php echo $persona->movil ?> 
                                                           & descripcion=<?php echo $persona->descripcion ?> 
                                                           & coordenadas=<?php echo $persona->cordenadas ?>
                                                           & celu=<?php echo $persona->celu ?>">
                                <input type='button' name='up' id='up' value='Actualizar'></a></td>
                        <!-- ------------------------------ -->
                </tr>

        <?php
                    }

                endforeach;

        ?>

        <tr>
            <td></td>
            <td><input type='text' name='Movil' size='10' class='centrado'></td>
            <td><input type='text' name='Dir' size='10' class='centrado'></td>
            <td><input type='text' name=' Coordenadas' size='18' class='centrado'></td>
            <td><input type='text' name=' Celu' size='10' class='centrado'></td>
            <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
        </tr>

        </table>
</body>

</html>