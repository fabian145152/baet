<?php

include("conexion.php");

$id = $_GET["id"];

$base->query("DELETE FROM recaudacion WHERE id='$id'");

header("location:index.php");
