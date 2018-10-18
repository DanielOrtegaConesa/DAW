<?php
if (isset($_REQUEST["usuario"])) {
    $usuario = $_REQUEST["usuario"];
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
              content="Un juego desarrollado para la asignatura de aplicaciones web en entorno servidor que tiene como base hacer combates entre digimones">
        <meta name="author" content="Daniel Ortega Conesa">
        <link rel="icon" href="../bootstrap-3.3.7/docs/favicon.ico">
        <title>Alta Usuario</title>
        <!-- Bootstrap core CSS -->
        <link href="../bootstrap-3.3.7/docs/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../bootstrap-3.3.7/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../estilos.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <?php include_once "menu.php";
    ponermenu($usuario) ?>

    <div class="container">

        <div class="principal">

            <?php
            $digievoluciones = 0;
            if (!file_exists("../../usuarios/$usuario/estadisticas.txt")) {
                $fichero = fopen("../../usuarios/$usuario/estadisticas.txt", "a+");
                fwrite($fichero, "0\t0\t0\t0");// victorias derrotas totales digievoluciones
                fclose($fichero);
            } else {
                $fichero = fopen("../../usuarios/$usuario/estadisticas.txt", "r");
                $linea = fscanf($fichero, "%s\t%s\t%s\t%s");
                list($victorias, $derrotas, $total, $digievoluciones) = $linea;
                fclose($fichero);
            }
            echo "<div class=\"bloque\">";
            echo "<h2>Dispones de $digievoluciones digievoluciones</h2>";
            echo "</div>";
            if ($digievoluciones >= 1) {

                if (isset($_REQUEST["elegido"])) {
                    if ($_REQUEST["elegido"] == "nodisponible") {
                        echo "<h2>Necesitas mas digimones antes de poder evolucionar</h2>";
                        $imposible = true;
                    }
                }

                if (!isset($_REQUEST["seleccionado"]) || isset($imposible)) {
                    ?>
                    <div class="bloque">
                        <form method="post">
                            <input type="hidden" name="usuario" value="<?= $usuario ?>">
                            <label for="elegido">Selecciona que digimon evolucionara:</label>
                            <select id="elegido" name="elegido">
                                <?php
                                if (file_exists("../../usuarios/$usuario/digimones_usuario.txt")) {
                                    $gestor = fopen("../../usuarios/$usuario/digimones_usuario.txt", "r");
                                    while ($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                                        list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                                        if ($nivel < 3) {
                                            echo "<option value='$digimon' >" . $digimon . "(Nivel:$nivel)" . "</option>";
                                            $hay=true;
                                        }
                                    }
                                    if(!isset($hay))echo "<option value='nodisponible' > No disponible </option>";
                                    fclose($gestor);
                                }
                                ?>
                            </select>
                            <input type="submit" class="btn btn-lg btn-primary" name="seleccionado"
                                   value="Digievolucionar!">
                        </form>
                    </div>
                    <?php
                } else {
                    $elegido = $_REQUEST["elegido"];

                    //////////// Vamos a ir copiando linea a linea, para ello necesitamos un fichero auxiliar  ////////////
                    /// Copiaremos linea a linea excepto si el elegido coincide con el nombre del digimon de la linea, de coincidir recorreremos todo el fichero de digimones y en el momento que coincida el digimon que leemos con el que buscamos, lo escribe
                    rename("../../usuarios/$usuario/digimones_usuario.txt", "../../usuarios/$usuario/digimones_usuarioviejo.txt");//renombramos el existente
                    $nuevofichero = fopen("../../usuarios/$usuario/digimones_usuario.txt", "a+");// creamos uno de destino en el que ir copiando

                    if (file_exists("../../usuarios/$usuario/digimones_usuarioviejo.txt")) {
                        $gestor = fopen("../../usuarios/$usuario/digimones_usuarioviejo.txt", "r");
                        while ($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                            list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;

                            if ($elegido == $digimon) {
                                if ($evolucion != "Sin_Evolucion") {
                                    if (file_exists("../../digimones.txt")) {
                                        $encontrado2 = false;
                                        $gestor2 = fopen("../../digimones.txt", "r");
                                        while (($filadigimon2 = fscanf($gestor2, "%s\t%s\t%s\n%s\t%s\t%s\n")) && ($encontrado2 == false)) {
                                            list ($digimon2, $ataque2, $defensa2, $tipo2, $nivel2, $evolucion2) = $filadigimon2;
                                            if ($evolucion == $digimon2) {
                                                fwrite($nuevofichero, $digimon2 . "\t" . $ataque2 . "\t" . $defensa2 . "\t" . $tipo2 . "\t" . $nivel2 . "\t" . $evolucion2 . "\r\n");
                                                $encontrado = true;
                                            }
                                        }
                                        fclose($gestor2);
                                    }
                                } else {
                                    $error = true;
                                    fwrite($nuevofichero, $digimon . "\t" . $ataque . "\t" . $defensa . "\t" . $tipo . "\t" . $nivel . "\t" . $evolucion . "\r\n");
                                }
                            } else {
                                fwrite($nuevofichero, $digimon . "\t" . $ataque . "\t" . $defensa . "\t" . $tipo . "\t" . $nivel . "\t" . $evolucion . "\r\n");
                            }
                        }
                        fclose($gestor);
                        fclose($nuevofichero);
                    }
                    unlink("../../usuarios/$usuario/digimones_usuarioviejo.txt"); //finalmente borramos
                    ////////////////////////

                    if (!isset($error)) {
                        if (file_exists("../../usuarios/$usuario/equipo_usuario.txt")) {
                            unlink("../../usuarios/$usuario/equipo_usuario.txt");//borramos tambien el equipo
                        }

                        //volvemos a escribir las estadisticas
                        $digievoluciones--;
                        unlink("../../usuarios/$usuario/estadisticas.txt");
                        $fichero = fopen("../../usuarios/$usuario/estadisticas.txt", "a+");
                        fwrite($fichero, "$victorias\t$derrotas\t$total\t$digievoluciones");
                        fclose($fichero);
                    }
                    if (!isset($error)) {
                        echo "<h2>Evolucion completada, vuelve a organizar tu equipo para combatir</h2>";
                    } else {
                        echo "<h2>Evolucion incompleta, El digimon que has introducido no tiene evolucion asignada</h2>";
                    }
                }

            } else {
                echo "<h2>Cada 10 partidas ganadas obtendras una digievolucion, prueba a jugar</h2>";
            }
            ?>


        </div><!-- principal -->

    </div><!-- /.container -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
    </body>

    </html>

    <?php

} else {
    header("location:login.php");
}
