<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Un juego desarrollado para la asignatura de aplicaciones web en entorno servidor que tiene como base hacer combates entre digimones">
    <meta name="author" content="Daniel Ortega Conesa">
    <link rel="icon" href="../bootstrap-3.3.7/docs/favicon.ico">
    <title>Imagen Digimon</title>
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

        <?php
        if (isset($_REQUEST["digimon"])) {//si llego de la pagina ver digimon
            $nulas = 0;
            if (isset($_REQUEST["archivos"])) { //si he enviado el formulario
                $directorio = "../../digimones/" . $_REQUEST["digimon"] . "/";
                $tmax = 2000000;


                if (isset($_FILES["imagen"])) {

                    if (($_FILES["imagen"]["type"] == "image/gif")
                        || ($_FILES["imagen"]["type"] == "image/jpeg")
                        || ($_FILES["imagen"]["type"] == "image/png")
                        || ($_FILES["imagen"]["type"] == "image/pjpeg")) {

                        $temporal = $_FILES["imagen"]["tmp_name"];
                        $destino = $directorio . "imagen.jpg";

                        if (filesize($temporal) <= $tmax) {
                            if (move_uploaded_file($temporal, $destino)) {
                                echo "Archivo subido con éxito<br/>";
                            }
                        } else {
                            echo "Tamaño maximo superado";
                        }
                    } else {
                        if ($_FILES["imagen"]["type"] != null) {
                            echo "formato no permitido</br>";
                        }else{$nulas++;}
                    }
                }

                if (isset($_FILES["victoria"])) {
                    if (($_FILES["victoria"]["type"] == "image/gif")
                        || ($_FILES["victoria"]["type"] == "image/jpeg")
                        || ($_FILES["victoria"]["type"] == "image/png")
                        || ($_FILES["victoria"]["type"] == "image/pjpeg")) {
                        $temporal = $_FILES["victoria"]["tmp_name"];
                        $destino = $directorio . "victoria.jpg";


                        if (filesize($temporal) <= $tmax) {
                            if (move_uploaded_file($temporal, $destino)) {
                                echo "Archivo subido con éxito<br/>";
                            }
                        } else {
                            echo "Tamaño maximo superado</br>";
                        }
                    } else {
                        if ($_FILES["victoria"]["type"] != null) {
                            echo "formato no permitido</br>";
                        }else{$nulas++;}
                    }
                }


                if (isset($_FILES["derrota"])) {
                    if (($_FILES["derrota"]["type"] == "image/gif")
                        || ($_FILES["derrota"]["type"] == "image/jpeg")
                        || ($_FILES["derrota"]["type"] == "image/png")
                        || ($_FILES["derrota"]["type"] == "image/pjpeg")) {
                        $temporal = $_FILES["derrota"]["tmp_name"];
                        $destino = $directorio . "derrota.jpg";


                        if (filesize($temporal) <= $tmax) {
                            if (move_uploaded_file($temporal, $destino)) {
                                echo "Archivo subido con éxito<br/>";
                            }
                        } else {
                            echo "Tamaño maximo superado</br>";
                        }
                    } else {
                        if ($_FILES["derrota"]["type"] != null) {
                            echo "formato no permitido</br>";
                        }else{$nulas++;}
                    }
                }
                if($nulas==3){
                    echo "No se ha enviado ningun archivo";
                }

            } else { //si no he enviado el formulario
                ?>
                <div align="center">
                    <form method="post"
                          enctype="multipart/form-data">
                        <p>Imagen normal <input type="file" name="imagen"></p>
                        <br/>

                        <p>Imagen de victoria <input type="file" name="victoria"></p>
                        <br/>

                        <p>Imagen de derrota <input type="file" name="derrota"></p>
                        <br/>

                        <input type="submit" name="archivos" value="Subir el archivo">
                    </form>
                </div>
                <?php
            }

        }else{
            header("location:ver_digimon.php");
        }
        ?>

    </div><!-- principal -->
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>
