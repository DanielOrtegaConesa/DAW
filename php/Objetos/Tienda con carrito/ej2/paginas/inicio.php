<?php
include_once "includes/funciones.php";
include_once "includes/funciones_BBDD.php";
$conexion = conectar();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Proveedores2</title>
        <meta name="description" content="Mi pagina">
        <meta name="author" content="Dani">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Reset CSS -->
        <link rel="stylesheet" href="../herramientasweb/css/reset.css">
        <!-- Auto Prefixer -->
        <script src="../herramientasweb/js/prefixfree.min.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../herramientasweb/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../herramientasweb/css/font-awesome-4.7.0/css/font-awesome.min.css">
        <!-- Mi css -->
        <link rel="stylesheet" href="style.css">

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../herramientasweb/js/jquery-3.2.1.min.js"></script>
        <script src="../herramientasweb/js/popper.min.js"></script>
        <script src="../herramientasweb/js/bootstrap.min.js"></script>

        <!-- Mi jQuery -->
        <script src="js/mijquery.js"></script>

    </head>
    <body>

    <header>
        <?php include "includes/header.php"; ?>
    </header>

    <div id="contenido">
        <?php include("pages/pages.php"); ?>
    </div>


    <footer id="footer" class="centradohorizontal centradovertical">
        <?php include "includes/footer.php"; ?>
    </footer>

    <?php

    ?>


    </body>
    </html>
<?php
