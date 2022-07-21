<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <a href="../coordenadas/viajes.php">Editar Viajes</a>
    <a href="../coordenadas/mov.php">Editar Moviles</a>
    <a href="/baet/index.php">Salir</a>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXTM8tcD_fVL09AEKUKhFyundS8el6C70&callback=initMap"></script>
</body>

</html>