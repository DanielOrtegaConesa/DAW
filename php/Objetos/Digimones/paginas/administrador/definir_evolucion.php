<?php
include_once "../funciones.php";
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
    <title>Definir Evolucion</title>
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
<?php include_once "menu.html" ?>

<div class="container">

    <div class="principal">

        <?php if (!isset($_REQUEST["evdefinida"])) { //////////// de no haberse acabado de enviar el formulario
            if (isset($_REQUEST["correcto"])) {
                if ($_REQUEST["correcto"] == "true") {
                    echo "<h2 class='bloque'>Evolucion definida correctamente</h2>";
                } else {
                    echo "<h2 class='bloque'>Evolucion NO definida correctamente, solo puede haber una diferencia de 1 nivel</h2>";
                }
            }
            ?>

            <form>
                <select name="original">
                    <?php
                    if (file_exists("../../digimones.txt")) {
                        $gestor = fopen("../../digimones.txt", "r");
                        while ($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                            list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                            if ($nivel < 3) {
                                echo "<option value='$digimon'>" . $digimon . "(Nivel:$nivel)" . "</option>";
                            }
                        }
                        fclose($gestor);
                    }
                    ?>
                </select>

                <h2>Evoluciona a</h2>

                <select name="evolucion">
                    <?php
                    if (file_exists("../../digimones.txt")) {
                        $gestor = fopen("../../digimones.txt", "r");
                        while ($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                            list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                            if ($nivel > 1) {
                                echo "<option value='$digimon' >" . $digimon . "(Nivel:$nivel)" . "</option>";
                            }
                        }
                        fclose($gestor);
                    }
                    ?>
                </select><br/><br/>
                <input type="submit" class="btn btn-lg btn-primary" value="Enviar" name="evdefinida">
            </form>

        <?php } else {
            ?>

            <?php

            ////////////
            $original = $_REQUEST["original"];
            $aevolucion = $_REQUEST["evolucion"];
            ////////////

            //////////// Obtencion del nivel del digimon al que evolucionara ////////////
            $encontrado = false;
            $niveldelaevolucion = 0;
            if (file_exists("../../digimones.txt")) {
                $gestor = fopen("../../digimones.txt", "r");
                while (($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) && ($encontrado == false)) {
                    list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                    if ($aevolucion == $digimon) {
                        $niveldelaevolucion = $nivel;// equivale al nivel del digimon que evolucionara, esto se usara para comprobar que la diferencia solo sea de un nivel
                        $encontrado = true;
                    }
                }
                fclose($gestor);
            }
            ////////////////////////


            //////////// Vamos a ir copiando linea a linea, para ello necesitamos un fichero auxiliar  ////////////
            rename("../../digimones.txt", "../../digimonesviejo.txt");//renombramos el existente
            $nuevofichero = fopen("../../digimones.txt", "a+");// creamos uno de destino en el que ir copiando

            $todook = false;
            if (file_exists("../../digimonesviejo.txt")) {
                $gestor = fopen("../../digimonesviejo.txt", "r");
                while ($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                    list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                    if (($original == $digimon) && (($niveldelaevolucion - $nivel)) == 1) {
                        fwrite($nuevofichero, $digimon . "\t" . $ataque . "\t" . $defensa . "\t" . $tipo . "\t" . $nivel . "\t" . $aevolucion . "\r\n");
                        $todook = true;
                    } else {
                        fwrite($nuevofichero, $digimon . "\t" . $ataque . "\t" . $defensa . "\t" . $tipo . "\t" . $nivel . "\t" . $evolucion . "\r\n");
                    }
                }
                fclose($gestor);
                fclose($nuevofichero);
            }
            unlink("../../digimonesviejo.txt"); //finalmente borramos
            ////////////////////////

            if ($todook) {
                header("location:definir_evolucion.php?correcto=true");
            } else {
                header("location:definir_evolucion.php?correcto=false");
            }

            ?>
            <?php

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