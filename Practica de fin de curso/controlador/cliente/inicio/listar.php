<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";

$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);
session_start();
$codCliente = $_SESSION["usuario"]->getCodCliente();

$adatos = arrayDatosPDO("codCliente",$codCliente);
$retornar["pedidos"] = selectPrepPDO($conexion,"count(*)","pedidos",$adatos)[0]["count(*)"];
$retornar["albaranes"] = selectPrepPDO($conexion,"count(*)","albaranes",$adatos)[0]["count(*)"];
$retornar["facturas"] = selectPrepPDO($conexion,"count(*)","facturas",$adatos)[0]["count(*)"];

echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
