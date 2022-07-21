<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>

    <p>Tomar la recuadacion diaria de cada unidad de el reporte de la app</p>
    <p>cargarlo en una bbdd</p>
    <p>si esta por debajo de un valor indicarlo con un color</p>
    <p>Si esta dentro de un valor indicarlo con otro color</p>
    <p>si esta por arriba del valor indicarlo con otro</p>
    <p>hacer el total por dia semana y por mes</p>

    <?php



    $fechaEntera = time();

    $anio = date("Y", $fechaEntera);
    $mes = date("m", $fechaEntera);
    $dia = date("d", $fechaEntera);

    $hora = date("H", $fechaEntera);
    $minutos = date("i", $fechaEntera);
    $segundos = date("s", $fechaEntera);

    #Notar que es lo mismo que hacer
    # date("Y-m-d H:i:s")

    $numero = $anio . $mes . $dia . $hora . $minutos . $segundos;
    echo $numero;
    //echo $anio . $mes . $dia . $hora . $minutos . $segundos;
    echo "<br>";

    $fecha = $dia . "-" . $mes . "-" . $anio;
    echo $fecha;
    echo "<br>";
    $semana = date('W',  mktime(0, 0, 0, $mes, $dia, $anio));
    echo "Semana: " . $semana;
    echo "<br>";
    echo "mes: " . $mes;


    include("conexion.php");

    $registros = $base->query("SELECT * FROM recaudacion")->fetchAll(PDO::FETCH_OBJ);

    // parte del insert
    if (isset($_POST["cr"])) {
        $uni = $_POST["Uni"];
        $fecha = $_POST["Fecha"];
        $nuevo = $_POST["Nuevo"];
        $anterior = $_POST['Anterior'];
        $sem = $_POST["Semana"];
        $mes = $_POST["Mes"];

        $sql = "INSERT INTO recaudacion (unidad, fecha, nuevo, anterior, semana, mes) VALUES (:uni, :fecha, :nue, :ant, :sem, :mes)";

        $resultado = $base->prepare($sql);
        $resultado->execute(array(
            ":uni" => $uni,
            ":fecha" => $fecha,
            ":nue" => $nuevo,
            ":ant" => $anterior,
            ":sem" => $sem,
            ":mes" => $mes
        ));
        header("location:index.php");
    }


    ?>

    <h1>Recaudación</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table width="50%" border="0" align="center">
            <tr>
                <td class="primera_fila">Id</td>
                <td class="primera_fila">Unidad</td>
                <td class="primera_fila">Fecha ultimo viaje</td>
                <td class="primera_fila">Fecha nueva</td>
                <td class="primera_fila">Importe ultimo viaje</td>
                <td class="primera_fila">Recaudacion diaria</td>
                <td class="primera_fila">es semana Nueva?</td>
                <td class="primera_fila">Semana</td>
                <td class="primera_fila">Mes</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
            </tr>



            <?php

            foreach ($registros as $unidad) :

            ?>

                <tr>
                    <td><?php echo $unidad->id ?> </td>
                    <td><?php echo $unidad->unidad ?></td>
                    <td><?php echo $unidad->fecha ?></td>
                    <td>
                        <?php
                        $DateAndTime = date('Y-m-d', time());
                        if ($DateAndTime <> $unidad->fecha) {
                            echo "Dia distinto";
                        }
                        ?>
                    </td>
                    <td><?php echo $unidad->nuevo ?></td>
                    <td><?php echo $unidad->suma_viajes ?></td>
                    <td><?php //echo $unidad->semana 

                        $semana = date('W',  mktime(0, 0, 0, $mes, $dia, $anio));
                        $semana_actual = $semana;
                        if ($unidad->semana <> $semana) {
                            echo $semana_actual . " si";
                        } else {
                            echo $semana_actual . "no";
                        }


                        ?></td>
                    <td><?php echo $unidad->mes ?></td>
                    <td class="bot"><a href="borrar.php?id=<?php echo $unidad->id ?>"><input type='button' name='del' id='del' value='Borrar'></a></td>


                    <td class='bot'><a href="editar.php?id=<?php echo $unidad->id ?> 
                                                           & unidad=<?php echo $unidad->unidad ?> 
                                                           & fecha=<?php echo $unidad->fecha ?> 
                                                           & anterior=<?php echo $unidad->nuevo ?>
                                                           & nuevo=<?php echo $unidad->suma_viajes ?>
                                                  
                                                           & semana=<?php echo $unidad->semana ?>
                                                           & mes=<?php echo $unidad->mes ?>">

                            <input type='button' name='up' id='up' value='Actualizar'></a></td>


                </tr>
            <?php

            endforeach;


            ?>

            <tr>
                <td></td>
                <td><input type='text' name='Uni' size='10' class='centrado'></td>
                <td><input type='text' name='Fecha' size='10' class='centrado'></td>
                <td><input type='text' name='Nuevo' size='10' class='centrado'></td>
                <td><input type="text" name="Anterior" size="10" class="centrado"></td>
                <td><input type='text' name='Semana' size='10' class='centrado'></td>
                <td><input type='text' name='Mes' size='10' class='centrado'></td>
                <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
            </tr>
        </table>
    </form>

    <p>&nbsp;</p>

</body>

</html>