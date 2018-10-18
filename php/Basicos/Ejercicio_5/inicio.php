<?php
include "funciones.php";
include "funcionesEspecificas.php";
//genera inicialmente el array
function generaArrayVacio()
{
    for ($v = 0; $v < 18; $v++) {
        for ($p = 0; $p < 10; $p++) {
            $array[$v][$p] = rand(0, 9);
        }
    }
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
    <script src="prefixfree.min.js" type="text/javascript"></script>
</head>
<body>


<div class="contenedor">


    <?php
    /***
     * $negocio = array con todos los datos de vendedores y productos
     *
     */

    if (!isset($_POST["negocioencadena"])) {
        $negocio = generaArrayVacio();
    } else {
        $negocio = cadenaurl_a_array($_POST["negocioencadena"]);
    }

    ?>

    <div class="top">
        <?php ponermenu($negocio); ?>
    </div>

    <div class="principal">
        <div class="derecha">
            <h1>Actualmente nuestros datos son los siguientes:</h1>
            <?php
            echo "<table border='1' align='right'>";
            echo "<th>&nbsp;Vendedor&nbsp;</th><th>&nbsp;Producto 1&nbsp;</th><th>&nbsp;Producto 2&nbsp;</th><th>&nbsp;Producto 3&nbsp;</th><th>&nbsp;Producto 4&nbsp;</th><th>&nbsp;Producto 5&nbsp;</th><th>&nbsp;Producto 6&nbsp;</th><th>&nbsp;Producto 7&nbsp;</th><th>&nbsp;Producto 8&nbsp;</th><th>&nbsp;Producto 9&nbsp;</th><th>&nbsp;Producto 10&nbsp;</th>";
            $posicion = 0;
            foreach ($negocio as $nvendedor => $vendedor) {
                if(($posicion%2)==0) {
                    echo "<tr class='par'>";
                }else{
                    echo "<tr class='impar'>";
                }
                echo "<td>" . ($nvendedor + 1) . "</td>";
                foreach ($vendedor as $nproducto => $producto) {
                    echo "<td>$producto</td>";

                }
                $posicion++;
            }
            echo "</tr>";
            echo "</table>";
            ?>

        </div>
    </div>


</div>

</div>


</body>
</html>