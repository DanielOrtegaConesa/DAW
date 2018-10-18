<?php
include "funciones.php";
include "funcionesEspecificas.php";
function generaArrayVacio()
{
    $array = Array();
    /* $array["seccion_1"]["74445783G"] = array(
         "nombre" => "Daniel",
         "apellidos" => "Ortega Conesa",
         "horas" => "80",
     );

     $array["seccion_1"]["1111111H"] = array(
         "nombre" => "Dani",
         "apellidos" => "Orte Cone",
         "horas" => "80",
     );*/

    $array["seccion_1"] = array();
    $array["seccion_2"] = array();
    $array["seccion_3"] = array();
    $array["seccion_4"] = array();
    $array["seccion_5"] = array();

    return $array;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <meta name="description" content="Mi pagina">
    <meta name="author" content="Dani">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="contenedor">

    <?php
    if (!isset($_POST["empresaencadena"])) {
        $empresa = generaArrayVacio();
    } else {
        $empresa = cadenaurl_a_array($_POST["empresaencadena"]);
    }
    ?>

    <div class="top">
        <?php
        ponermenu($empresa);
        ?>
    </div>

    <div class="principal">
        <div class="derecha">

            <h1>Actualmente nuestros trabajadores son los siguientes:</h1>
            <hr/>
            <br/>
            <?php
            foreach ($empresa as $nseccion => $seccion) {
                $totalbruto = 0;
                $totalneto = 0;
                $totalimpuesto = 0;
                $totalhoras = 0;

                switch ($nseccion) {
                    case "seccion_1":
                        echo "<h2 align='center'>SECCION 1</h2>";
                        break;
                    case "seccion_2":
                        echo "<h2 align='center'>SECCION 2</h2>";
                        break;
                    case "seccion_3":
                        echo "<h2 align='center'>SECCION 3</h2>";
                        break;
                    case "seccion_4":
                        echo "<h2 align='center'>SECCION 4</h2>";
                        break;
                    case "seccion_5":
                        echo "<h2 align='center'>SECCION 5</h2>";
                        break;
                }

                if (empty($seccion)) {
                    echo "Sin trabajadores";
                } else {
                    echo "<table border='1'>";
                    echo "<th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Horas</th><th>Suelo bruto</th><th>Sueldo neto</th><th>Impuestos</th>";

                    $contador = 0;
                    foreach ($seccion as $indice => $trabajador) {
                        $horas = $trabajador["horas"];
                        $neto =
                        $bruto = sueldobruto($trabajador["horas"]);
                        $impuestos = impuestos($trabajador["horas"]);
                        if(($contador%2)==0){
                            echo "<tr class='impar'>";
                        }else{
                            echo "<tr class='par'>";
                        }
                        echo "
                                <td>" . $trabajador["nombre"] . "</td>
                                <td>" . $trabajador["apellidos"] . "</td>
                                <td>" . strtoupper($indice) . "</td>
                                <td>" . $horas . "</td>
                                <td>" . $bruto . "€</td>
                                <td>" . ($bruto - $impuestos) . "€</td>
                                <td>" . $impuestos . "€</td>";
                        $totalbruto += $bruto;
                        $totalneto += $neto;
                        $totalimpuesto += $impuestos;
                        $totalhoras += $horas;
                        $contador++;
                    }
                    echo "</table>";
                    echo "<p>El total <b>Bruto</b> es de: " . $totalbruto . "€</p>";
                    echo "<p>El total <b>Neto</b> es de: " . ($totalneto-$impuestos) . "€</p>";
                    echo "<p>El total de <b>impuestos</b> es de: " . $totalimpuesto . "€</p>";
                    echo "<p>El total de <b>Horas</b> es de: " . $totalhoras . "</p>";
                    echo "<br/><br/><br/>";
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>