<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valores:fijos_CC</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/alineas.css"> <!-- Trabajae con este archivo de ahora en mas -->
</head>

<body>


    <form action="busca.php" method='get'>
        <label>Buscar: <input type='text' name='buscar'></label>
        <input type='submit' name='enviando' value='Busca!'>
       
    </form>

    <?php

    include("../include/coneccion.php");

    $registros = $base->query("SELECT * FROM valores_fijos_cctes")->fetchAll(PDO::FETCH_OBJ);

    // parte del insert
    if (isset($_POST["cr"])) {
        $cc = $_POST["Cc"];
        $km = $_POST["Km"];
        $pasajero = $_POST["Pasajero"];
        $origen = $_POST['Origen'];
        $destino = $_POST['Destino'];
        $importe = $_POST['Importe'];
        $obs = $_POST['Obs'];
        $autoriza = $_POST['Autoriza'];

        //El id no hace falta porque es autonumerico
        $sql = "INSERT INTO valores_fijos_cctes (cc, km, pasajero, origen, destino, importe, obs, autoriza) VALUES (:cc, :km, :pasajero, :origen, :destino, :importe, :obs, :autoriza)";
        $resultado = $base->prepare($sql);
        $resultado->execute(array(":cc" => $cc, ":km" => $km, ":pasajero" => $pasajero, ":origen" => $origen, ":destino" => $destino, ":importe" => $importe, ":obs" => $obs, ":autoriza" => $autoriza));
        header("location:index.php");
    }

    ?>

    <h1>Valores fijos de las cuentas corrientes</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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


            <!-- Esta parte es para que las lineas se repitan -->
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
                    <td><?php echo $persona->id ?> </td>
                    <td><?php echo $persona->cc ?></td>
                    <td><?php echo $persona->km ?></td>
                    <td><?php echo $persona->pasajero ?></td>
                    <td><?php echo $persona->origen ?></td>
                    <td><?php echo $persona->destino ?></td>
                    <td><?php echo "$" . $persona->importe . "-" ?></td>
                    <td><?php echo $persona->obs ?></td>
                    <td><?php echo $persona->autoriza ?></td>

                    <!-- <td class="bot"><a href="borrar.php?id=<?php echo $persona->id ?>"><input type='button' name='del' id='del' value='Borrar'></a></td>  -->
                    <!-- ------------------------------ -->
                    <!-- Estas lineas son de la edicion -->

                    <td class='bot'><a href="editar.php?id=<?php echo $persona->id
                                                            ?>  
                                                           & cc=<?php echo $persona->cc ?> 
                                                           & km=<?php echo $persona->km ?>
                                                           & pasajero=<?php echo $persona->pasajero ?>
                                                           & origen=<?php echo $persona->origen ?>
                                                           & destino=<?php echo $persona->destino ?>
                                                           & importe=<?php echo $persona->importe  ?>
                                                           & obs=<?php echo $persona->obs ?>
                                                           & autoriza=<?php echo $persona->autoriza ?>">
                            <!--  <input type='button' name='up' id='up' value='Actualizar'></a></td>  -->
                            <!-- ------------------------------ -->
                </tr>
            <?php
            // READ-------------------------------------------------------------------------------------
            endforeach;
            //Otra forma de hacerlo es concatenando todo para que quede php dentro de cada linea de html
            //------------------------------------------------------------------------------------------

            ?>

            <!-- Esta es la parte del insert con la linea <form action=" <?php //echo $_SERVER['PHP_SELF']; 
                                                                            ?>" method="post">-->
            <!--
            <tr>
                <td></td>
                <td><input type='text' name='Cc' size='4' class='centrado'></td>
                <td><input type='text' name='Km' size='5' class='centrado'></td>
                <td><input type='text' name='Pasajero' size='20' class='centrado'></td>
                <td><input type='text' name='Origen' size='20' class='centrado'></td>
                <td><input type='text' name='Destino' size='20' class='centrado'></td>
                <td><input type="text" name='Importe' size="8" class="centrado"></td>
                <td><input type='text' name='Obs' size='20' class='centrado'></td>
                <td><input type='text' name='Autoriza' size='20' class='centrado'></td>

                <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td> 
            </tr>
        -->
        </table>
        <a href="../../index.php">Salir</a>
    </form>

    <p>&nbsp;</p>


</body>

</html>