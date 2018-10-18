<?php
include_once "../../../../modelo/funciones_BBDD_PDO.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);
$codFactura = $_REQUEST["codFactura"];

$adatos = arrayDatosPDO("lineasFacturas.codFactura", "$codFactura");
$retornar["correcto"] = true;
if (existeregistroPrepPDO($conexion, "lineasFacturas", $adatos)) {

    $resultados = selectPrepPDOlike($conexion, "*", "
facturas
INNER JOIN lineasFacturas
ON facturas.codFactura = lineasFacturas.codFactura
INNER JOIN articulos
ON articulos.codArticulo = lineasFacturas.codArticulo
", $adatos);


    foreach ($resultados as $indice => $resultado) {
        $resultados[$indice]["pass"] = "";
        $resultados[$indice]["descripcion"] = "";
    }
    $retornar["resultados"] = $resultados;

} else {
    $retornar["correcto"] = false;
}

echo json_encode($retornar, JSON_UNESCAPED_UNICODE);