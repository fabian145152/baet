<?php
session_start();
require_once("datos.php");
$con = mysqli_connect($host, $user, $pass, $db_name) or die('Error con la conexion de la base de datos');


if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {
    $ct = $_POST['categoria'];
    $ct = 1;
    $query = "SELECT * FROM mapa_marcador WHERE categoria = $ct";
    $result = mysqli_query($con, $query);
    $rows = $result->num_rows;
    if ($rows == 0) {
        $_SESSION['busqVac'] = "No se ha encontrado ningun marcador con esta categoria";
        header("Location: usuario.php");  //Linea Original

    }
    mysqli_close($con);
} else {
    $_SESSION['busqError'] = "Selecciona una categoria por favor";

    header("Location: usuario.php");  //  Esta Linea es la original

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Moviles</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        #map {
            height: 600px;
            width: 90%;
        }
    </style>
</head>

<body>
    <h1>Ubicacion de los remises</h1>
    <div id="map"></div>
    <script>
        function initMap() {
            var divMapa = document.getElementById('map');
            var xhttp;
            var resultado = [];
            var markers = [];
            var infowindowActivo = false;

            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    resultado = xhttp.responseText;
                    var objeto_json = JSON.parse(resultado);

                    for (var i = 0; i < objeto_json.length; i++) {
                        var latlong = objeto_json[i][2].split(',');
                        myLatLng = {
                            lat: Number(latlong[0]),
                            lng: Number(latlong[1])
                        };

                        markers[i] = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            icon: objeto_json[i][3],
                            title: objeto_json[i][0],

                        });

                        var contentString = '<h1 id="firstHeading" class="firstHeading">' +

                            objeto_json[i][0] + '</h1>' + '<div id="bodyContent">' + '<p><b>' +
                            objeto_json[i][4] + '</b></p><p>' +
                            objeto_json[i][1] +
                            '</p></div>';


                        markers[i].infoWindow = new google.maps.InfoWindow({
                            content: contentString
                        });

                        google.maps.event.addListener(markers[i], 'click', function() {
                            if (infowindowActivo) {
                                infowindowActivo.close();
                            }
                            infowindowActivo = this.infoWindow;
                            infowindowActivo.open(map, this);
                        });
                    }
                }
            };

            var myLatLng = {

                lat: -34.626534,
                lng: -58.437513,
                map: map,
                icon: 'brown_markerA.png'


            };

            var map = new google.maps.Map(divMapa, {
                zoom: 11,
                center: myLatLng
            });

            //var tipo = <?php //echo $ct; 
                            ?>;
            var tipo = 1;
            var url = "marcadores_a_mostrar.php?tipo=" + tipo;
            xhttp.open("POST", url, true);
            xhttp.send();


        }
    </script>

    <a href="../coordenadas/index.php">Editar</a>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXTM8tcD_fVL09AEKUKhFyundS8el6C70&callback=initMap"></script>
</body>

</html>