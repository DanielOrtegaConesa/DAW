<?php
include "funciones.php";

function mostrar($array)
{
    $arraycadena = array_a_cadenaurl($array);

    echo "<table>";
    for ($f = 0; $f < 4; $f++) {
        ?>
        <tr>
            <?php
            for ($c = 0; $c < 25; $c++) {
                if ($array[$f][$c] == "l") {
                    ?>
                    <form action="inicio.php" method="post">
                        <input type="hidden" name="f" value="<?= $f ?>">
                        <input type="hidden" name="c" value="<?= $c ?>">
                        <input type="hidden" name="arraycadena" value="<?= $arraycadena ?>">
                        <td><input type=image src="imagenes/asientoazul.png" width="40" height="35"></td>
                    </form>
                    <?php
                } else {
                    ?>
                    <form action="inicio.php" method="post">
                        <input type="hidden" name="f" value="<?= $f ?>">
                        <input type="hidden" name="c" value="<?= $c ?>">
                        <input type="hidden" name="arraycadena" value="<?= $arraycadena ?>">
                        <td><input type=image src="imagenes/asientorojo.png" width="40" height="35"></td>
                    </form>
                    <?php
                }
            }
            ?>
        </tr>
        <?php

    }
    echo "</table>";
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
    <meta name="description" content="Mi pagina">
    <meta name="author" content="Dani">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="avion">
    <?php
    if (isset($_POST["arraycadena"])) {
        $arraycadena = $_POST["arraycadena"];
        $asientos = cadenaurl_a_array($arraycadena);

        $f = $_POST["f"];
        $c = $_POST["c"];

        if ($asientos[$f][$c] == "r") {
            $asientos[$f][$c] = "l";
        } else {
            $asientos[$f][$c] = "r";
        }

    } else {

        for ($f = 0; $f < 4; $f++) {
            for ($c = 0; $c < 25; $c++) {
                $asientos[$f][$c] = "l";
            }
        }
    }

    mostrar($asientos);

    ?>

</div>
</body>
</html>