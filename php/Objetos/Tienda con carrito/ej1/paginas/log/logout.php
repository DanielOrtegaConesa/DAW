<?php
include_once "../includes/funciones_BBDD.php";
include_once "../clases/Carrito.php";
include_once "../clases/Pieza.php";
session_start();

/* Guardar el carrito */
$carrito = $_SESSION["carrito"];
$piezas =  $carrito->getPiezas();

if (count($piezas) >= 1) {
    $conexion = conectar();
   foreach ($piezas as $indice => $pieza){
       insert($conexion,"CARRITOS",$_SESSION["usuario"].",'".$pieza->getNUMPIEZA()."',".$pieza->getCantidad());
   }
}

$_SESSION = [];
unset($_SESSION);
session_destroy();

header("location:login.php");