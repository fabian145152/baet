<?php

include("../include/coneccion.php");


$id = $_GET["id"];

$base->query("DELETE FROM valores_fijos_cctes WHERE id='$id'");

header("location:index.php");
