<?php
include_once "../funciones.php";
////////////
$usuario = "";
$password = "";
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
    <title>Alta usuario</title>
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

        <?php if (contardigimonesnivel1() >= 3) { ?>
            <!-- Si el formulario no se ha enviado, hay errores, o se ha añadido uno correctamente-->
            <?php if (!isset($_REQUEST["altausu"]) || isset($_REQUEST["errores"]) || isset($_REQUEST["correcto"])) {
                if (isset($_REQUEST["errores"])) {
                    ?>
                    <div class="errores">
                        <?php
                        if (isset($_REQUEST["errores"])) {

                            $usuario = $_REQUEST["usuario"];
                            $password = $_REQUEST["password"];

                            $errores = cadenaurl_a_array($_REQUEST["errores"]);
                            foreach ($errores as $error) {
                                echo $error . "<br/>";
                            }
                        }
                        if (isset($_REQUEST["correcto"])) {
                            echo "Usuario añadido correctamente";
                        }
                        ?>
                    </div> <!-- errores -->
                <?php } ?>

                <div class="formularioalta">
                    <form action="alta_usuario.php" method="post">
                        <div class="form-group">
                            <label for="usuario"> Nuevo usuario. </label><br/>
                            <input type="text" id="usuario" name="usuario" value="<?= $usuario ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password"> Contraseña. </label><br/>
                            <input type="password" id="password" name="password" value="<?= $password ?>"
                                   class="form-control">
                        </div>

                        <input type="submit" class="btn btn-lg btn-primary" value="Enviar" name="altausu">
                        <input type="reset" class="btn btn-lg btn-danger" value="Borrar">
                    </form>
                </div>

            <?php } else {

                if (isset($_REQUEST["altausu"])) {
                    //recojo los datos
                    $usuario = $_REQUEST["usuario"];
                    $password = $_REQUEST["password"];

                    // inicializacion
                    $correcto = true;
                    $errores = array();

                    //////////// Control de errores ////////////
                    ///usuario vacio
                    if ($usuario == "" || $usuario == null) {
                        $correcto = false;
                        $errores[] = "Usuario Vacio <br/>";
                    }

                    //////////// Existe usuario ////////////
                    $encontrado = false;
                    if (file_exists("../../usuarios.txt")) {
                        $fichero = fopen("../../usuarios.txt", "r");
                        while (($linea = fgets($fichero)) !== false && $encontrado == false) {
                            $usuario_fichero = substr($linea, 0, strpos($linea, "\t"));
                            echo "Usuario introducido: " . $usuario . "||||| usuario fichero: " . $usuario_fichero . "<br/>";
                            if ($usuario_fichero == $usuario) {
                                $encontrado = true;
                            }
                        }
                        fclose($fichero);
                    } else {
                        $errores[] = "No existe el fichero <br/>";
                    }
                    if ($encontrado) {
                        $correcto = false;
                        $errores[] = "El usuario ya existe <br/>";
                    }
                    ////////////////////////

                    //contra vacia
                    if ($password == "" || $password == null) {
                        $correcto = false;
                        $errores[] = " Contraseña vacia<br/>";

                    } // contra menor que 4
                    else if (strlen($password) < 4) {
                        $correcto = false;
                        $errores[] = " Contraseña demasiado corta. al menos 4 caracteres<br/>";
                    }

                    //////////// Fin del control de errores ////////////

                    if ($correcto) { //////////// Si es todo correcto

                        if (is_writable("../../usuarios.txt")) {
                            $fichero1 = fopen("../../usuarios.txt", "a+");
                            fwrite($fichero1, $usuario . "\t" . $password . "\r\n");
                            fclose($fichero1);
                            header("location:alta_usuario.php?correcto=true");
                        }

                        if (!file_exists("../../usuarios")) {
                            mkdir("../../usuarios");
                        }
                        mkdir("../../usuarios/$usuario");
                        asignar3digimones($usuario);

                    } else { //////////// Si hay errores
                        $cadena_errores = array_a_cadenaurl($errores);
                        header("location:alta_usuario.php?errores=" . $cadena_errores .
                            "&usuario=" . $usuario . "&password=$password");
                    }

                }
            }
        } else {

            echo "Para dar de alta usuarios debes tener primero almenos 3 digimones de nivel 1";
        } ?>
    </div><!-- principal -->
</div><!-- /.container -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>