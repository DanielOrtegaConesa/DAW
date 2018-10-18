<?php
include_once "../../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../../modelo/autoload.php";
include_once "../../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);

$accion = $_REQUEST["accion"];

switch ($accion) {
    case "eliminarAlbaran":
        $codAlbaran = $_REQUEST["codAlbaran"];
        $codFactura = $_REQUEST["codFactura"];

        $adatos = arrayDatosPDO("codAlbaran,,codFactura", "$codAlbaran,,$codFactura");

        if (existeregistroPrepPDO($conexion, "lineasFacturas", $adatos)) {
            $conexion->beginTransaction();
            $correcto = true;

            if (!borrarPrepPDO($conexion, "lineasFacturas", $adatos)) $correcto = false;

            $cantidadLineas = selectPrepPDO($conexion, "count(*)", "lineasFacturas", arrayDatosPDO("codFactura",$codFactura))[0]["count(*)"];
            if (!$cantidadLineas) {
                if (!borrarPrepPDO($conexion, "facturas", arrayDatosPDO("codFactura", $codFactura))) $correcto = false;
            }

            if ($correcto) $conexion->commit(); else $conexion->rollBack();
        }
        break;
    case "editar":
        $codPedido = $_REQUEST["codPedido"];
        $numLineaPedido = $_REQUEST["numLineaPedido"];
        $adatos = arrayDatosPDO("lineasPedidos.codPedido,,numLineaPedido", "$codPedido,,$numLineaPedido");

        $retornar["todoslosarticulos"] = selectPrepPDO($conexion, "*", "articulos", arrayDatosPDO(1, 1));
        $retornar["datosLinea"] = selectPrepPDO($conexion, "*",
            "pedidos
                INNER JOIN lineasPedidos
                on pedidos.codPedido = lineasPedidos.codPedido
    
                INNER JOIN articulos
                ON articulos.codArticulo = lineasPedidos.codArticulo",
            $adatos
        )[0];
        $retornar["datosLinea"]["descripcion"] = "";


        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;
    case "actualizar":
        $codPedido = $_REQUEST["codPedido"];
        $numLineaPedido = $_REQUEST["numLineaPedido"];

        $adatos = arrayDatosPDO("codPedido,,numLineaPedido", "$codPedido,,$numLineaPedido");

        $cantidad = $_REQUEST["cantidad"];
        $codArticulo = $_REQUEST["codArticulo"];

        if (esnumero($cantidad) && $cantidad > 0) {
            if (existeregistroPrepPDO($conexion, "lineasPedidos", arrayDatosPDO("codPedido,,numLineaPedido", $codPedido . ",," . $numLineaPedido))) {
                if (existeregistroPrepPDO($conexion, "articulos", arrayDatosPDO("codArticulo", $codArticulo))) {

                    if (!existeregistroPrepPDO($conexion, "lineasAlbaranes", arrayDatosPDO("numLineaPedido,,codPedido", "$numLineaPedido,,$codPedido"))) {
                        updatePrepPDO($conexion, "lineasPedidos", "codPedido = '$codPedido' AND numLineaPedido = '$numLineaPedido'", arrayDatosPDO("cantidad,,codArticulo", "$cantidad,,$codArticulo"));
                    }

                }
            }
        }
        break;
}
