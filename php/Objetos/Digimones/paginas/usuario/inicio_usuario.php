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
            <div class="imagen">
                <img src="../img/digimon.png" width="250">
            </div>
            <?php
            echo "<div>";
            echo "<h2>¡Hola $usuario!</h2>";
            if (!file_exists("../../usuarios/$usuario/estadisticas.txt")) {
                $fichero = fopen("../../usuarios/$usuario/estadisticas.txt", "a+");
                fwrite($fichero, "0\t0\t0\t0");// victorias derrotas totales digievoluciones
                fclose($fichero);
                $victorias = 0;
                $derrotas = 0;
                $total = 0;
                $digievoluciones=0;
            } else {
                $fichero = fopen("../../usuarios/$usuario/estadisticas.txt", "a+");
                $linea = fscanf($fichero, "%s\t%s\t%s\t%s");
                list($victorias, $derrotas,$total,$digievoluciones) = $linea;

            }
            echo "<h2>Hemos calculado tus estadisticas</h2>";
            echo "<div class='estadisticas'>";
            echo "<p>Has Jugado: $total partidas, de las cuales</p>";
            echo "<p>&nbsp;- Has ganado: $victorias partidas</p>";
            echo "<p>&nbsp;- Has perdido: $derrotas partidas</p>";
            echo "<p>Dispones de $digievoluciones digievoluciones</p>";
            echo "</div>";
            if($victorias>$derrotas) {
                echo "<br/><p>¡Eres un jugador muy bueno!</p>";
            }
            if($victorias==$derrotas) {
                echo "<br/><p>¡Prueba a combatir contra otro usuario!</p>";
            }
            if($derrotas>$victorias){
                echo "<br/><p>¡Deberias mejorar tu equipo!</p>";
                echo "<p>Prueba luchando contra oponentes mas sencillos para subir de nivel tus digimon</p>";
            }
            echo "</div>";
            ?>
            <div class="imagenmasbaja">
                <img src="../img/piyomon.png" width="175">
            </div>
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