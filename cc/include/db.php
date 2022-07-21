<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/alineas.css"> <!-- Trabajae con este archivo de ahora en mas -->
</head>

<body>
    <?php

    function ejecuta_consulta($labusqueda)
    {
        require("coneccion.ini");

        $conexion = mysqli_connect($db_host, $db_user, $db_pass);

        if (mysqli_connect_errno()) {
            echo "<br>";
            echo "Fallo la coneccion a la BBDD";

            exit();
        }

        mysqli_select_db($conexion, $db_name) or die("No se encuentra la BBDD");

        mysqli_set_charset($conexion, "utf8");

        $consult = "SELECT * FROM valores_fijos_cctes WHERE pasajero LIKE '%$labusqueda%' || origen LIKE '%$labusqueda%' || destino LIKE '%$labusqueda%' || cc LIKE '%$labusqueda%'";
        //$consult = "SELECT * FROM productos WHERE NOMBRE LIKE '%$busqueda%'";

        $resultado = mysqli_query($conexion, $consult);

    ?>


        <h1>Valores fijos de las cuentas corrientes</h1>
        <form>
            <table width="50%" border="0" align="center">
                <tr>
                    <td class="primera_fila">Id</td>
                    <td class="primera_fila">CC</td>
                    <td class="primera_fila">Kms</td>
                    <td class="primera_fila">Pasajero</td>
                    <td class="primera_fila">Origen</td>
                    <td class="primera_fila">Destino</td>
                    <td class="primera_fila">Importe</td>
                    <td class="primera_fila">Observaciones</td>
                    <td class="primera_fila">Autoriza</td>
                    <td class="sin">&nbsp;</td>
                    <td class="sin">&nbsp;</td>
                    <td class="sin">&nbsp;</td>
                    <td class="sin">&nbsp;</td>
                    <td class="sin">&nbsp;</td>
                    <td class="sin">&nbsp;</td>
                    <td class="sin">&nbsp;</td>
                    <td class="sin">&nbsp;</td>
                </tr>


                <?php

                while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                ?>
                    <tr>
                        <td class="sin"><?php echo $fila['id'] ?></td>
                        <td class="sin"><?php echo $fila['cc'] ?></td>
                        <td class="sin"><?php echo $fila['km'] ?></td>
                        <td class="sin"><?php echo $fila['pasajero'] ?></td>
                        <td class="sin"><?php echo $fila['origen'] ?></td>
                        <td class="sin"><?php echo $fila['destino'] ?></td>
                        <td class="sin"><?php echo $fila['importe'] ?></td>
                        <td class="sin"><?php echo $fila['obs'] ?></td>
                        <td class="sin"><?php echo $fila['autoriza'] ?></td>
                    </tr>

            <?php

                }

                mysqli_close($conexion);
            }

            ?>
            <a href="index.php">
                <h2>Volver</h2>
            </a>

</body>

</html>