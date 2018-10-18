<?php
include_once "../../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../../modelo/autoload.php";
include_once "../../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);

$accion = $_REQUEST["accion"];

switch ($accion) {

}
