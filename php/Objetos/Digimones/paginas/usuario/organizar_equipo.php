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
        <title>Organizar Equipo</title>
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
            if (!isset($_REQUEST["nuevoequipo"])) {
                if (isset($_REQUEST["errores"])) {
                    ?>
                    <div class="errores">
                        <p>Los digimones no pueden estar repetidos</p>
                    </div>
                    <?php
                }
                if (file_exists("../../usuarios/$usuario/digimones_usuario.txt")) { ?>
                    <form method="post">
                        <label for="d1">Digimon 1</label><br/>
                        <select name="d1" id="d1">
                            <?php
                            $fichero = fopen("../../usuarios/$usuario/digimones_usuario.txt", "r");
                            while ($filadigimon = fscanf($fichero, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                                list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                                echo "<option value='$digimon'>$digimon(nivel $nivel)</option>";
                            }
                            ?>
                        </select><br/><br/>

                        <label for="d2">Digimon 2</label><br/>
                        <select name="d2" id="d2">
                            <?php
                            $fichero = fopen("../../usuarios/$usuario/digimones_usuario.txt", "r");
                            while ($filadigimon = fscanf($fichero, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                                list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                                echo "<option value='$digimon'>$digimon(nivel $nivel)</option>";
                            }
                            ?>
                        </select><br/><br/>

                        <label for="d3">Digimon 3</label><br/>
                        <select name="d3" id="d3">
                            <?php
                            $fichero = fopen("../../usuarios/$usuario/digimones_usuario.txt", "r");
                            while ($filadigimon = fscanf($fichero, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                                list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                                echo "<option value='$digimon'>$digimon(nivel $nivel)</option>";
                            }
                            ?>
                        </select><br/><br/>
                        <input type="submit" name="nuevoequipo" value="Actualizar equipo"
                               class="btn btn-lg btn-primary">
                    </form>
                <?php }

            } else {
                $d1 = $_REQUEST["d1"];
                $d2 = $_REQUEST["d2"];
                $d3 = $_REQUEST["d3"];

                // comprobamos que ninguno es el mismo
                if ($d1 == $d2 || $d1 == $d3) {
                    header("location:organizar_equipo.php?errores=iguales&usuario=$usuario");
                } else if ($d2 == $d3) {
                    header("location:organizar_equipo.php?errores=iguales&usuario=$usuario");
                }

                // creamos el fichero de nuevo
                if (file_exists("../../usuarios/$usuario/equipo_usuario.txt")) {
                    unlink("../../usuarios/$usuario/equipo_usuario.txt");
                }
                $nuevofichero = fopen("../../usuarios/$usuario/equipo_usuario.txt", "a+");

                $correcto = true;
                if (file_exists("../../usuarios/$usuario/digimones_usuario.txt")) {

                    //para el digimon 1
                    $encontrado = false;
                    $gestor = fopen("../../usuarios/$usuario/digimones_usuario.txt", "r");
                    while (($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) && ($encontrado == false)) {
                        list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                        if ($d1 == $digimon) {
                            fwrite($nuevofichero, $digimon . "\t" . $ataque . "\t" . $defensa . "\t" . $tipo . "\t" . $nivel . "\t" . $evolucion . "\r\n");
                            $encontrado = true;
                        }
                    }

                    //para el digimon 2
                    $encontrado = false;
                    $gestor = fopen("../../usuarios/$usuario/digimones_usuario.txt", "r");
                    while (($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) && ($encontrado == false)) {
                        list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                        if ($d2 == $digimon) {
                            fwrite($nuevofichero, $digimon . "\t" . $ataque . "\t" . $defensa . "\t" . $tipo . "\t" . $nivel . "\t" . $evolucion . "\r\n");
                            $encontrado = true;
                        }
                    }

                    //para el digimon 3
                    $encontrado = false;
                    $gestor = fopen("../../usuarios/$usuario/digimones_usuario.txt", "r");
                    while (($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) && ($encontrado == false)) {
                        list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                        if ($d3 == $digimon) {
                            fwrite($nuevofichero, $digimon . "\t" . $ataque . "\t" . $defensa . "\t" . $tipo . "\t" . $nivel . "\t" . $evolucion . "\r\n");
                            $encontrado = true;
                        }
                    }
                    fclose($gestor);
                    fclose($nuevofichero);
                }


                echo "<h2>Equipo actualziado correctamente</h2>";

                ////////////////////////
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