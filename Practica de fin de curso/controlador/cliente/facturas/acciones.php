<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";
include_once "../../php/funciones.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);

$accion = $_REQUEST["accion"];

switch ($accion) {
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
