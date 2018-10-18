<?php
include "funciones.php";

// define el tamaño
if (isset($_POST["tamanyo"])) {
    $tamanyo = $_POST["tamanyo"];
} else {
    $tamanyo = 4;
}

function aleatorio($tamanyo)
{
    return rand(0, $tamanyo);
}

/*
 Muestra el mapa y genera las posiciones de los elementos
 * */
function mostrar($array, $tamanyo)
{

    if (!isset($_POST["ftesoro"])) {

        $ftesoro = aleatorio($tamanyo - 1);
        $ctesoro = aleatorio($tamanyo - 1);

        for ($c = 0; $c < $tamanyo / 2; $c++) {
            $flago[] = aleatorio($tamanyo - 1);
            $clago[] = aleatorio($tamanyo - 1);

            $ftrampa[] = aleatorio($tamanyo - 1);
            $ctrampa[] = aleatorio($tamanyo - 1);

        }

    } else {
        $ftesoro = $_POST["ftesoro"];
        $ctesoro = $_POST["ctesoro"];

        $flago = cadenaurl_a_array($_POST["flagocadena"]);
        $clago = cadenaurl_a_array($_POST["clagocadena"]);

        $ftrampa = cadenaurl_a_array($_POST["ftrampacadena"]);
        $ctrampa = cadenaurl_a_array($_POST["ctrampacadena"]);
    }

    $tablerocadena = array_a_cadenaurl($array);

    $flagocadena = array_a_cadenaurl($flago);
    $clagocadena = array_a_cadenaurl($clago);

    $ftrampacadena = array_a_cadenaurl($ftrampa);
    $ctrampacadena = array_a_cadenaurl($ctrampa);


    echo "<table>";
    for ($f = 0; $f < $tamanyo; $f++) {
        ?>
        <tr>
            <?php
            for ($c = 0; $c < $tamanyo; $c++) {
                if ($array[$f][$c] == "na") {
                    ?>
                    <form action="inicio.php" method="POST">
                        <input type="hidden" name="ftesoro" value="<?= $ftesoro ?>">
                        <input type="hidden" name="ctesoro" value="<?= $ctesoro ?>">

                        <input type="hidden" name="flagocadena" value="<?= $flagocadena ?>">
                        <input type="hidden" name="clagocadena" value="<?= $clagocadena ?>">

                        <input type="hidden" name="ftrampacadena" value="<?= $ftrampacadena ?>">
                        <input type="hidden" name="ctrampacadena" value="<?= $ctrampacadena ?>">

                        <input type="hidden" name="f" value="<?= $f ?>">
                        <input type="hidden" name="c" value="<?= $c ?>">
                        <input type="hidden" name="tablerocadena" value="<?= $tablerocadena ?>">
                        <input type="hidden" name="tamanyo" value="<?= $tamanyo ?>">
                        <td><input type=image src="imagenes/nadaarena.jpg" width="70" height="60"></td>
                    </form>
                    <?php
                } else if ($array[$f][$c] == "te") {
                    ?>
                    <form action="inicio.php" method="POST">
                        <input type="hidden" name="ftesoro" value="<?= $ftesoro ?>">
                        <input type="hidden" name="ctesoro" value="<?= $ctesoro ?>">

                        <input type="hidden" name="flagocadena" value="<?= $flagocadena ?>">
                        <input type="hidden" name="clagocadena" value="<?= $clagocadena ?>">

                        <input type="hidden" name="ftrampacadena" value="<?= $ftrampacadena ?>">
                        <input type="hidden" name="ctrampacadena" value="<?= $ctrampacadena ?>">

                        <input type="hidden" name="f" value="<?= $f ?>">
                        <input type="hidden" name="c" value="<?= $c ?>">
                        <input type="hidden" name="tablerocadena" value="<?= $tablerocadena ?>">
                        <input type="hidden" name="tamanyo" value="<?= $tamanyo ?>">
                        <td><input type=image src="imagenes/tesoroarena.jpg" width="70" height="60"></td>
                    </form>
                    <?php
                } else if ($array[$f][$c] == "la") {
                    ?>
                    <form action="inicio.php" method="POST">
                        <input type="hidden" name="ftesoro" value="<?= $ftesoro ?>">
                        <input type="hidden" name="ctesoro" value="<?= $ctesoro ?>">

                        <input type="hidden" name="flagocadena" value="<?= $flagocadena ?>">
                        <input type="hidden" name="clagocadena" value="<?= $clagocadena ?>">

                        <input type="hidden" name="ftrampacadena" value="<?= $ftrampacadena ?>">
                        <input type="hidden" name="ctrampacadena" value="<?= $ctrampacadena ?>">

                        <input type="hidden" name="f" value="<?= $f ?>">
                        <input type="hidden" name="c" value="<?= $c ?>">
                        <input type="hidden" name="tablerocadena" value="<?= $tablerocadena ?>">
                        <input type="hidden" name="tamanyo" value="<?= $tamanyo ?>">
                        <td><input type=image src="imagenes/lagoarena.jpg" width="70" height="60"></td>
                    </form>
                    <?php
                } else if ($array[$f][$c] == "tr") {

                    ?>
                    <form action="inicio.php" method="POST">
                        <input type="hidden" name="ftesoro" value="<?= $ftesoro ?>">
                        <input type="hidden" name="ctesoro" value="<?= $ctesoro ?>">

                        <input type="hidden" name="flagocadena" value="<?= $flagocadena ?>">
                        <input type="hidden" name="clagocadena" value="<?= $clagocadena ?>">

                        <input type="hidden" name="ftrampacadena" value="<?= $ftrampacadena ?>">
                        <input type="hidden" name="ctrampacadena" value="<?= $ctrampacadena ?>">

                        <input type="hidden" name="f" value="<?= $f ?>">
                        <input type="hidden" name="c" value="<?= $c ?>">
                        <input type="hidden" name="tablerocadena" value="<?= $tablerocadena ?>">
                        <input type="hidden" name="tamanyo" value="<?= $tamanyo ?>">
                        <td><input type=image src="imagenes/trampaarena.jpg" width="70" height="60"></td>
                    </form>
                    <?php
                } else {
                    ?>
                    <form action="inicio.php" method="POST">
                        <input type="hidden" name="ftesoro" value="<?= $ftesoro ?>">
                        <input type="hidden" name="ctesoro" value="<?= $ctesoro ?>">

                        <input type="hidden" name="flagocadena" value="<?= $flagocadena ?>">
                        <input type="hidden" name="clagocadena" value="<?= $clagocadena ?>">

                        <input type="hidden" name="ftrampacadena" value="<?= $ftrampacadena ?>">
                        <input type="hidden" name="ctrampacadena" value="<?= $ctrampacadena ?>">

                        <input type="hidden" name="f" value="<?= $f ?>">
                        <input type="hidden" name="c" value="<?= $c ?>">
                        <input type="hidden" name="tablerocadena" value="<?= $tablerocadena ?>">
                        <input type="hidden" name="tamanyo" value="<?= $tamanyo ?>">
                        <td><input type=image src="imagenes/arena.jpg" width="70" height="60"></td>
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
<div class="contenedor">
    <div class="menu">
        <form action="inicio.php" method="POST">
            <ul>
                <li>Tamaño del tablero: <select name="tamanyo">
                        <option value="4">Pequeño</option>
                        <option value="6">Mediano</option>
                        <option value="8">Grande</option>
                        <option value="10">Gigante</option>
                    </select>
                </li>
                <input type="image" src="imagenes/enviar.png" width="200" height="70">
            </ul>
        </form>
        <p>LEYENDA </p>
        <p><img src="imagenes/arena.jpg" width="70" height="60">: Zona inexplorada </p>
        <p><img src="imagenes/trampaarena.jpg" width="70" height="60">: Trampa escondida por piratas</p>
        <p><img src="imagenes/lagoarena.jpg" width="70" height="60">: Lago para refrescarse</p>
        <p><img src="imagenes/nadaarena.jpg" width="70" height="60">: Zona vacia ya expolorada</p>
        <p><img src="imagenes/tesoroarena.jpg" width="70" height="60">: El tesoro </p>
        <p></p>
    </div>

    <div class="tablero">
        <?php
        if (isset($_POST["tablerocadena"])) {

            $tablerocadena = $_POST["tablerocadena"];
            $tablero = cadenaurl_a_array($tablerocadena);

            $f = $_POST["f"];
            $c = $_POST["c"];

            $ftesoro = $_POST["ftesoro"];
            $ctesoro = $_POST["ctesoro"];

            $flago = cadenaurl_a_array($_POST["flagocadena"]);
            $clago = cadenaurl_a_array($_POST["clagocadena"]);

            $ftrampa = cadenaurl_a_array($_POST["ftrampacadena"]);
            $ctrampa = cadenaurl_a_array($_POST["ctrampacadena"]);

            $si = true;
            for ($i = 0; $i < $tamanyo / 2; $i++) {
                if ($f == $ftesoro && $c == $ctesoro) {
                    if ($si) {
                        $tablero[$f][$c] = "te";
                        echo "<h1>¡Has encontrado el tesoro! </h1>";
                        $si = false;
                    }

                } else if ($f == $flago[$i] && $c == $clago[$i]) {
                   // echo "<h1>Has encontrado un lago! Utilizalo para refrescarte! </h1>";
                    $tablero[$f][$c] = "la";


                } else if ($f == $ftrampa[$i] && $c == $ctrampa[$i]) {
                    $tablero[$f][$c] = "tr";
                   // echo "<h1>Los malvados piratas habian puesto trampas, has caido en una de ellas y te han robado el mapa que tenias </h1>";
                    for ($f = 0; $f < $tamanyo; $f++) {
                        for ($c = 0; $c < $tamanyo; $c++) {
                            if ($tablero[$f][$c] != "tr") {
                                $tablero[$f][$c] = "ar";
                            }
                        }
                    }

                } else {
                    for ($x = 0; $x < $tamanyo; $x++) {
                        for ($y = 0; $y < $tamanyo; $y++) {
                            if ($x == $f && $y == $c) {
                                if ($tablero[$x][$y] != "tr" && $tablero[$x][$y] != "te" && $tablero[$x][$y] != "la") {
                                    $tablero[$x][$y] = "na";
                                }
                            }
                        }
                    }
                }
            }

        } else { //primera vez
            if (isset($_POST["tamanyo"])) {
                $tamanyo = $_POST["tamanyo"];
            }

            for ($f = 0; $f < $tamanyo; $f++) {
                for ($c = 0; $c < $tamanyo; $c++) {
                    $tablero[$f][$c] = "ar";
                }
            }

        }

        mostrar($tablero, $tamanyo);//tambien actua de formulario de envio

        ?>

    </div>
</div>
</body>
</html>