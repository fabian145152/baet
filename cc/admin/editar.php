<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Documento sin título</title>
    <link rel="stylesheet" type="text/css" href="../hoja.css">
    
</head>

<body>

    <h1>ACTUALIZAR</h1>
    <?php
    //------------------------------------------------------------------------
    //Hago esta linea para conectarme y guardad los datos actualizados

    include("../include/coneccion.php");
    //------------------------------------------------------------------------

    /*
  Ahora tengo que hacer un if para que me lea los $_GET cuando trae info de la otra pagina y no le el $_POST que uso para hacer el update
  */

    if (!isset($_POST["bot_actualizar"])) {
        $id = $_GET["id"];
        $cc = $_GET["cc"];
        $km = $_GET["km"];
        $pasajero = $_GET["pasajero"];
        $origen = $_GET['origen'];
        $destino = $_GET['destino'];
        $importe = $_GET['importe'];
        $obs = $_GET['obs'];
        $autoriza = $_GET['autoriza'];
    } else {

        $id = $_POST["id"];
        $cc = $_POST["cc"];
        $km = $_POST["km"];
        $pasajero = $_POST["pasajero"];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $importe = $_POST['importe'];
        $obs = $_POST['obs'];
        $autoriza = $_POST['autoriza'];



        $sql = "UPDATE valores_fijos_cctes SET cc=:miCc, km=:miKm, pasajero=:miPasajero, origen=:miOrigen, destino=:miDestino, importe=:miImporte, obs=:miObs, autoriza=:miAutoriza WHERE id=:miId";
        $resultado = $base->prepare($sql);
        $resultado->execute(array(":miId" => $id, ":miCc" => $cc, ":miKm" => $km, ":miPasajero" => $pasajero, ":miOrigen" => $origen, ":miDestino" => $destino, ":miImporte" => $importe, ":miObs" => $obs, ":miAutoriza" => $autoriza));

        header("location:index.php");
    }
    ?>

    <p>

    </p>
    <p>&nbsp;</p>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <!--
  Para usar la linea anterior me conecte a la BBDD, y use el metodo post porque si uso el get viajan en la url y se me sobreescribirian
  con PHP_SELF Mando todo a esta misma pagina

-->

        <table width="35%" border="0" align="center">
            <tr>
                <td></td>
                <td><label for="id"></label>
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    <!-- Si quiero no mostrar el id saco la etiqueta de php y listo -->
                </td>
            </tr>
            <tr>
                <td>Cuenta Corriente</td>
                <td><label for="cc"></label>
                    <input type="text" name="cc" id="cc" value="<?php echo $cc ?>">
                </td>
            </tr>
            <tr>
                <td>Kilometros</td>
                <td><label for="km"></label>
                    <input type="text" name="km" id="km" value="<?php echo $km ?>">
                </td>
            </tr>
            <tr>
                <td>Pasajero</td>
                <td><label for="pasajero"></label>
                    <input type="text" name="pasajero" id="pasajero" value="<?php echo $pasajero ?>">
                </td>
            </tr>
            <tr>
                <td>Origen</td>
                <td><label for="origen"></label>
                    <input type="text" name="origen" id="origen" value="<?php echo $origen ?>">
                </td>
            </tr>
            <tr>
                <td>Destino</td>
                <td><label for="destino"></label>
                    <input type="text" name="destino" id="destino" value="<?php echo $destino ?>">
                </td>
            </tr>
            <tr>
                <td>Importe</td>
                <td><label for="importe"></label>
                    <input type="text" name="importe" id="importe" value="<?php echo $importe ?>">
                </td>
            </tr>
            <tr>
                <td>Observaciones</td>
                <td><label for="obs"></label>
                    <input type="text" name="obs" id="obs" value="<?php echo $obs ?>">
                </td>
            </tr>
            <tr>
                <td>Autoriza</td>
                <td><label for="autoriza"></label>
                    <input type="text" name="autoriza" id="autoriza" value="<?php echo $autoriza ?>">
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