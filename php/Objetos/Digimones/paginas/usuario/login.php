<?php
include_once "../funciones.php";
////////////
if (isset($_REQUEST["usuario"])) {
    $usuario = $_REQUEST["usuario"];
} else {
    $usuario = "";
}
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
    <title>Login</title>
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
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="inicio_usuario.php">Inicio</a>
        </div>
    </div>
</nav>

<div class="container">

    <div class="principal">
        <!-- Si el formulario no se ha enviado-->
        <?php if (!isset($_REQUEST["login"])) { ?>


                <form method="post">
                    <div class="form-group">
                        <label for="usuario"> Usuario. </label><br/>
                        <input type="text" id="usuario" name="usuario" value="<?= $usuario ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password"> Contraseña. </label><br/>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <input type="submit" class="btn btn-lg btn-primary" value="Enviar" name="login">
                    <input type="reset" class="btn btn-lg btn-danger" value="Borrar">
                </form>


        <?php } else {

            //recojo los datos
            $usuario = $_REQUEST["usuario"];
            $password = $_REQUEST["password"];

            //////////// Comprobacion de login ////////////
            $encontrado = false;
            $correcto = false;
            if (file_exists("../../usuarios.txt")) {
                $gestor = fopen("../../usuarios.txt", "r");
                while (($filausu = fscanf($gestor, "%s\t%s\n")) && ($encontrado == false)) {
                    list ($usuarioleido, $passwordleida) = $filausu;
                    if ($usuario == $usuarioleido) {
                        $encontrado = true;
                        if ($password == $passwordleida) {
                            $correcto = true;
                            header("location:inicio_usuario.php?usuario=$usuario");
                        } else {
                            header("location:login.php?usuario=$usuario");
                        }
                    } else {
                        header("location:login.php?usuario=$usuario");
                    }
                }
                fclose($gestor);
            }
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