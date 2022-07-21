<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Documento sin título</title>
  <link rel="stylesheet" type="text/css" href="hoja.css">
  <script>
    function sumar() {

      var total = 0;

      $(".monto").each(function() {

        if (isNaN(parseFloat($(this).val()))) {

          total += 0;

        } else {

          total += parseFloat($(this).val());

        }

      });

      //alert(total);
      document.getElementById('spTotal').innerHTML = total;

    }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>

  <h1>ACTUALIZAR</h1>
  <?php

  include("conexion.php");



  if (!isset($_POST["bot_actualizar"])) {


    $id = $_GET["id"];
    $unidad = $_GET["unidad"];
    $fecha = $_GET["fecha"];
    $nuevo = $_GET["nuevo"];

    $semana = $_GET["semana"];
    $mes = $_GET["mes"];
  } else {
    $id = $_POST["id"];
    $unidad = $_POST["unidad"];
    $anterior = $_POST["anterior"];
    $nuevo = $_POST["nuevo"];
    $semana = $_POST["semana"];
    $mes = $_POST["mes"];
    $semana = $_POST["semana"];
    $mes = $_POST["mes"];



    /*
    $graba_fecha = "INSERT INTO `recaudacion`(`fecha`) VALUES (CURRENT_TIMESTAMP)";
    $res = $base->prepare($graba_fecha);
    $res->execute(array(":uni" => $uni, ":fecha" => $fecha, ":nue" => $actu, ":dia" => $dia, ":sem" => $sem, ":mes" => $mes));
*/

    $sql = "UPDATE recaudacion SET unidad=:miUni, 
                                    fecha=CURRENT_TIMESTAMP,
                                    /*fecha=:miFecha, */
                                    nuevo=:miNuevo, 
                                    anterior=:miAnterior,
                                    suma_viajes=:miNuevo+:miAnterior,                                     
                                    semana=:miSemana, 
                                    mes=:miMes 
                                          WHERE id=:miId";
    $resultado = $base->prepare($sql);
    $resultado->execute(array(
      ":miId" => $id,
      ":miUni" => $unidad,
      ":miFecha" => $fecha,
      ":miNuevo" => $nuevo,
      ":miAnterior" => $anterior,
      ":misumaViajes" => $suma_viajes,
      ":miSemana" => $semana,
      ":miMes" => $mes
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
        <td>Unidad</td>
        <td><label for="unidad"></label>
          <input type="text" name="unidad" id="unidad" value="<?php echo $unidad; ?>" readonly>
        </td>
      </tr>
      <tr>
        <td>Fecha</td>
        <td><label for="fecha"></label>
          <input type="text" name="fecha" id="fecha" value="<?php echo $fecha; ?>" readonly>
        </td>
      </tr>
      <tr>
        <td>Anterior</td>
        <td><label for="anterior"></label>
          <input type="text" name="anterior" id="anterior" value="<?php echo $nuevo ?>" readonly>
        </td>
      </tr>
      <tr>
        <td>Nuevo Viaje</td>
        <td><label for="nuevo"></label>
          <input type="text" name="nuevo" id="nuevo" value="">
        </td>
      </tr>
      <tr>
        <td>Semana</td>
        <td><label for="semana"></label>
          <input type="text" name="semana" id="semana" value="<?php echo $semana ?>" readonly>
        </td>
      </tr>
      <tr>
        <td>Mes</td>
        <td><label for="mes"></label>
          <input type="text" name="mes" id="mes" value="<?php echo $mes ?>" readonly>
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
      </tr>
    </table>
  </form>
  <p>&nbsp;</p>

  <span>Valor #1</span>
  <input type="text" id="txt_campo_1" class="monto" onkeyup="sumar();" />
  <br />

  <span>Valor #2</span>
  <input type="text" id="txt_campo_2" class="monto" onkeyup="sumar();" />
  <br />

  <span>Valor #3</span>
  <input type="text" id="txt_campo_3" class="monto" onkeyup="sumar();" />
  <br />

  <span>El resultado es: </span> <span id="spTotal"></span>


</body>

</html>