<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
$conexion = conectarPDO(SERVIDOR, DB, USUARIOG, PASSWORDG);
$arraydatos = arrayDatosPDO("1", "1");

$inicio = 1;
$limit = 10;
if (isset($_REQUEST["pag"])) {
    $inicio = $_REQUEST["pag"];
}
if (isset($_REQUEST["limit"])) {
    $limit = $_REQUEST["limit"];
}

if (isset($_REQUEST["cbuscar"]) & isset($_REQUEST["tbuscar"])) {
    $cbuscar = $_REQUEST["cbuscar"];
    $tbuscar = $_REQUEST["tbuscar"];
    if ($tbuscar != "") {
        $arraydatos = arrayDatosPDO($cbuscar, "%" . $tbuscar . "%");
        if ($cbuscar == "codFactura") {
            $arraydatos = arrayDatosPDO($cbuscar, $tbuscar);
        }
    }
}

$pag = $inicio * $limit;


$resultados = selectPrepPDOlike($conexion, "*", "
facturas 
INNER JOIN clientes
ON clientes.codCliente = facturas.codCliente
", $arraydatos, $pag, $limit);

$total = selectPrepPDOlike($conexion, "count(*)", "
facturas 
INNER JOIN clientes
ON clientes.codCliente = facturas.codCliente
", $arraydatos)[0]["count(*)"];

//echo "$total";

$pagFinal = ceil($total / $limit);

$retornar["fin"] = $pagFinal;

if ($resultados) {
    $retornar["resultados"] = $resultados;
    foreach ($resultados as $indice => $resultado) {

        //privatizamos la contraseña
        $retornar["resultados"][$indice]["pass"] = "";

        $adatos = arrayDatosPDO("codFactura", $resultado["codFactura"]);
        $carticulosFactura = selectPrepPDO($conexion, "count(*)", "lineasFacturas", $adatos)[0]["count(*)"];
        $retornar["resultados"][$indice]["cantidadArticulos"] = $carticulosFactura;

        $borrable = true;
        $retornar["resultados"][$indice]["borrable"] = $borrable;
    }
}
echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
