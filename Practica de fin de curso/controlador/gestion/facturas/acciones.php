<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";
include_once "../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);

$accion = $_REQUEST["accion"];

switch ($accion) {
    case "eliminar":
        $codFactura = $_REQUEST["codFactura"];
        $adatos = arrayDatosPDO("codFactura", "$codFactura");

        $conexion->beginTransaction();
        $correcto = true;
        if (!borrarPrepPDO($conexion, "lineasFacturas", $adatos)) $correcto = false;
        if (!borrarPrepPDO($conexion, "facturas", $adatos)) $correcto = false;

        if ($correcto) $conexion->commit(); else $conexion->rollBack();

        break;

    case "editar":
        $codFactura = $_REQUEST["codFactura"];
        $adatos = arrayDatosPDO("codFactura", "$codFactura");
        $retornar["codFactura"] = $codFactura;
        if (existeregistroPrepPDO($conexion, "facturas", $adatos)) {
            $retornar["descuentoFactura"] = selectPrepPDO($conexion, "descuentoFactura", "facturas", $adatos)[0]["descuentoFactura"];
        }
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;

    case "actualizar":
        $retornar["correcto"] = true;
        $codFactura = $_REQUEST["codFactura"];
        $descuento = $_REQUEST["descuento"];
        $adatos = arrayDatosPDO("codFactura", "$codFactura");
        if (existeregistroPrepPDO($conexion, "facturas", $adatos)) {
            if (esnumero($descuento)) {
                if ($descuento < 100) {
                    if (!updatePrepPDO($conexion, "facturas", "codFactura = '$codFactura'", arrayDatosPDO("descuentoFactura", $descuento))) {
                        $retornar["correcto"] = false;
                        //$retornar["mensaje"] = "Error inesperado al actualizar";
                    }
                } else {
                    $retornar["correcto"] = false;
                    $retornar["mensaje"] = "Descuento debe ser inferior a 100";
                }
            } else {
                $retornar["correcto"] = false;
                $retornar["mensaje"] = "El descuento debe ser numerico";
            }
        } else {
            $retornar["correcto"] = false;
            $retornar["mensaje"] = "Error inesperado";
        }
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;
    case "imprimir":
        $seleccionados = json_decode($_REQUEST['seleccionados']);

        $retornar["correcto"] = false;

        foreach ($seleccionados as $i => $seleccion) {
            $retornar["resultados"][] = selectPrepPDO($conexion, "articulos.nombre, lineasFacturas.codArticulo,lineasFacturas.numLineaFactura,lineasFacturas.precio,lineasFacturas.cantidad,lineasFacturas.descuento,lineasFacturas.iva,clientes.nick,clientes.dni,clientes.razonSocial,clientes.domicilioSocial,clientes.ciudad,facturas.fecha,facturas.codFactura,facturas.descuentoFactura",
                "facturas 
                       INNER JOIN lineasFacturas ON facturas.codFactura = lineasFacturas.codFactura
                       INNER JOIN clientes ON clientes.codCliente = facturas.codCliente
                       INNER JOIN articulos ON articulos.codArticulo = lineasFacturas.codArticulo"
                , arrayDatosPDO("facturas.codFactura", "$seleccion"));
        }
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
        break;
}
