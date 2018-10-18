<?php
include_once "../../../../modelo/funciones_BBDD_PDO.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);
$codPedido = $_REQUEST["codPedido"];

$adatos = arrayDatosPDO("lineasPedidos.codPedido", "$codPedido");
$retornar["correcto"] = true;
if (existeregistroPrepPDO($conexion, "lineasPedidos", $adatos)) {

    $resultados = selectPrepPDO($conexion, "*",
        "pedidos
                INNER JOIN lineasPedidos
                on pedidos.codPedido = lineasPedidos.codPedido

                INNER JOIN clientes
                ON clientes.codCliente = pedidos.codCliente
    
                INNER JOIN articulos
                ON articulos.codArticulo = lineasPedidos.codArticulo"
        , $adatos);
    foreach ($resultados as $indice => $resultado) {
        $resultados[$indice]["pass"] = "";
        $resultados[$indice]["descripcion"] = "";
        $resultados[$indice]["mye"] = false;

        $cond = arrayDatosPDO("codPedido,,numLineaPedido","$codPedido,,".$resultados[$indice]["numLineaPedido"]);
        if(!existeregistroPrepPDO($conexion,"lineasAlbaranes",$cond)) $resultados[$indice]["mye"] = true;
    }
    $retornar["resultados"] = $resultados;

} else {
    $retornar["correcto"] = false;
}

echo json_encode($retornar, JSON_UNESCAPED_UNICODE);