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
        <title>Jugar Partida</title>
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

            $victorias = 0;
            $derrotas = 0;
            $total = 0;
            //Si no existe un fichero de estadisticas se crea
            if (!file_exists("../../usuarios/$usuario/estadisticas.txt")) {
                $fichero = fopen("../../usuarios/$usuario/estadisticas.txt", "a+");
                fwrite($fichero, "0\t0\t0\t0");// victorias derrotas totales digievoluciones
                fclose($fichero);
            } else {
                $fichero = fopen("../../usuarios/$usuario/estadisticas.txt", "a+");
                $linea = fscanf($fichero, "%s\t%s\t%s\t%s");
                list($victorias, $derrotas, $total, $digievoluciones) = $linea;
                fclose($fichero);
            }

            if (!isset($_REQUEST["contrincante"])) {
                if (isset($_REQUEST["nofichero"])) {
                    echo "<h2>Lamentablemente tu contrincante aun no ha preparado a su equipo, escoge otro adversario</h2>";
                }
                if (file_exists("../../usuarios/$usuario/equipo_usuario.txt")) {
                    ?>
                    <form method="post">
                        <input type="hidden" name="usuario" value="<?= $usuario ?>">
                        <label for="contrincante">Escoge a tu adversario: </label>
                        <select name="contrincante" id="contrincante">
                            <?php
                            $fichero = fopen("../../usuarios.txt", "r");
                            while ($filausu = fscanf($fichero, "%s\t%s\n")) {
                                list ($usu, $password) = $filausu;
                                if ($usuario != $usu) {
                                    echo "<option value='$usu'>$usu</option>";
                                }
                            }
                            fclose($fichero);
                            ?>
                        </select>
                        <br/>
                        <input type="image" src="../../paginas/img/figth.png" width="250">
                    </form>
                    <?php
                } else {
                    echo "<div>";
                    echo "<h2>Aun no has seleccionado los digimones para tu equipo</h2>";
                    echo "<h3><a href='organizar_equipo.php?usuario=$usuario'>¡Quiero Hacerlo!</a></h3>";
                    echo "</div>";
                }
            } else {
            $contrincante = $_REQUEST["contrincante"];

            //obtencion de todos los datos del contrincante
            if (file_exists("../../usuarios/$contrincante/equipo_usuario.txt")) {
                $gestor = fopen("../../usuarios/$contrincante/equipo_usuario.txt", "r");
                $numero = 1;
                while (($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n"))) {
                    list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                    switch ($numero) {
                        case 1:
                            $cdigimon1 = $digimon;
                            $cataque1 = $ataque;
                            $cdefensa1 = $defensa;
                            $ctipo1 = $tipo;
                            break;
                        case 2:
                            $cdigimon2 = $digimon;
                            $cataque2 = $ataque;
                            $cdefensa2 = $defensa;
                            $ctipo2 = $tipo;
                            break;
                        case 3:
                            $cdigimon3 = $digimon;
                            $cataque3 = $ataque;
                            $cdefensa3 = $defensa;
                            $ctipo3 = $tipo;
                            break;
                    }
                    $numero++;
                }
                fclose($gestor);
            } else {
                header("location:jugar_partida.php?usuario=$usuario&nofichero");
            }

            //obtencion de todos los datos del usuario
            if (file_exists("../../usuarios/$usuario/equipo_usuario.txt")) {
                $gestor = fopen("../../usuarios/$usuario/equipo_usuario.txt", "r");
                $numero = 1;
                while (($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n"))) {
                    list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                    switch ($numero) {
                        case 1:
                            $udigimon1 = $digimon;
                            $uataque1 = $ataque;
                            $udefensa1 = $defensa;
                            $utipo1 = $tipo;
                            break;
                        case 2:
                            $udigimon2 = $digimon;
                            $uataque2 = $ataque;
                            $udefensa2 = $defensa;
                            $utipo2 = $tipo;
                            break;
                        case 3:
                            $udigimon3 = $digimon;
                            $uataque3 = $ataque;
                            $udefensa3 = $defensa;
                            $utipo3 = $tipo;
                            break;
                    }
                    $numero++;
                }
                fclose($gestor);
            }

            //Comienzo del combate con los datos obtenidos
            $asaltosganados = 0;
            //Asalto1
            $ures1 = $uataque1 + $udefensa1;
            $ures1 += rand(1, 20);

            $cres1 = $cataque1 + $cdefensa1;
            $cres1 += rand(1, 20);

            switch ($utipo1) {
                case "vacuna":
                    switch ($ctipo1) {
                        case "virus":
                            $ures1 += 10;
                            break;
                        case "animal":
                            $ures1 += 5;
                            break;
                        case "planta":
                            $ures1 -= 5;
                            break;
                        case "elemental":
                            $ures1 -= 10;
                            break;
                    }
                    break;

                case "virus":
                    switch ($ctipo1) {
                        case "animal":
                            $ures1 += 10;
                            break;
                        case "planta":
                            $ures1 += 5;
                            break;
                        case "elemental":
                            $ures1 -= 5;
                            break;
                        case "vacuna":
                            $ures1 -= 10;
                            break;
                    }
                    break;

                case "animal":
                    switch ($ctipo1) {
                        case "planta":
                            $ures1 += 10;
                            break;
                        case "elemental":
                            $ures1 += 5;
                            break;
                        case "vacuna":
                            $ures1 -= 5;
                            break;
                        case "virus":
                            $ures1 -= 10;
                            break;
                    }
                    break;

                case "planta":
                    switch ($ctipo1) {
                        case "elemental":
                            $ures1 += 10;
                            break;
                        case "vacuna":
                            $ures1 += 5;
                            break;
                        case "virus":
                            $ures1 -= 5;
                            break;
                        case "animal":
                            $ures1 -= 10;
                            break;
                    }
                    break;

                case "elemental":
                    switch ($ctipo1) {
                        case "vacuna":
                            $ures1 += 10;
                            break;
                        case "virus":
                            $ures1 += 5;
                            break;
                        case "animal":
                            $ures1 -= 5;
                            break;
                        case "planta":
                            $ures1 -= 10;
                            break;
                    }
                    break;
            }
            while ($ures1 == $cres1) {
                $ures1 += rand(1, 20);
                $cres1 += rand(1, 20);
            }
            if ($ures1 > $cres1) {
                $asaltosganados++;
            }


            //Asalto2
            $ures2 = $uataque2 + $udefensa2;
            $ures2 += rand(1, 20);

            $cres2 = $cataque2 + $cdefensa2;
            $cres2 += rand(1, 20);

            switch ($utipo2) {
                case "vacuna":
                    switch ($ctipo2) {
                        case "virus":
                            $ures2 += 10;
                            break;
                        case "animal":
                            $ures2 += 5;
                            break;
                        case "planta":
                            $ures2 -= 5;
                            break;
                        case "elemental":
                            $ures2 -= 10;
                            break;
                    }
                    break;

                case "virus":
                    switch ($ctipo2) {
                        case "animal":
                            $ures2 += 10;
                            break;
                        case "planta":
                            $ures2 += 5;
                            break;
                        case "elemental":
                            $ures2 -= 5;
                            break;
                        case "vacuna":
                            $ures2 -= 10;
                            break;
                    }
                    break;

                case "animal":
                    switch ($ctipo2) {
                        case "planta":
                            $ures2 += 10;
                            break;
                        case "elemental":
                            $ures2 += 5;
                            break;
                        case "vacuna":
                            $ures2 -= 5;
                            break;
                        case "virus":
                            $ures2 -= 10;
                            break;
                    }
                    break;

                case "planta":
                    switch ($ctipo2) {
                        case "elemental":
                            $ures2 += 10;
                            break;
                        case "vacuna":
                            $ures2 += 5;
                            break;
                        case "virus":
                            $ures2 -= 5;
                            break;
                        case "animal":
                            $ures2 -= 10;
                            break;
                    }
                    break;

                case "elemental":
                    switch ($ctipo2) {
                        case "vacuna":
                            $ures2 += 10;
                            break;
                        case "virus":
                            $ures2 += 5;
                            break;
                        case "animal":
                            $ures2 -= 5;
                            break;
                        case "planta":
                            $ures2 -= 10;
                            break;
                    }
                    break;
            }
            while ($ures2 == $cres2) {
                $ures2 += rand(1, 20);
                $cres2 += rand(1, 20);
            }
            if ($ures2 > $cres2) {
                $asaltosganados++;
            }


            if ($asaltosganados != 2 && $asaltosganados != 0) {
                //Asalto3
                $ures3 = $uataque3 + $udefensa3;
                $ures3 += rand(1, 20);

                $cres3 = $cataque3 + $cdefensa3;
                $cres3 += rand(1, 20);

                switch ($utipo3) {
                    case "vacuna":
                        switch ($ctipo3) {
                            case "virus":
                                $ures3 += 10;
                                break;
                            case "animal":
                                $ures3 += 5;
                                break;
                            case "planta":
                                $ures3 -= 5;
                                break;
                            case "elemental":
                                $ures3 -= 10;
                                break;
                        }
                        break;

                    case "virus":
                        switch ($ctipo3) {
                            case "animal":
                                $ures3 += 10;
                                break;
                            case "planta":
                                $ures3 += 5;
                                break;
                            case "elemental":
                                $ures3 -= 5;
                                break;
                            case "vacuna":
                                $ures3 -= 10;
                                break;
                        }
                        break;

                    case "animal":
                        switch ($ctipo3) {
                            case "planta":
                                $ures3 += 10;
                                break;
                            case "elemental":
                                $ures3 += 5;
                                break;
                            case "vacuna":
                                $ures3 -= 5;
                                break;
                            case "virus":
                                $ures3 -= 10;
                                break;
                        }
                        break;

                    case "planta":
                        switch ($ctipo3) {
                            case "elemental":
                                $ures3 += 10;
                                break;
                            case "vacuna":
                                $ures3 += 5;
                                break;
                            case "virus":
                                $ures3 -= 5;
                                break;
                            case "animal":
                                $ures3 -= 10;
                                break;
                        }
                        break;

                    case "elemental":
                        switch ($ctipo3) {
                            case "vacuna":
                                $ures3 += 10;
                                break;
                            case "virus":
                                $ures3 += 5;
                                break;
                            case "animal":
                                $ures3 -= 5;
                                break;
                            case "planta":
                                $ures3 -= 10;
                                break;
                        }
                        break;
                }
                while ($ures3 == $cres3) {
                    $ures3 += rand(1, 20);
                    $cres3 += rand(1, 20);
                }
                if ($ures3 > $cres3) {
                    $asaltosganados++;
                }
            } else {
                $rendido = true;
            }

            echo "<div class='vs'>";
            echo "<div class='textvs'>";
            echo "<p class='relieve arriba'>$usuario</p>";
            echo "</div>";

            echo "<img src='../img/vs.png' width='100' height='100'>";

            echo "<div class='textvs'>";
            echo "<br/><p class='relieve abajo'>$contrincante</p>";
            echo "</div>";
            echo "</div>";
            ?>
            <div class="coldobles">
                <div class="columna1de2">
                    <div>
                        <table class="table table-striped resultados">
                            <thead>
                            <tr>
                                <td>Asalto</td>
                                <td>Digimon de <?= $usuario ?></td>
                                <td>Fuerza</td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Asalto 1 -->
                            <tr>
                                <td>1</td>

                                <?php
                                //imagen
                                echo "<td>";
                                if (file_exists("../../digimones/" . $udigimon1 . "/imagen.jpg")) {
                                    echo "<img src='../../digimones/" . $udigimon1 . "/imagen.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/imagen.jpg' heigth='100' width='100'>";
                                }
                                echo "<br/>" . $udigimon1;
                                echo "</td>";

                                //poder del digimon
                                echo "<td>";
                                echo $ures1;
                                echo "</td>";

                                ?>
                            </tr>

                            <!-- Asalto 2 -->
                            <tr>
                                <td>2</td>

                                <?php
                                //imagen
                                echo "<td>";
                                if (file_exists("../../digimones/" . $udigimon2 . "/imagen.jpg")) {
                                    echo "<img src='../../digimones/" . $udigimon2 . "/imagen.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/imagen.jpg' heigth='100' width='100'>";
                                }
                                echo "<br/>" . $udigimon2;
                                echo "</td>";

                                //poder del digimon
                                echo "<td>";
                                echo $ures2;
                                echo "</td>";

                                ?>

                            </tr>

                            <?php
                            if (!isset($rendido)) {
                            ?>
                            <!-- Asalto 3 -->
                            <tr>
                                <td>3</td>

                                <?php
                                //imagen
                                echo "<td>";
                                if (file_exists("../../digimones/" . $udigimon3 . "/imagen.jpg")) {
                                    echo "<img src='../../digimones/" . $udigimon3 . "/imagen.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/imagen.jpg' heigth='100' width='100'>";
                                }
                                echo "<br/>" . $udigimon3;
                                echo "</td>";

                                //poder del digimon
                                echo "<td>";
                                echo $ures3;
                                echo "</td>";

                                ?>

                            </tr>
                            </tbody>
                            <?php
                            }

                            ?>
                        </table>
                    </div>
                </div>
                <div class="columna2de2">
                    <div>
                        <table class="table table-striped resultados">
                            <thead>
                            <tr>
                                <td>Asalto</td>
                                <td>Digimon de <?= $contrincante ?></td>
                                <td>Fuerza</td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Asalto 1 -->
                            <tr>
                                <td>1</td>

                                <?php
                                //imagen
                                echo "<td>";
                                if (file_exists("../../digimones/" . $cdigimon1 . "/imagen.jpg")) {
                                    echo "<img src='../../digimones/" . $cdigimon1 . "/imagen.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/imagen.jpg' heigth='100' width='100'>";
                                }
                                echo "<br/>" . $cdigimon1;
                                echo "</td>";

                                //poder del digimon
                                echo "<td>";
                                echo $cres1;
                                echo "</td>";

                                ?>

                            </tr>

                            <!-- Asalto 2 -->
                            <tr>
                                <td>2</td>

                                <?php
                                //imagen
                                echo "<td>";
                                if (file_exists("../../digimones/" . $cdigimon2 . "/imagen.jpg")) {
                                    echo "<img src='../../digimones/" . $cdigimon2 . "/imagen.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/imagen.jpg' heigth='100' width='100'>";
                                }
                                echo "<br/>" . $cdigimon2;
                                echo "</td>";

                                //poder del digimon
                                echo "<td>";
                                echo $cres2;
                                echo "</td>";

                                ?>

                            </tr>

                            <?php
                            if (!isset($rendido)) {
                            ?>
                            <!-- Asalto 3 -->
                            <tr>
                                <td>3</td>

                                <?php
                                //imagen
                                echo "<td>";
                                if (file_exists("../../digimones/" . $cdigimon3 . "/imagen.jpg")) {
                                    echo "<img src='../../digimones/" . $cdigimon3 . "/imagen.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/imagen.jpg' heigth='100' width='100'>";
                                }
                                echo "<br/>" . $cdigimon3;
                                echo "</td>";

                                //poder del digimon
                                echo "<td>";
                                echo $cres3;
                                echo "</td>";

                                ?>

                            </tr>
                            </tbody>
                            <?php
                            }

                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="resultados">
                <div>
                    <table class="table table-striped tusresultados">
                        <thead>
                        <tr>
                            <td>Asalto</td>
                            <td>Tus Resultados</td>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Asalto 1 -->
                        <tr>
                            <td>1</td>
                            <?php
                            if ($ures1 > $cres1) {  //si gana el usuario

                                echo "<td>";
                                if (file_exists("../../digimones/" . $udigimon1 . "/victoria.jpg")) {
                                    echo "<img src='../../digimones/" . $udigimon1 . "/victoria.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/victoria.gif' heigth='100' width='100'>";
                                }
                                echo "</td>";


                            } else {    //si pierde
                                echo "<td>";
                                if (file_exists("../../digimones/" . $udigimon1 . "/derrota.jpg")) {
                                    echo "<img src='../../digimones/" . $udigimon1 . "/derrota.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/derrota.jpg' heigth='100' width='100'>";
                                }
                                echo "</td>";
                            }
                            ?>


                        </tr>

                        <!-- Asalto 2 -->
                        <tr>
                            <td>2</td>

                            <?php
                            if ($ures2 > $cres2) {  //si gana el usuario

                                echo "<td>";
                                if (file_exists("../../digimones/" . $udigimon2 . "/victoria.jpg")) {
                                    echo "<img src='../../digimones/" . $udigimon2 . "/victoria.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/victoria.gif' heigth='100' width='100'>";
                                }
                                echo "</td>";


                            } else {    //si pierde
                                echo "<td>";
                                if (file_exists("../../digimones/" . $udigimon2 . "/derrota.jpg")) {
                                    echo "<img src='../../digimones/" . $udigimon2 . "/derrota.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/derrota.jpg' heigth='100' width='100'>";
                                }
                                echo "</td>";
                            }
                            ?>


                        </tr>

                        <?php
                        if (!isset($rendido)) {
                        ?>
                        <!-- Asalto 3 -->
                        <tr>
                            <td>3</td>

                            <?php
                            if ($ures3 > $cres3) {  //si gana el usuario

                                echo "<td>";
                                if (file_exists("../../digimones/" . $udigimon3 . "/victoria.jpg")) {
                                    echo "<img src='../../digimones/" . $udigimon3 . "/victoria.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/victoria.gif' heigth='100' width='100'>";
                                }
                                echo "</td>";


                            } else {    //si pierde
                                echo "<td>";
                                if (file_exists("../../digimones/" . $udigimon3 . "/derrota.jpg")) {
                                    echo "<img src='../../digimones/" . $udigimon3 . "/derrota.jpg' heigth='100' width='100'>";
                                } else {
                                    echo "<img src='../../digimones/default/derrota.jpg' heigth='100' width='100'>";
                                }
                                echo "</td>";
                            }
                            ?>


                        </tr>
                        </tbody>
                        <?php
                        }

                        ?>
                    </table>
                </div>
            </div>
            <?php

            ?>
            <div class="bloque">
                <?php
                if (isset($rendido)) {
                    echo "<h2>Al ver que el resultado estaba decidido, se ha interumpido el tercer asalto para evitar la lucha entre digimones</h2>";
                }
                if ($asaltosganados >= 2) {
                    echo "<h2>Ha ganado $usuario</h2>";
                    $victorias++;
                } else {
                    echo "<h2>Ha ganado $contrincante</h2>";
                    $derrotas++;
                }
                $total++;
                if (($victorias % 10) == 0) {
                    $digievoluciones++;
                }
                if (($total % 10) == 0) {
                    include_once "../funciones.php";
                    $nuevodigimon = regalardigimon($usuario);
                    if ($nuevodigimon != false) {
                        if (file_exists("../../usuarios/$usuario/digimones_usuario.txt")) {
                            $f = fopen("../../usuarios/$usuario/digimones_usuario.txt", "a+");
                            fwrite($f, $nuevodigimon);
                            fclose($f);
                        }
                        echo "<h2>Tienes un nuevo digimon</h2>";
                    }else{
                        echo "<h2>Eres tan bueno que has obtenido todos los digimones por lo que no te podemos dar uno nuevo</h2>";
                    }
                }
                unlink("../../usuarios/$usuario/estadisticas.txt");
                $fichero = fopen("../../usuarios/$usuario/estadisticas.txt", "a+");
                fwrite($fichero, "$victorias\t$derrotas\t$total\t$digievoluciones");
                fclose($fichero);
                }

                ?>
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