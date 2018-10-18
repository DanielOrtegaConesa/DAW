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
    <title>Ver Digimon</title>
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

        <?php if (!isset($_REQUEST["verdefinido"])) { ?>
            <form method="post">
                <select name="aver">
                    <?php
                    if (file_exists("../../digimones.txt")) {
                        $gestor = fopen("../../digimones.txt", "r");
                        while ($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) {
                            list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;

                            echo "<option value='$digimon'>" . $digimon . "(Nivel:$nivel)" . "</option>";

                        }
                        fclose($gestor);
                    }
                    ?>
                </select>
                <input type="submit" class="btn btn-lg btn-primary" value="Ver" name="verdefinido">
            </form>
        <?php } else {
            $aver = $_REQUEST["aver"];
            ?>
            <?php
            $encontrado = false;
            if (file_exists("../../digimones.txt")) {
                $gestor = fopen("../../digimones.txt", "r");
                while (($filadigimon = fscanf($gestor, "%s\t%s\t%s\n%s\t%s\t%s\n")) && $encontrado == false) {
                    list ($digimon, $ataque, $defensa, $tipo, $nivel, $evolucion) = $filadigimon;
                    if ($aver == $digimon) {
                        ?>
                        <table class="table table-striped">
                            <tr>

                                <?php
                                if (file_exists("../../digimones/" . $digimon . "/victoria.jpg")) {
                                    echo "<td><img src='../../digimones/" . $digimon . "/victoria.jpg' heigth='200' width='200'></td>";
                                } else {
                                    echo "<td><img src='../../digimones/default/imagen.jpg' heigth='200' width='200'></td>";
                                }

                                if (file_exists("../../digimones/" . $digimon . "/imagen.jpg")) {
                                    echo "<td><img src='../../digimones/" . $digimon . "/imagen.jpg' heigth='200' width='200'></td>";
                                } else {
                                    echo "<td><img src='../../digimones/default/imagen.jpg' heigth='200' width='200'></td>";
                                }

                                if (file_exists("../../digimones/" . $digimon . "/derrota.jpg")) {
                                    echo "<td><img src='../../digimones/" . $digimon . "/derrota.jpg' heigth='200' width='200'></td>";
                                } else {
                                    echo "<td><img src='../../digimones/default/imagen.jpg' heigth='200' width='200'></td>";
                                }
                                ?>

                            </tr>
                            <tr>
                                <td>Nombre:</td>
                                <td colspan="2"><?= $digimon ?></td>
                            </tr>
                            <tr>
                                <td>Ataque:</td>
                                <td colspan="2"><?= $ataque ?></td>
                            </tr>
                            <tr>
                                <td>Defensa:</td>
                                <td colspan="2"><?= $defensa ?></td>
                            </tr>
                            <tr>
                                <td>Tipo:</td>
                                <td colspan="2"><?= $tipo ?></td>
                            </tr>
                            <tr>
                                <td>Nivel</td>
                                <td colspan="2"><?= $nivel ?></td>
                            </tr>
                            <tr>
                                <td>Evolucion</td>
                                <?php
                                if ($evolucion != "Sin_Evolucion") {
                                    ?>
                                    <td  colspan="2">
                                        <a href="ver_digimon.php?aver=<?= $evolucion ?>&verdefinido=Ver"><?= $evolucion ?></a>
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td>Sin Evolucion</td>
                                    <?php
                                }
                                ?>

                            </tr>
                        </table>
                        <?php
                        $encontrado = true;
                    }
                }
                fclose($gestor);

                ?>
                <a href="imagen_digimon.php?digimon=<?= $digimon ?>">Añadir/Modificar Imagen</a>
                <?php
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