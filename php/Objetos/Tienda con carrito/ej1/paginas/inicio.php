<?php
include_once "includes/funciones.php";
include_once "includes/funciones_BBDD.php";
include_once "clases/Carrito.php";
include_once "clases/Pieza.php";
$conexion = conectar();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Proveedores Carrito</title>
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
</head>
<body>

<?php

session_start();

if (isset($_SESSION["usuario"])) {
    if (!isset($_SESSION["carrito"])) {
        $_SESSION["carrito"] = new Carrito();

        if (existeRegistroSimple($conexion, "CARRITOS", "NUMVEND=" . $_SESSION["usuario"])) {
            $sentencia = "SELECT * FROM CARRITOS WHERE NUMVEND=" . $_SESSION["usuario"];
            $resultado = $conexion->query($sentencia);

            while ($fila = $resultado->fetch_assoc()) {
                $NUMPIEZA = $fila["NUMPIEZA"];
                $CANTIDAD = $fila["CANTIDAD"];
                $pieza = new Pieza($NUMPIEZA);
                $pieza->setCantidad($CANTIDAD);
                $_SESSION["carrito"]->addPieza($pieza);
            }

            $sentencia = "DELETE FROM CARRITOS WHERE NUMVEND=" . $_SESSION["usuario"];
            $conexion->query($sentencia);
        }
    }
    ?>

    <header>
        <?php include "includes/header.php"; ?>
    </header>


    <aside id="nav" class="centradohorizontal">
        <?php include("includes/nav.php") ?>
    </aside>

    <div id="contenido">
        <?php include("pages/pages.php"); ?>
    </div>


    <footer id="footer" class="centradohorizontal centradovertical">
        <?php include "includes/footer.php"; ?>
    </footer>

    <?php

} else {
    $_SESSION = [];
    unset($_SESSION);
    session_destroy();
    header("location:log/login.php");
}
?>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../herramientasweb/js/jquery-3.2.1.min.js"></script>
<script src="../herramientasweb/js/popper.min.js"></script>
<script src="../herramientasweb/js/bootstrap.min.js"></script>

<!-- Mi jQuery -->
<script src="js/mijquery.js"></script>

</body>
</html>
