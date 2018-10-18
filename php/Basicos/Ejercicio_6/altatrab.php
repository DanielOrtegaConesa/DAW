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
        ?>

        <div class="top">
            <?php
            ponermenu($empresa);
            ?>
        </div>

        <div class="principal">
            <div class="derecha">

                <!-- Si no se le ha dado de alta o las horas superan a 50 -->
                <?php if ((!isset($_POST["alta"])) || (isset($_POST["horas"]) && ($_POST["horas"] > 50))) {
                    if (isset($_POST["nombre"])) {
                        $nombre = $_POST["nombre"];
                        $apellidos = $_POST["apellidos"];
                        $dni = $_POST["dni"];
                        $horas = $_POST["horas"];
                    } else {
                        $nombre = "";
                        $apellidos = "";
                        $dni = "";
                        $horas = "";
                    }
                    $dni = strtoupper($dni);

                    if (isset($_POST["horas"]) && ($_POST["horas"] > 50)) {
                        echo "<p>El limite de horas esta establecido en 50, introducelas de nuevo</p>";
                    }
                    ?>
                    <form action="altatrab.php" method="post">
                        <fieldset>
                            <legend>Alta trabajador</legend>
                            <input type="hidden" name="empresaencadena" value="<?= $_POST["empresaencadena"] ?>">
                            <ul>
                                <li>Nombre: <input type="text" name="nombre" value="<?= $nombre ?>"></li>
                                <li>Apellidos: <input type="text" name="apellidos" value="<?= $apellidos ?>"></li>
                                <li>Dni: <input type="text" name="dni" placeholder="NNNNNNNNNL" value="<?= $dni ?>">
                                </li>
                                <li>Horas trabajadas: <input type="text" name="horas" value="<?= $horas ?>"></li>
                                <li>Seccion:
                                    <select name="seccion">
                                        <option value="seccion_1">seccion 1</option>
                                        <option value="seccion_2">seccion 2</option>
                                        <option value="seccion_3">seccion 3</option>
                                        <option value="seccion_4">seccion 4</option>
                                        <option value="seccion_5">seccion 5</option>
                                    </select>
                                </li>
                                <li><input type="submit" name="alta" value="Dar de alta"></li>
                            </ul>

                        </fieldset>
                    </form>

                    <!-- Si ya se ha dado de alta  -->
                <?php } else {
                    $nombre = $_POST["nombre"];
                    $apellidos = $_POST["apellidos"];
                    $dni = $_POST["dni"];
                    $dni = strtoupper($dni);
                    $horas = $_POST["horas"]; //<-- decir que se  permiten decimales, pero solo se pagan horas enteras
                    if (strlen($horas) == 0) {    // <---- decir en manual
                        $horas = 0;
                    }
                    if (!esnumero($horas)) {    // <---- decir en manual
                        $horas = 0;
                    }
                    if ($horas<0) {    // <---- decir en manual
                        $horas = 0;
                    }

                    $seccion = $_POST["seccion"];

                    //convertimos la cadena a array
                    if (strlen($nombre) != 0) {
                        $empresa = cadenaurl_a_array($_POST["empresaencadena"]);

                        //introducimos los datos siempre que no esten
                        // siempre debe ser valido el dni
                        if (comprobardni($dni) == "OK") {
                            if (!isset($empresa[$seccion][$dni])) {
                                $empresa[$seccion][$dni] = array(
                                    "nombre" => $nombre,
                                    "apellidos" => $apellidos,
                                    "horas" => $horas,
                                );
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
                                echo "El dni de la persona ya esta introducido";
                                $empresaencadena = array_a_cadenaurl($empresa);
                                ?>
                                <form action="altatrab.php" method="post">
                                    <input type="hidden" name="empresaencadena" value="<?= $empresaencadena ?>">
                                    <input type="hidden" name="nombre" value="<?= $nombre ?>">
                                    <input type="hidden" name="apellidos" value="<?= $apellidos ?>">
                                    <input type="hidden" name="dni" value="<?= $dni ?>">
                                    <input type="hidden" name="horas" value="<?= $horas ?>"></li>
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
                            <form action="altatrab.php" method="post">
                                <input type="hidden" name="empresaencadena" value="<?= $empresaencadena ?>">
                                <input type="hidden" name="nombre" value="<?= $nombre ?>">
                                <input type="hidden" name="apellidos" value="<?= $apellidos ?>">
                                <input type="hidden" name="dni" value="<?= $dni ?>">
                                <input type="hidden" name="horas" value="<?= $horas ?>"></li>
                                <input type="submit" name="intentar" value="Volver a intentarlo">
                            </form>
                            <?php
                        }
                    } else {
                        echo "No has introducido un nombre para tu trabajador";
                        $empresaencadena = array_a_cadenaurl($empresa);
                        ?>
                        <form action="altatrab.php" method="post">
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