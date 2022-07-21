<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/alineas.css"> <!-- Trabajae con este archivo de ahora en mas -->
</head>

<body>
    <?php

    include_once('../include/db.php');

    $mibusqueda = $_GET['buscar'];
    $mipag = $_SERVER["PHP_SELF"];




    //$busca = "SELECT * FROM 'valores_fijos_cctes' WHERE cc='101'";

    if ($mibusqueda != NULL) {          //Si $mibusqueda es diferente de numo
        ejecuta_consulta($mibusqueda);
    } else {

        echo "<form action='"  . $mipag . "' method='get'>
            <label>Buscar: <input type='text' name='buscar'></label>
            <input type='submit' name='enviando' value='Dale!'>
        </form>";
    }
    ?>

    ?>
</body>

</html>