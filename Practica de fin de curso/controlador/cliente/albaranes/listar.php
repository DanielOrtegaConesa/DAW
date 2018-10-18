<?php
include_once "../../../modelo/funciones_BBDD_PDO.php";
include_once "../../../modelo/autoload.php";
session_start();
$codCliente = $_SESSION["usuario"]->getCodCliente();

$conexion = conectarPDO(SERVIDOR, DB, USUARIOC, PASSWORDC);
$arraydatos = arrayDatosPDO("clientes.codCliente", "$codCliente");

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
        $arraydatos = arrayDatosPDO($cbuscar . ",,clientes.codCliente", "%" . $tbuscar . ",,$codCliente%");
        if ($cbuscar == "codAlbaran") {
            $arraydatos = arrayDatosPDO($cbuscar . ",,clientes.codCliente", $tbuscar . ",,$codCliente");
        }
        if ($cbuscar == "fecha") {
            $arraydatos = arrayDatosPDO($cbuscar . ",,clientes.codCliente", $tbuscar . "%,,$codCliente");
        }
    }
}

$pag = $inicio * $limit;
$total = selectPrepPDOlike($conexion, "count(*)", "albaranes 
        INNER JOIN clientes 
        ON clientes.codCliente = albaranes.codCliente", $arraydatos);

if ($total) {
    $total = $total[0]["count(*)"];

    $pagFinal = ceil($total / $limit);

    $resultados = selectPrepPDOlike($conexion, "*", "albaranes
        INNER JOIN clientes 
        ON clientes.codCliente = albaranes.codCliente", $arraydatos, $pag, $limit);
    $retornar["fin"] = $pagFinal;

    if ($resultados) {
        foreach ($resultados as $indice => $resultado) {

            $adatos = arrayDatosPDO("codAlbaran", $resultado["codAlbaran"]);
            $carticulosalbaran = selectPrepPDO($conexion, "count(*)", "lineasAlbaranes", $adatos)[0]["count(*)"];
            $codPedido = selectPrepPDO($conexion, "codPedido", "lineasAlbaranes", $adatos)[0]["codPedido"];

            $borrable = false;
            if (!existeregistroPrepPDO($conexion, "lineasFacturas", $adatos)) $borrable = true;
            $retornar["resultados"][$indice] = $resultado;
            $retornar["resultados"][$indice]["cantidadArticulos"] = $carticulosalbaran;
            $retornar["resultados"][$indice]["borrable"] = $borrable;
            $retornar["resultados"][$indice]["codPedido"] = $codPedido;
        }
    }

    echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
}