<?php
include_once "../funciones.php";
////////////
$digimon = "";
$ataque = "";
$defensa = "";
$tipo = "";
$nivel = "";
////////////
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
    <title>Alta didimon</title>
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
        <!-- Si el formulario no se ha enviado, hay errores, o se ha añadido uno correctamente-->
        <?php if (!isset($_REQUEST["altadigi"]) || isset($_REQUEST["errores"]) || isset($_REQUEST["correcto"])) {
            if (isset($_REQUEST["errores"])) {
                ?>
                <div class="errores">
                    <?php
                    //////////// Si hay errores ////////////
                    if (isset($_REQUEST["errores"])) {

                        $digimon = $_REQUEST["digimon"];
                        $ataque = $_REQUEST["ataque"];
                        $defensa = $_REQUEST["defensa"];
                        $tipo = $_REQUEST["tipo"];
                        $nivel = $_REQUEST["nivel"];

                        $errores = cadenaurl_a_array($_REQUEST["errores"]);
                        foreach ($errores as $error) {
                            echo $error . "<br/>";
                        }
                    }
                    ////////////////////////

                    //////////// Si NO hay errores ////////////
                    if (isset($_REQUEST["correcto"])) {
                        echo "<div>Digimon añadido correctamente</div>";
                    }
                    ////////////////////////

                    ?>
                </div> <!-- errores -->
            <?php } ?>

            <!---- Formulario de pedida de datos ---->
            <div class="formularioalta">
                <form action="alta_digimon.php" method="post">
                    <div class="form-group">
                        <label for="digimon"> Nombre. </label><br/>
                        <input type="text" id="digimon" name="digimon" value="<?= $digimon ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="ataque"> Ataque. </label><br/>
                        <input type="text" id="ataque" name="ataque" value="<?= $ataque ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="defensa"> Defensa. </label><br/>
                        <input type="text" id="defensa" name="defensa" value="<?= $defensa ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="tipo"> Tipo. </label><br/>
                        <select id="tipo" name="tipo">
                            <option value="vacuna">Vacuna</option>
                            <option value="virus">Virus</option>
                            <option value="animal">Animal</option>
                            <option value="planta">Planta</option>
                            <option value="elemental">Elemental</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nivel"> Nivel. </label><br/>
                        <input type="text" id="nivel" name="nivel" value="<?= $nivel ?>" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-lg btn-primary" value="Enviar" name="altadigi">
                    <input type="reset" class="btn btn-lg btn-danger" value="Borrar">
                </form>
            </div>
            <!---- Fin del formulario de pedida de datos ---->
        <?php } else {

            if (isset($_REQUEST["altadigi"])) {
                //recojo los datos
                $digimon = $_REQUEST["digimon"];
                $ataque = $_REQUEST["ataque"];
                $defensa = $_REQUEST["defensa"];
                $tipo = $_REQUEST["tipo"];
                $nivel = $_REQUEST["nivel"];

                // inicializacion
                $correcto = true;
                $errores = array();

                //////////// Control de errores ////////////
                ///Digimon vacio
                if ($digimon == "" || $digimon == null) {
                    $correcto = false;
                    $errores[] = "Digimion Vacio <br/>";
                }

                /// Existe el digimon
                $encontrado = false;
                if (file_exists("../../digimones.txt")) {
                    $fichero = fopen("../../digimones.txt", "r");
                    while (($linea = fgets($fichero)) !== false && $encontrado == false) {
                        $digimon_fichero = substr($linea, 0, strpos($linea, "\t"));
                        if ($digimon_fichero == $digimon) {
                            $encontrado = true;
                        }
                    }
                    fclose($fichero);
                } else {
                    $errores[] = "No existe el fichero";
                }
                if ($encontrado) {
                    $correcto = false;
                    $errores[] = "El digimon ya existe <br/>";
                }

                //Sin ataque
                if ($ataque == "" || $ataque == null) {
                    $correcto = false;
                    $errores[] = "Ataque vacio<br/>";
                }
                //ataque tiene letras
                if (!esnumero($ataque)) {
                    $correcto = false;
                    $errores[] = "Ataque solo debe contener numeros<br/>";
                }

                //Sin defensa
                if ($defensa == "" || $defensa == null) {
                    $correcto = false;
                    $errores[] = "Defensa vacia<br/>";
                }
                //defensa tiene letras
                if (!esnumero($defensa)) {
                    $correcto = false;
                    $errores[] = "Defensa solo debe contener numeros<br/>";
                }

                //Sin nivel
                if ($nivel == "" || $nivel == null) {
                    $correcto = false;
                    $errores[] = "Nivel vacio<br/>";
                }
                //Nivel superior o inferior
                if ($nivel > 3) {
                    $correcto = false;
                    $errores[] = "Nivel superior al limite (3)<br/>";
                }
                if ($nivel < 1) {
                    $correcto = false;
                    $errores[] = "Nivel inferior al limite (1)<br/>";
                }
                //nivel tiene letras
                if (!esnumero($nivel)) {
                    $correcto = false;
                    $errores[] = "Nivel solo debe contener numeros<br/>";
                }

                //////////// Fin del control de errores ////////////


                if ($correcto) { //////////// Si todo es correcto

                    if (is_writable("../../digimones.txt")) {
                        $fichero1 = fopen("../../digimones.txt", "a+");
                        fwrite($fichero1, $digimon . "\t" . $ataque . "\t" . $defensa . "\t" . $tipo . "\t" . $nivel . "\t Sin_Evolucion" . "\r\n");
                        fclose($fichero1);
                        if (!file_exists("../../digimones")) {
                            mkdir("../../digimones");
                        }
                        if (!file_exists("../../digimones/$digimon")) {
                            mkdir("../../digimones/" . $digimon);
                        }

                        header("location:alta_digimon.php?correcto=true");
                    }

                } else { //////////// Si hay errores
                    $cadena_errores = array_a_cadenaurl($errores);
                    header("location:alta_digimon.php?errores=" . $cadena_errores .
                        "&digimon=" . $digimon . "&ataque=$ataque" . "&defensa=$defensa" . "&tipo=$tipo" . "&nivel=$nivel");
                }

            }
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