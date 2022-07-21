<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            text-align: center;
            font-size: larger;
        }
    </style>
</head>

<body>
    <h1>Calculador de Viajes por Km</h1>
    <p>Por favor, introduce dos números:</p>

    <br>
    <input id="distancia_recorrida">
    <br>
    <button type="button" onclick="calcular()">Calcular</button>
    <p id="sumando"></p>
    <p id="calc"></p>
    <script>
        function calcular() {
            var kilometros;
            var ficha = 14.4;
            var bajada = 10;
            var km = 5;
            var adicional = 6;
            var trafico = 1.195;
            var noche = 1.2;
            var remis_cap = 1310;
            var remis_prov = 1630;
            var remis_prov_16_a_20 = 1960
            var km_remis = 97.4;


            kilometros = document.getElementById("distancia_recorrida").value;
            text = kilometros;

            if (isNaN(kilometros)) {
                text = "Introduzca numeros reales";
            } else {
                bajada_de_bandera = parseFloat(ficha) * parseFloat(bajada); //precio de ficha * 10
                cant_de_fichas = parseFloat(kilometros) * parseFloat(km); //6 fichas por km
                add = parseFloat(ficha) * parseFloat(adicional); //6 fichas
                //total = (parseFloat(kilometros) * parseFloat(km) * parseFloat(ficha) + parseFloat(add)) + ((parseFloat(kilometros) * parseFloat(km) * parseFloat(ficha) + parseFloat(add) * parseFloat(trafico)) * parseFloat(trafico));
                importe_limpio = parseFloat(cant_de_fichas) * parseFloat(ficha); //sin adicional - sin trafico
                total = bajada_de_bandera + add + importe_limpio * parseFloat(trafico);
                total_noche = parseFloat(total) * parseFloat(noche);

                importe_limpio = importe_limpio.toFixed(2);
                total = total.toFixed(2);
                total_noche = total_noche.toFixed(2);

                remis_mas_de_20 = kilometros * km_remis;
                mas_de_20 = remis_mas_de_20.toFixed(2);

                if (kilometros <= 10) {

                    text = "Importe Taxi 6 a 22: " + "$" + total + "-" + "<br>" +
                        "Importe Taxi 22 a 6: " + "$" + total_noche + "-" + "<br>" +
                        "Remis Capital Hasta 10 Km: " + "$" + remis_cap + "-" + "<br>";

                } else if (kilometros <= 15) {
                    text = "Importe de 6 a 22: " + "$" + total + "-" + "<br>" +
                        "Importe de 22 a 6: " + "$" + total_noche + "-" + "<br>" +
                        "Remis Provincia hasta 15 Km: " + "$" + remis_prov + "-" + "<br>";
                } else {

                    text = "Importe Taxi 6 a 22: " + "$" + total + "-" + "<br>" +
                        "Importe Taxi 22 a 6: " + "$" + total_noche + "-" + "<br>" +
                        "Importe Remis Mas de 20 km: " + "$" + mas_de_20 + "-" + "<br>";
                }

            }
            document.getElementById("calc").innerHTML = text;
        }
    </script>
</body>

</html>