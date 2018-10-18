<?php
include "funciones.php";
include "funcionesEspecificas.php";

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
    if (isset($_POST["empresaencadena"])) {
        $empresa = cadenaurl_a_array($_POST["empresaencadena"]);
        if (isset($_POST["dni"])) {
            $dni = $_POST["dni"];
        } else {
            $dni = "";
        }
        ?>

        <div class="top">
            <?php
            ponermenu($empresa);
            ?>
        </div>

        <div class="principal">
            <div class="derecha">

                <?php if (!isset($_POST["ver"])) { ?>

                    <form action="vertrab.php" method="post">
                        <fieldset>
                            <legend>Ver trabajador</legend>
                            <input type="hidden" name="empresaencadena" value="<?= $_POST["empresaencadena"] ?>">
                            <ul>
                                <li>Dni: <input type="text" name="dni" placeholder="NNNNNNNNNL" value="<?= $dni ?>">
                                </li>
                                <li>Seccion:
                                    <select name="seccion">
                                        <option value="seccion_1">seccion 1</option>
                                        <option value="seccion_2">seccion 2</option>
                                        <option value="seccion_3">seccion 3</option>
                                        <option value="seccion_4">seccion 4</option>
                                        <option value="seccion_5">seccion 5</option>
                                    </select>
                                </li>
                                <li><input type="submit" name="ver" value="Ver"></li>
                            </ul>

                        </fieldset>
                    </form>

                    <!-- Si ya se sabe cual  -->
                <?php } else {
                    $dni = $_POST["dni"];
                    $dni = strtoupper($dni);
                    $seccion = $_POST["seccion"];

                    //convertimos la cadena a array
                    $empresa = cadenaurl_a_array($_POST["empresaencadena"]);

                    //vemos los datos siempre que esten
                    // siempre debe ser valido el dni
                    if (comprobardni($dni) == "OK") {
                        if (isset($empresa[$seccion][$dni])) {
                            echo "<table border='1'>";
                            echo "<th>Nombre</th><th>Apellidos</th><th>Dni</th><th>Horas</th><th>Suelo bruto</th><th>Sueldo neto</th><th>Impuestos</th><th>Editar</th>";
                            echo "<tr>
                                <td><strong>" . $empresa[$seccion][$dni]["nombre"] . "</strong></td>
                                <td>" . $empresa[$seccion][$dni]["apellidos"] . "</td>
                                <td>" . $dni . "</td>
                                <td>" . $empresa[$seccion][$dni]["horas"] . "</td>
                                <td>" . sueldobruto($empresa[$seccion][$dni]["horas"]) . "</td>
                                <td>" . (sueldobruto($empresa[$seccion][$dni]["horas"]) - impuestos($empresa[$seccion][$dni]["horas"])) . "</td>
                                <td>" . impuestos($empresa[$seccion][$dni]["horas"]) . "</td>
                                <td>"
                            ?>
                            <form action="editartrab.php" method="POST">
                                <input type="hidden" name="empresaencadena" value="<?= $_POST["empresaencadena"] ?>">
                                <input type="hidden" name="dni" value="<?= $dni ?>">
                                <input type="hidden" name="seccion" value="<?= $seccion ?>">
                                <input type="image" src="editar.png" width="40" height="40">
                            </form>
                            <?php
                            "</td>";
                            echo "</table>";

                        } else {
                            echo "El dni de la persona No existe en nuestra base de datos";
                            $empresaencadena = array_a_cadenaurl($empresa);
                            ?>
                            <form action="vertrab.php" method="post">
                                <input type="hidden" name="empresaencadena" value="<?= $empresaencadena ?>">
                                <input type="hidden" name="dni" value="<?= $dni ?>">
                                <input type="submit" name="intentar" value="Volver a intentarlo">
                            </form>
                            <?php
                        }


                    } else {
                        $errores = comprobardni($dni);
                        foreach ($errores as $indice => $valor) {
                            echo $valor . "<br/>";
                        }
                        $empresaencadena = array_a_cadenaurl($empresa);
                        ?>
                        <form action="vertrab.php.php" method="post">
                            <input type="hidden" name="dni" value="<?= $dni ?>">
                            <input type="submit" name="intentar" value="Volver a intentarlo">
                        </form>
                        <?php
                    }

                } ?>


            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>