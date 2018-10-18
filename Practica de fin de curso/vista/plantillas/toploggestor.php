<?php
$usesion = $_SESSION["usuario"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Trabajo Final</title>
    <meta name="description" content="Trabajo final para e ciclo de Desarrollo de Aplicaciones Web">
    <meta name="author" content="Dani">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=StyleSheet href="vista/librerias/reset.css" type="text/css" MEDIA=all>
    <link rel=StyleSheet href="vista/librerias/materialize/css/materialize.min.css" type="text/css" MEDIA=all>
    <script src="vista/librerias/jquery-3.2.1.min.js"></script>
    <script src="vista/librerias/jquery-3.2.1.min.js"></script>
    <link rel="StyleSheet" href="vista/estilo/css/comungestor.css" type="text/css" MEDIA=all>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel=StyleSheet href="vista/librerias/jquery.tablesorter/themes/mio/mio.css" type="text/css" MEDIA=all>
    <script src="vista/librerias/Chart.bundle.min.js"></script>
    <link rel="shortcut icon" href="vista/img/favicon.png" />
</head>

<body>
<main>

    <div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper ">
            <ul id="nav-mobile" class="left">
                <li><a href="https://github.com/DanielOrtegaConesa/Trabajo-Final-Daw" class="brand-logo right flex h100"><img src="vista/img/logo2.png" class="milogo"></a></li>
                <li><a href="#" data-activates="slide-out" id="disparadorlateral"><i class="material-icons">menu</i></a></li>
            </ul>
        </div>
    </nav>
    </div>

    <div class="container">

        <ul id="slide-out" class="side-nav">
            <li>
                <div class="user-view text  center-align">
                    <div class="background">
                        <img src="vista/img/userbackground.jpg">
                    </div>
                    <span class="white-text name"><?= $usesion->getNick() ?></span>
                    <span class="white-text email"><?= $usesion->getEmail() ?></span>
                </div>
            </li>

            <li><a href="index.php"><i class="material-icons">home</i>Inicio</a></li>
            <li><a href="index.php?page=administarUsuarios"><i class="material-icons">account_box</i>Administrar usuarios</a></li>
            <li><a href="index.php?page=realizarPedido"><i class="material-icons">shopping_cart</i>Carrito</a></li>
            <li><div class="divider"></div></li>

            <li><a class="subheader">Busqueda<i class="material-icons">search</i></a></li>
            <li><a href="index.php?page=clientes">Clientes</a></li>
            <li><a href="index.php?page=articulos">Articulos</a></li>

            <li><a class="subheader">Gestion<i class="material-icons">build</i></a></li>
            <li><a href="index.php?page=pedidos">Pedidos</a></li>
            <li><a href="index.php?page=albaranes">Albaranes</a></li>
            <li><a href="index.php?page=facturas">Facturas</a></li>
            <li><div class="divider"></div></li>
            <li><a class="waves-effect" href="controlador/logout/logout.php">Cerrar Sesion</a></li>

        </ul>
        <div class="section"></div>