<?php
include_once "../../modelo/autoload.php";
include_once "../../modelo/funciones_BBDD_PDO.php";
include_once "../php/funciones.php";
session_start();

$tipo = $_SESSION["usuario"]->getTipo();
if ($tipo == "gestor") {
    $conexion = conectarPDO(SERVIDOR,DB,USUARIOG,PASSWORDG);
    $fact = fechaActualMysql();
    $usuario = $_SESSION["usuario"];

    $arrayDatos= arrayDatosPDO("codUsuarioGestion,,fechaHoraSalida",$usuario->getCodUsuarioGestion().",,".$fact);

    insertPrepPDO($conexion, "accesos", $arrayDatos);
}


$_SESSION = [];
unset($_SESSION);
session_destroy();
header("location:../../index.php");