<?php
$nuevaCoor = "";
require_once("datos.php");
//$ct = $_REQUEST["tipo"];

$ct = 1;
$con = mysqli_connect($host, $user, $pass, $db_name) or die('Error con la conexion de la base de datos');
$query = "SELECT * FROM mapa_marcador WHERE categoria = $ct";


$result = mysqli_query($con, $query);
$i = 0;
$rows = $result->num_rows;

while ($row = mysqli_fetch_array($result)) {
  extract($row);
  $resultado[$i][0] = $movil;
  $resultado[$i][1] = $descripcion;
  $resultado[$i][2] = $coordenadas;
  $resultado[$i][3] = $color;
  $resultado[$i][4] = $celu;
  $i++;
}
$resultado = json_encode($resultado);

mysqli_close($con);

echo $resultado;
