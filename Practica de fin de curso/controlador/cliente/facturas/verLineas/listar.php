<?php
include_once "../../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../../modelo/autoload.php";

$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);
session_start();
$codCliente = $_SESSION["usuario"]->getCodCliente();
$codFactura = $_REQUEST["codFactura"];

if (existeregistroPrepPDO($conexion, "facturas", arrayDatosPDO("codFactura,,codCliente", "$codFactura,,$codCliente"))) {

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

}else{
    $retornar["correcto"] = false;
}
echo json_encode($retornar, JSON_UNESCAPED_UNICODE);