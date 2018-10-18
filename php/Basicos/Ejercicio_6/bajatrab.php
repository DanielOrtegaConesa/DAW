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

                <?php if (!isset($_POST["baja"])) { ?>

                    <form action="bajatrab.php" method="post">
                        <fieldset>
                            <legend>Baja trabajador</legend>
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
                                <li><input type="submit" name="baja" value="Dar de baja"></li>
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

                    //Borramos los datos siempre que esten
                    // siempre debe ser valido el dni
                    if (comprobardni($dni) == "OK") {
                        if (isset($empresa[$seccion][$dni])) {
                            unset($empresa[$seccion][$dni]);
                            $empresaencadena = array_a_cadenaurl($empresa);
                            //volvemos a enviar el array en formato cadena, esta vez con los datos

                            //confirmacion
                            echo "Vas a eliminar al trabajador con dni:<br/> <strong>" . $dni . ", De la seccion " . $seccion;
                            ?>
                            <form action="inicio.php" method="post">
                                <input type="hidden" name="empresaencadena" value="<?= $empresaencadena ?>">
                                <input type="submit" value="confirmar">
                            </form>
                            <?php
                        } else {
                            echo "El dni de la persona No existe";
                            $empresaencadena = array_a_cadenaurl($empresa);

                            ?>
                            <form action="bajatrab.php" method="post">
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
                        <form action="bajatrab.php" method="post">
                            <input type="hidden" name="empresaencadena" value="<?= $empresaencadena ?>">
                            <input type="hidden" name="nombre" value="<?= $nombre ?>">
                            <input type="hidden" name="apellidos" value="<?= $apellidos ?>">
                            <input type="hidden" name="dni" value="<?= $dni ?>">
                            <input type="hidden" name="horas" value="<?= $horas ?>"></li>
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