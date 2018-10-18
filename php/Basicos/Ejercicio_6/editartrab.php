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
        $dni = $_POST["dni"];
        $seccion = $_POST["seccion"];
        ?>

        <div class="top">
            <?php
            ponermenu($empresa);
            ?>
        </div>

        <div class="principal">
            <div class="derecha">

                <?php if ((!isset($_POST["modifi"])) || (isset($_POST["horas"]) && ($_POST["horas"] > 50))) {

                    if (isset($_POST["horas"]) && ($_POST["horas"] > 50)) {
                        echo "<p>El limite de horas esta establecido en 50, introducelas de nuevo</p>";
                    }

                    ?>

                    <form action="editartrab.php" method="post">
                        <fieldset>
                            <legend>Modificar trabajador</legend>
                            <p>No introduzcas datos y no se modificaran estos</p>
                            <p>Datos de el trabajador con dni: <?= $dni ?></p>
                            <input type="hidden" name="empresaencadena" value="<?= $_POST["empresaencadena"] ?>">
                            <input type="hidden" name="dni" value="<?= $dni ?>">
                            <input type="hidden" name="seccion" value="<?= $seccion ?>">
                            <ul>
                                <li>Nombre: <input type="text" name="nombre"></li>
                                <li>Apellidos: <input type="text" name="apellidos"></li>
                                <li>Horas trabajadas: <input type="text" name="horas"></li>
                                <li><input type="submit" name="modifi" value="Modificar"></li>
                            </ul>

                        </fieldset>
                    </form>

                <?php } else {
                    if ($_POST["nombre"] != "") {
                        $nombre = $_POST["nombre"];
                    } else {
                        $nombre = $empresa[$seccion][$dni]["nombre"];
                    }

                    if ($_POST["apellidos"] != "") {
                        $apellidos = $_POST["apellidos"];
                    } else {
                        $apellidos = $empresa[$seccion][$dni]["apellidos"];
                    }

                    $dni = $_POST["dni"];

                    if ($_POST["horas"] != "") {
                        $horas = $_POST["horas"];

                        if (!esnumero($horas)) {
                            $horas = 0;
                        }
                        if ($horas<0) {    // <---- decir en manual
                            $horas = 0;
                        }
                    } else {
                        $horas = $empresa[$seccion][$dni]["horas"];
                    }

                    $seccion = $_POST["seccion"];

                    //convertimos la cadena a array
                    if (strlen($nombre) != 0) {
                        $empresa = cadenaurl_a_array($_POST["empresaencadena"]);

                        //introducimos los datos siempre que no esten
                        // siempre debe ser valido el dni
                        if (comprobardni($dni) == "OK") {
                            if (isset($empresa[$seccion][$dni])) {
                                $empresa[$seccion][$dni] = array(
                                    "nombre" => $nombre,
                                    "apellidos" => $apellidos,
                                    "horas" => $horas,
                                );
                            }

                            $empresaencadena = array_a_cadenaurl($empresa);
                            //volvemos a enviar el array en formato cadena, esta vez con los datos

                            //confirmacion
                            echo "Vas a introducir los siguientes datos:<br/> <strong>" . $nombre . " " . $apellidos . "</strong> con dni: " . $dni . ", Horas trabajadas " . $horas;
                            ?>
                            <form action="inicio.php" method="post">
                                <input type="hidden" name="empresaencadena" value="<?= $empresaencadena ?>">
                                <input type="submit" value="confirmar">
                            </form>
                            <?php
                        } else {
                            echo comprobardni($dni);
                        }
                    } else {
                        echo "No has introducido un nombre para tu trabajador";
                        $empresaencadena = array_a_cadenaurl($empresa)
                        ?>
                        <form action="altatrab.php" method="post">
                            <input type="hidden" name="empresaencadena" value="<?= $empresaencadena ?>">
                            <input type="submit" value="Volver a intentarlo">
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